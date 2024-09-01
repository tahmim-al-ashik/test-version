<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use App\Models\Customer\Customer;
use App\Models\Invoice\InvoiceCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Inertia\Inertia;


class InvoiceController extends Controller
{

    public function showDraftInvoices()
    {
        return inertia('Invoice/DraftInvoices');
    }

    public function getAllInvoices()
{
    try {
        $invoices = Invoice::where('user_id', Auth::id())
            ->with('customer') // Ensure customer data is included
            ->get();

        return response()->json($invoices);
    } catch (\Exception $e) {
        Log::error('Error fetching invoices: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
        return response()->json(['error' => 'Error fetching invoices'], 500);
    }
}

//    public function rejectInvoice($id)
//    {
//        try {
//            $invoice = Invoice::find($id);
//            if (!$invoice) {
//                return response()->json(['error' => 'Invoice not found'], 404);
//            }
//
//            $invoice->status = 'rejected';
//            $invoice->save();
//
//            return response()->json(['message' => 'Invoice rejected successfully']);
//        } catch (\Exception $e) {
//            Log::error('Error rejecting invoice: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
//            return response()->json(['error' => 'Error rejecting invoice'], 500);
//        }
//    }
//
//
//    public function completeInvoice($id)
//    {
//        try {
//            $invoice = Invoice::where('id', $id)
//                ->where('user_id', Auth::id())
//                ->firstOrFail();
//
//            if ($invoice->status === 'rejected') {
//                $invoice->status = 'complete';
//                $invoice->save();
//            }
//
//            return response()->json(['message' => 'Invoice marked as complete successfully']);
//        } catch (\Exception $e) {
//            Log::error('Error marking invoice as complete: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
//            return response()->json(['error' => 'Error marking invoice as complete'], 500);
//        }
//    }

    public function rejectInvoice($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->status = 'rejected';
            $invoice->save();
            return response()->json(['message' => 'Invoice rejected successfully']);
        } catch (\Exception $e) {
            Log::error('Error rejecting invoice: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Error rejecting invoice'], 500);
        }
    }

    public function completeInvoice($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->status = 'complete';
            $invoice->save();
            return response()->json(['message' => 'Invoice marked as complete']);
        } catch (\Exception $e) {
            Log::error('Error marking invoice as complete: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Error marking invoice as complete'], 500);
        }
    }




    public function getDraftInvoices()
    {
        try {
            $draftInvoices = Invoice::where('status', 'draft')
                ->where('user_id', Auth::id())
                ->with('customer') // Ensure customer data is included
                ->get();

            return response()->json($draftInvoices);
        } catch (\Exception $e) {
            Log::error('Error fetching draft invoices: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Error fetching draft invoices'], 500);
        }
    }

    public function resendInvoice(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if (!$invoice || $invoice->status != 'draft') {
            return response()->json(['error' => 'Invoice not found or is not a draft'], 404);
        }

        $data = json_decode($invoice->products, true);

        return response()->json([
            'invoice' => $invoice,
            'products' => $data,
            'selectedCustomer' => $invoice->customer,
        ]);
    }

    public function deleteDraftInvoice($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice || $invoice->status != 'draft') {
            return response()->json(['error' => 'Invoice not found or is not a draft'], 404);
        }

        $invoice->delete();

        return response()->json(['message' => 'Draft invoice deleted successfully']);
    }

    public function generateInvoiceId()
    {
        $latestInvoice = Invoice::latest()->first();
        $invoiceId = 'inv' . str_pad(($latestInvoice ? $latestInvoice->id + 1 : 1), 6, '0', STR_PAD_LEFT);

        return response()->json(['invoiceId' => $invoiceId]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            Log::info('Received data for invoice storage: ', $data);

            $validatedData = $request->validate([
                'invoice_id' => 'required|string',
                'user_id' => 'required|integer',
                'invoice_category_id' => 'required|integer',
                'invoice_date' => 'required|date',
                'delivery_date' => 'nullable|date',
                'products' => 'required|array',
                'status' => 'required|string',
                'total_price_excluding_vat' => 'required|numeric',
                'total_price_including_vat' => 'required|numeric',
                'received_money' => 'required|numeric',
                'due_amount' => 'required|numeric',
                'transaction_type' => 'required|string',
                'selectedCustomer.customer_name' => 'required|string',
                'selectedCustomer.phone_no' => 'required|string',
                'selectedCustomer.address' => 'required|string',
                'selectedCustomer.email_invoice' => 'required|string|email'
            ]);

            $customer = Customer::where('customer_name', $data['selectedCustomer']['customer_name'])->firstOrFail();
            $invoiceSettings = Auth::user()->invoiceSetting;

            $invoice = Invoice::create([
                'invoice_id' => $data['invoice_id'],
                'user_id' => Auth::id(),
                'customer_id' => $customer->id,
                'invoice_category_id' => $data['invoice_category_id'],
                'invoice_setting_id' => $invoiceSettings->id,
                'invoice_date' => $data['invoice_date'],
                'delivery_date' => $data['delivery_date'] ?? null,
                'products' => json_encode($data['products']),
                'notes' => $data['notes'] ?? null,
                'payment_details' => $data['payment_details'] ?? null,
                'qr_link' => $data['qr_link'] ?? null,
                'status' => $data['status'],
                'total_price_excluding_vat' => $data['total_price_excluding_vat'],
                'total_price_including_vat' => $data['total_price_including_vat'],
                'received_money' => $data['received_money'],
                'due_amount' => $data['due_amount'],
                'transaction_type' => $data['transaction_type'],
                'sender_reference' => json_encode($data['sender_reference']),
                'receiver_reference' => json_encode($data['receiver_reference']),
                'file_path' => $data['file_path']
            ]);

            Log::info('Invoice stored successfully', ['invoice_id' => $invoice->id]);

            return response()->json($invoice, 201);
        } catch (\Exception $e) {
            Log::error('Error storing invoice: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Error storing invoice'], 500);
        }
    }


public function generateInvoicePdf(Request $request)
{
    set_time_limit(300);
    ini_set('memory_limit', '512M');

    try {
        $data = $request->all();

        // Ensure selectedCustomer is properly decoded if it's JSON encoded
        if (isset($data['selectedCustomer']) && is_string($data['selectedCustomer'])) {
            $data['selectedCustomer'] = json_decode($data['selectedCustomer'], true);
        }

        // Ensure products are properly decoded if it's JSON encoded
        if (isset($data['products']) && is_string($data['products'])) {
            $data['products'] = json_decode($data['products'], true);
        }

        Log::info('Generating PDF for customer: ' . $data['selectedCustomer']['customer_name']);

        $invoiceSettings = Auth::user()->invoiceSetting;

        $customer = Customer::with(['references', 'delivery_requirements', 'payment_requirements', 'currency'])
            ->where('customer_name', $data['selectedCustomer']['customer_name'])
            ->firstOrFail();

        $invoiceCategory = InvoiceCategory::findOrFail($data['invoice_category_id']);

        $data['invoice_id'] = $data['invoice_id'];
        $data['invoice_date'] = $data['invoice_date'];

        foreach ($data['products'] as &$product) {
            $product['qty'] = $product['qty'] ?? 0;
        }

        $data['notes'] = $data['notes'] ?? '';
        $data['payment_details'] = $data['payment_details'] ?? '';
        $data['qr_link'] = $data['qr_link'] ?? '';

        $invoiceSettings->logo_base64 = $this->encodeImageToBase64($invoiceSettings->logo_path);
        $invoiceSettings->watermark_base64 = $this->encodeImageToBase64($invoiceSettings->watermark_logo_path);

        if (!empty($data['qr_link'])) {
            $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($data['qr_link']));
            $data['qr_code_base64'] = $qrCode;
        } else {
            $data['qr_code_base64'] = null;
        }

        $data['senderReference'] = $this->formatReferences($data['sender_reference'] ?? []);
        $data['receiverReference'] = $this->formatReferences($data['receiver_reference'] ?? []);

        // Ensure due_date is set
        if (!isset($data['due_date'])) {
            $data['due_date'] = null;
        }

        Log::info('Data being passed to view', compact('data', 'invoiceSettings', 'customer', 'invoiceCategory'));

        $pdf = Pdf::loadView('pdf.invoice', compact('data', 'invoiceSettings', 'customer', 'invoiceCategory'));

        return $pdf->download($data['invoice_id'] . '.pdf');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error('Customer or category not found: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
        return response()->json(['error' => 'Customer or category not found'], 404);
    } catch (\Exception $e) {
        Log::error('Error generating PDF: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
        return response()->json(['error' => 'Error generating PDF'], 500);
    }
}


    private function encodeImageToBase64($imagePath)
    {
        if (!empty($imagePath) && file_exists(storage_path('app/public/' . $imagePath))) {
            return base64_encode(file_get_contents(storage_path('app/public/' . $imagePath)));
        } else {
            return null;
        }
    }

    private function formatReferences($references)
    {
        return array_map(function ($ref) {
            return (string) $ref;
        }, $references);
    }
}

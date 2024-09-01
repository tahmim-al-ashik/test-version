<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DraftInvoicesController extends Controller
{
    public function index()
    {
        $draftInvoices = Invoice::where('user_id', Auth::id())->where('status', 'draft')->with('customer')->get();
        return response()->json($draftInvoices);
    }

    public function resend(Request $request)
    {
        $request->validate(['invoice_id' => 'required|string']);
        $invoice = Invoice::where('invoice_id', $request->invoice_id)->where('user_id', Auth::id())->firstOrFail();

        // Logic to resend the invoice
        // For example, send an email with the invoice PDF attached

        // Logging the resend action
        Log::info('Resending invoice', ['invoice_id' => $invoice->invoice_id, 'user_id' => Auth::id()]);

        return response()->json(['message' => 'Invoice resent successfully']);
    }
}

<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\InvoiceSettingRequest;
use App\Models\CorporateUser;
use App\Models\Invoice\InvoiceSetting;
use App\Models\Invoice\SenderReference;
use App\Models\Currency;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class InvoiceSettingController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $serviceId = 1; // Assuming the service ID is 1 for demonstration purposes
        $userService = $user->services()->where('service_id', $serviceId)->withPivot('package_id', 'registration_type')->first();

        // Fetch the name based on the registration type
        $invoiceCreatedBy = null;
        if ($userService) {
            if ($userService->pivot->registration_type === 'corporate') {
                $corporateUser = CorporateUser::where('user_id', $user->id)->first();
                $invoiceCreatedBy = $corporateUser ? $corporateUser->name : $user->name;
            } else {
                $invoiceCreatedBy = $user->name;
            }
        }

        $invoiceSetting = $user->invoiceSetting()->with('senderReferences')->first();

        return Inertia::render('Invoice/InvoiceSettings', [
            'invoiceSetting' => $invoiceSetting,
            'currencies' => Currency::all(),
            'invoiceCreatedBy' => $invoiceCreatedBy,
            'packageId' => $userService ? $userService->pivot->package_id : null // Pass package_id to the view
        ]);
    }

    public function update(InvoiceSettingRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $this->processImage($logo, 'logos');
            $data['logo_path'] = $logoPath;
        } elseif ($user->invoiceSetting) {
            $data['logo_path'] = $user->invoiceSetting->logo_path;
        } else {
            $data['logo_path'] = null;
        }

        if ($request->hasFile('watermark_logo')) {
            $watermarkLogo = $request->file('watermark_logo');
            $watermarkLogoPath = $this->processImage($watermarkLogo, 'watermark_logos');
            $data['watermark_logo_path'] = $watermarkLogoPath;
        } elseif ($user->invoiceSetting) {
            $data['watermark_logo_path'] = $user->invoiceSetting->watermark_logo_path;
        } else {
            $data['watermark_logo_path'] = null;
        }

        $data['website'] = $request->input('website') ?: null;
        $data['invoice_created_by'] = $request->input('invoice_created_by');

        $invoiceSetting = $user->invoiceSetting()->updateOrCreate(['user_id' => $user->id], $data);

        // Handle sender references
        if ($request->has('sender_references') && !empty($request->input('sender_references'))) {
            $invoiceSetting->senderReferences()->delete();
            $senderReferences = $request->input('sender_references', []);
            foreach ($senderReferences as $reference) {
                $invoiceSetting->senderReferences()->create([
                    'name' => $reference['name'] ?? null,
                    'email' => $reference['email'] ?? null,
                    'phone' => $reference['phone'] ?? null,
                ]);
            }
        }

        return redirect()->route('package.invoice', ['service' => 1, 'package' => $request->input('package_id')])->with('success', 'Invoice settings updated successfully.');
    }

    private function processImage($image, $folder)
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = storage_path('app/public/' . $folder . '/' . $filename);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        $image = Image::make($image->getRealPath());
        $image->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path, 75); // Save with 75% quality

        return $folder . '/' . $filename;
    }


    public function getInvoiceSettings()
    {
        try {
            $user = auth()->user();
            $invoiceSetting = $user->invoiceSetting()->with('senderReferences')->first();

            if ($invoiceSetting) {
                return response()->json($invoiceSetting);
            } else {
                return response()->json(null, 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching invoice settings: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

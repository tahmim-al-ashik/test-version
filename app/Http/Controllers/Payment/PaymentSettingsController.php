<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Payment;
use Inertia\Inertia;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $payments = Payment::with('paymentGateway')->where('user_id', auth()->id())->get();
        return Inertia::render('Payment/PaymentSettings', [
            'payments' => $payments
        ]);
    }

    public function store(StorePaymentRequest $request)
    {
        Payment::create([
            'user_id' => auth()->id(),
            'payment_gateway_id' => $request->payment_gateway_id,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ]);

        return redirect()->back();
    }

    public function update(UpdatePaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'payment_gateway_id' => $request->payment_gateway_id,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $payment = Payment::where('user_id', auth()->id())->findOrFail($id);
        $payment->delete();

        return redirect()->route('payment-settings.index');
    }
}

<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\PaymentGateway;
use App\Http\Requests\Payment\StorePaymentGatewayRequest;
use App\Http\Requests\Payment\UpdatePaymentGatewayRequest;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $gateways = PaymentGateway::with(['payments' => function ($query) {
            $query->where('user_id', auth()->id())->select('id', 'payment_gateway_id', 'account_name');
        }])
            ->where('user_id', auth()->id())
            ->withCount([
                'payments as total_transactions' => function ($query) {
                    $query->where(function($q) {
                        $q->where('total_sent', '>', 0)
                            ->orWhere('total_received', '>', 0);
                    });
                },
                'payments as total_sending_amount' => function ($query) {
                    $query->select(\DB::raw("SUM(total_sent)"));
                },
                'payments as total_received_amount' => function ($query) {
                    $query->select(\DB::raw("SUM(total_received)"));
                }
            ])->get();

        return response()->json($gateways);
    }

    public function store(StorePaymentGatewayRequest $request)
    {
        $gateway = PaymentGateway::create([
            'name' => $request->name,
            'user_id' => auth()->id()
        ]);

        return response()->json($gateway);
    }

    public function update(UpdatePaymentGatewayRequest $request, $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        $gateway->update([
            'name' => $request->name
        ]);

        return response()->json($gateway);
    }
}

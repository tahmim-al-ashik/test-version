<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            text-align: left;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
        }

        .footer {
            bottom: 0px;
            font-size: 8px;
        }

        .right-align {
            text-align: right;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            @if (!empty($invoiceSettings->logo_base64))
                                <img src="data:image/png;base64,{{ $invoiceSettings->logo_base64 }}" alt="Logo" style="width:50%; max-width:150px">
                            @else
                                <h3>Invoice ID#: {{ $data['invoice_id'] }} </h3>
                            @endif
                        </td>

                        <td class="right-align">
                            Invoice #: {{ $data['invoice_id'] }}<br />
                            Created: {{ $data['invoice_date'] }}<br />
                            Delivery Date: {{ $data['delivery_date'] ?? 'N/A' }}<br>
                            Due date: {{ $data['due_date'] }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            {{ $invoiceSettings->company_person_name }}<br>
                            {{ $invoiceSettings->address }}<br>
                            <p>{{ $invoiceSettings->website }}</p>
                            @if (!empty($invoiceSettings->phones))
                                @foreach ($invoiceSettings->phones as $phone)
                                    {{ $phone }}@if (!$loop->last), @endif
                                @endforeach
                                <br>
                            @endif
                            @if (!empty($invoiceSettings->emails))
                                @foreach ($invoiceSettings->emails as $email)
                                    {{ $email }}@if (!$loop->last), @endif
                                @endforeach
                                <br>
                            @endif
                        </td>
                        <td class="right-align">
                            {{ $customer->customer_name }}<br />
                            {{ $customer->email_invoice }}<br />
                            {{ $customer->phone_no }}<br>
                            {{ $customer->address }}<br>
                            {{ $customer->currency->symbol }}<br>
                        </td>
                        <div class="watermark">
                            @if (!empty($invoiceSettings->watermark_base64))
                                <img src="data:image/png;base64,{{ $invoiceSettings->watermark_base64 }}" alt="Watermark Logo" style="width: 400px;">
                            @endif
                        </div>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>
            <td></td>
            <td></td>
            <td>Check #</td>
        </tr>

        <tr class="details">
            <td>{{ $data['payment_details'] }}</td>
            <td></td>
            <td></td>
            <td>{{ $data['received_money'] }}</td>
        </tr>

        <tr class="heading">
            <td>Item</td>
            <td>Qty</td>
            <td>Price Inc Vat</td>
            <td>Price Exc Vat</td>
        </tr>

        <tr class="item">
            @foreach($data['products'] as $product)
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['qty'] }}</td>
                <td>{{ $product['priceIncVat'] }}</td>
                <td>{{ $product['priceExVat'] }}</td>
            @endforeach
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                Total (Inc Vat): {{ $data['total_price_including_vat'] }}<br>
{{--                Total (Exc Vat): {{ $data['total_price_excluding_vat'] }}--}}
                Received Money: {{ $data['received_money'] }}
            </td>
        </tr>
        @if (!empty($data['qr_code_base64']))
            <div>
                <img src="data:image/png;base64,{{ $data['qr_code_base64'] }}" alt="QR Code">
            </div>
        @endif
    </table>

    <p><strong>{{ $data['notes'] }}</strong></p>
    <div class="footer">
        <p>Invoice generated by {{ $invoiceSettings->invoice_created_by }}</p>
    </div>
</div>
</body>
</html>

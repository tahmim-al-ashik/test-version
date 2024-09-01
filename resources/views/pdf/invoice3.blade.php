<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header, .footer { width: 100%; text-align: center; position: fixed; }
        .header { top: 0px; }
        .footer { bottom: 0px; font-size: 12px; }
        .page { page-break-after: always; }
        .content { margin-top: 100px; }
        .content h1 { font-size: 24px; }
        .content h2 { font-size: 20px; }
        .content p { font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.1; }
    </style>
</head>
<body>
<div class="header">
    <h1>Invoice ID: {{ $data['invoice_id'] }}</h1>
    @if (!empty($invoiceSettings->logo_base64))
        <img src="data:image/png;base64,{{ $invoiceSettings->logo_base64 }}" alt="Logo" style="width: 100px;">
    @else
        <img src="{{ asset('storage/default-logo.png') }}" alt="Default Logo" style="width: 100px;">
    @endif
    <h1>{{ $invoiceSettings->company_person_name }}</h1>
    <p>{{ $invoiceSettings->address }}</p>
    <p>{{ $invoiceSettings->website }}</p>
    @if (!empty($invoiceSettings->phones))
        <p>Phones:
            @foreach ($invoiceSettings->phones as $phone)
                {{ $phone }}@if (!$loop->last), @endif
            @endforeach
        </p>
    @endif
    @if (!empty($invoiceSettings->emails))
        <p>Emails:
            @foreach ($invoiceSettings->emails as $email)
                {{ $email }}@if (!$loop->last), @endif
            @endforeach
        </p>
    @endif
</div>
<div class="watermark">
    @if (!empty($invoiceSettings->watermark_base64))
        <img src="data:image/png;base64,{{ $invoiceSettings->watermark_base64 }}" alt="Watermark Logo" style="width: 400px;">
    @endif
</div>
<div class="content">
    <p>Invoice Date: {{ $data['invoice_date'] }}</p>
    <p><strong>Delivery Date:</strong> {{ $data['delivery_date'] ?? 'N/A' }}</p>
    <p>Due Date: {{ $data['due_date'] }}</p>

    <h3>Sender Details</h3>
    <p>{{ $invoiceSettings->company_person_name }}</p>
    <p>{{ $invoiceSettings->address }}</p>
    <p>{{ $invoiceSettings->website }}</p>
    @if (!empty($invoiceSettings->phones))
        <p>Phones:
            @foreach ($invoiceSettings->phones as $phone)
                {{ $phone }}@if (!$loop->last), @endif
            @endforeach
        </p>
    @endif
    @if (!empty($invoiceSettings->emails))
        <p>Emails:
            @foreach ($invoiceSettings->emails as $email)
                {{ $email }}@if (!$loop->last), @endif
            @endforeach
        </p>
    @endif

    <h3>Sender Reference</h3>
    @if (!empty($data['senderReference'][0]))
        <p>Name: {{ $data['senderReference'][0] }}</p>
        <p>Email: {{ $data['senderReference'][1] ?? 'N/A' }}</p>
    @else
        <p>Name: {{ $invoiceSettings->sender_references[0]['name'] ?? 'N/A' }}</p>
        <p>Email: {{ $invoiceSettings->sender_references[0]['email'] ?? 'N/A' }}</p>
        <p>Phone: {{ $invoiceSettings->sender_references[0]['phone'] ?? 'N/A' }}</p>
    @endif

    <h3>Receiver Reference</h3>
    @if (!empty($data['receiverReference'][0]))
        <p>Name: {{ $data['receiverReference'][0] }}</p>
        <p>Email: {{ $data['receiverReference'][1] ?? 'N/A' }}</p>
    @else
        <p>Name: {{ $customer->references[0]->name ?? 'N/A' }}</p>
        <p>Email: {{ $customer->references[0]->email ?? 'N/A' }}</p>
        <p>Phone: {{ $customer->references[0]->phone_no ?? 'N/A' }}</p>
    @endif

    <h3>Customer Details:</h3>
    <p>Customer Name: {{ $customer->customer_name }}</p>
    <p>Customer Email: {{ $customer->email_invoice }}</p>
    <p>Customer Phone Number: {{ $customer->phone_no }}</p>
    <p>Customer Address: {{ $customer->address }}</p>
    <p>Customer Currency: {{ $customer->currency->symbol }}</p>

    <h3>Customer Delivery Requirements:</h3>
    <ul>
        @foreach ($customer->delivery_requirements as $requirement)
            <li>Terms of Delivery: {{ $requirement->terms_of_delivery }}</li>
            <li>Delivery Method: {{ $requirement->delivery_method }}</li>
        @endforeach
    </ul>

    <h3>Customer Payment Requirements</h3>
    <ul>
        @foreach ($customer->payment_requirements as $requirement)
            <li>Terms of Payment: {{ $requirement->terms_of_payment }}</li>
            <li>Currency: {{ $requirement->currency }}</li>
            <li>Pay to Account: {{ $requirement->pay_to_account }}</li>
            <li>Customer Discount: {{ $requirement->customer_discount }}%</li>
        @endforeach
    </ul>

    <h3>Products/Services</h3>
    <table>
        <thead>
        <tr>
            <th>Product/Service Name</th>
            <th>Quantity</th>
            <th>Unit Price Inc Vat</th>
            <th>Unit Price Exc Vat</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['products'] as $product)
            <tr>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['qty'] }}</td>
                <td>{{ $product['priceIncVat'] }}</td>
                <td>{{ $product['priceExVat'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Total Price excluding VAT: {{ $data['total_price_excluding_vat'] }}</p>
    <p>Total Price including VAT: {{ $data['total_price_including_vat'] }}</p>
    <p>Received Money: {{ $data['received_money'] }}</p>
    <p>Due Amount: {{ $data['due_amount'] }}</p>


    <h3>Notes</h3>
    <p>{{ $data['notes'] }}</p>

    <h3>Payment Details</h3>
    <p>{{ $data['payment_details'] }}</p>

    <h3>Delivery Details</h3>
    <p>{{ $customer->delivery_requirements[0]->terms_of_delivery ?? 'N/A' }}</p>
    <p>{{ $customer->delivery_requirements[0]->delivery_method ?? 'N/A' }}</p>

    @if (!empty($data['qr_code_base64']))
        <div>
            <h3>QR Code</h3>
            <img src="data:image/png;base64,{{ $data['qr_code_base64'] }}" alt="QR Code">
        </div>
    @endif
</div>
<div class="footer">
    <p>Invoice generated by {{ $invoiceSettings->invoice_created_by }}</p>
</div>
</body>
</html>

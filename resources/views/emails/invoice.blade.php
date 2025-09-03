<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>
<body>
    <h2>Hello {{ $invoice->customer->name }},</h2>

    <p>You have a new invoice (Invoice #{{ $invoice->invoice_number }}) 
    for <strong>${{ number_format($invoice->amount, 2) }}</strong>.</p>

    <p>Please click the button below to pay:</p>

    <p>
        <a href="{{ $paymentUrl }}" 
           style="background:#4CAF50;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;">
           Pay Invoice
        </a>
    </p>

    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>

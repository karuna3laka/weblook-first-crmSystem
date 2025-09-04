<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <h1 style="color: #333; text-align: center;">Your Invoice</h1>
        <p style="text-align: center; color: #555;">{{ config('app.name') }}</p>
        
        <hr style="border:none; border-top: 1px solid #eee; margin: 20px 0;">
        
        <!-- Customer Info -->
        <p><strong>Hello {{ $invoice->customer->name }},</strong></p>
        <p>You have a new invoice with the following details:</p>

        <!-- Invoice Details -->
        <table style="width:100%; border-collapse: collapse; margin: 20px 0;">
            <tr style="background: #f0f0f0;">
                <th style="padding: 10px; text-align: left;">Invoice #</th>
                <th style="padding: 10px; text-align: left;">Amount</th>
                <th style="padding: 10px; text-align: left;">Due Date</th>
                <th style="padding: 10px; text-align: left;">Status</th>
            </tr>
            <tr>
                <td style="padding: 10px;">{{ $invoice->invoice_number }}</td>
                <td style="padding: 10px;">${{ number_format($invoice->amount,2) }}</td>
                <td style="padding: 10px;">{{ $invoice->due_date }}</td>
                <td style="padding: 10px;">{{ ucfirst($invoice->status) }}</td>
            </tr>
        </table>

        <!-- Payment Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $paymentUrl }}" 
               style="background: #4CAF50; color: #fff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
               Pay Now
            </a>
        </div>

        <p style="color: #777; text-align: center;">Thank you for your business!</p>
    </div>
</body>
</html>

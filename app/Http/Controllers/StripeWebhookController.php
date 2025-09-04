<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Stripe\Webhook;
use App\Models\Transaction;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response('Invalid payload', 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('Invalid signature', 400);
        }

        // Handle the event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $invoiceId = $session->metadata->invoice_id ?? null;

            if ($invoiceId) {
                $invoice = Invoice::with('customer')->find($invoiceId);

                if ($invoice && $invoice->status !== 'paid') {
                    // Mark invoice paid
                    $invoice->update([
                        'status' => 'paid',
                        'stripe_payment_intent_id' => $session->payment_intent ?? null,
                        'stripe_session_id' => $session->id ?? null,
                    ]);

                    // Create a transaction row
                    Transaction::updateOrCreate(
                        ['payment_id' => $session->payment_intent ?? null],
                        [
                            'customer_id' => $invoice->customer_id,
                            'invoice_id'  => $invoice->id,
                            'session_id'  => $session->id ?? null,
                            'amount'      => $invoice->amount,
                            'currency'    => $session->currency ?? 'usd',
                            'status'      => 'paid',
                            'paid_at'     => now(),
                        ]
                    );
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
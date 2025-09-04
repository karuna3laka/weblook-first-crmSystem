<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Stripe\Webhook;
use Stripe\StripeClient;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        // Log the raw event type for debugging
        \Log::info('Stripe Webhook Received', [
            'event_type' => $event->type,
        ]);

        if ($event->type === 'checkout.session.completed') {
            $sessionObject = $event->data->object;

            // 🔑 Fetch full session to ensure metadata is available
            $stripe = new StripeClient(config('services.stripe.secret'));
            $session = $stripe->checkout->sessions->retrieve(
                $sessionObject->id,
                []
            );

            \Log::info('✅ Checkout Session Completed', [
                'session_id'     => $session->id,
                'payment_status' => $session->payment_status,
                'invoice_id'     => $session->metadata->invoice_id ?? 'not_found',
            ]);

            $invoiceId = $session->metadata->invoice_id ?? null;

            if ($invoiceId) {
                $invoice = Invoice::with('customer')->find($invoiceId);

                if ($invoice && $invoice->status !== 'paid') {
                    // Mark invoice as paid
                    $invoice->update([
                        'status'                   => 'paid',
                        'stripe_payment_intent_id' => $session->payment_intent ?? null,
                        'stripe_session_id'        => $session->id ?? null,
                    ]);

                    // Record transaction
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

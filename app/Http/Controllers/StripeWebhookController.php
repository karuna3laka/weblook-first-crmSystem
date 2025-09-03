<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Checkout\Session as CheckoutSession;

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

            // Metadata should include invoice_id (we set it when creating session)
            $invoiceId = $session->metadata->invoice_id ?? null;

            if ($invoiceId) {
                $invoice = Invoice::find($invoiceId);

                // Ensure we only update once and check payment status
                if ($invoice && $invoice->status !== 'paid') {
                    // session.payment_status should be 'paid' for successful card payment
                    if (isset($session->payment_status) && $session->payment_status === 'paid') {
                        $invoice->update([
                            'status' => 'paid',
                            'stripe_payment_intent_id' => $session->payment_intent ?? null,
                        ]);
                    } else {
                        // Optionally fetch PaymentIntent to verify - extra safety
                        // $pi = \Stripe\PaymentIntent::retrieve($session->payment_intent);
                        // if ($pi->status === 'succeeded') { ... }
                    }
                }
            }
        }

        // Return 200 to acknowledge receipt of the event
        return response('Webhook handled', 200);
    }
}

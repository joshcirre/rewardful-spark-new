<?php

namespace Rewardful\RewardfulSpark;

use Laravel\Cashier\Billable;

class UpdateStripePaymentMethod
{
    /**
     * {@inheritdoc}
     */
    public function handle($billable, array $data)
    {
        // Check if the billable model uses Cashier's Billable trait
        if (!in_array(Billable::class, class_uses_recursive($billable))) {
            throw new \Exception('The billable model must use the Billable trait provided by Laravel Cashier.');
        }

        // If the billable entity doesn't have a Stripe customer ID, create a new Stripe customer
        if (!$billable->hasStripeId()) {
            $billable->createAsStripeCustomer([
                'metadata' => [
                    'referral' => $data['referral'] ?? ''
                ]
            ]);
        }

        // Update the default payment method
        $billable->updateDefaultPaymentMethod($data['stripe_payment_method']);
    }
}

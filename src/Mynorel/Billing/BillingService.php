<?php
namespace Mynorel\Billing;

use Mynorel\Config\Config;

/**
 * BillingService: Handles subscriptions and payments.
 * Integrates with Chronicle for logging.
 */
class BillingService
{
    /**
     * Subscribe a user to a plan.
     */
    public static function subscribe($user, $plan): bool
    {
        // Only allow authenticated users to subscribe
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized subscription attempt", ['user' => $user, 'plan' => $plan]);
            throw new \Exception('Unauthorized');
        }
        // Validate plan
        if (empty($plan)) {
            self::log("Subscription failed: missing plan", ['user' => $user]);
            return false;
        }
        self::log("User $user subscribed to $plan");
        return true;
    }

    /**
     * Cancel a user's subscription.
     */
    public static function cancel($user, $plan): bool
    {
        // Only allow authenticated users to cancel
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized cancel attempt", ['user' => $user, 'plan' => $plan]);
            throw new \Exception('Unauthorized');
        }
        self::log("User $user canceled subscription to $plan");
        return true;
    }

    /**
     * Log a billing event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Billing] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}

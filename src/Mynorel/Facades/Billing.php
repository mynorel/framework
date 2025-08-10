<?php
namespace Mynorel\Facades;

use Mynorel\Billing\BillingService;

/**
 * Facade for Mynorel Billing feature.
 * @see BillingService
 */
class Billing
{
    public static function subscribe($user, $plan)
    {
        return BillingService::subscribe($user, $plan);
    }
}

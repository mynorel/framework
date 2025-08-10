<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Billing;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class BillingSubscribeCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'billing:subscribe'; }
    public function description(): string { return 'Subscribe a user to a plan.'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        $plan = $input['plan'] ?? null;
        if (!Author::can('billing.subscribe', $user)) {
            StylizedPrinter::warn('You do not have permission to subscribe.');
            Chronicle::warn('Unauthorized billing:subscribe attempt.');
            return 1;
        }
        if (!Validator::require($plan, 'plan', 'billing:subscribe')) {
            return 1;
        }
        Billing::subscribe($user, $plan);
        StylizedPrinter::poetic("$user subscribed to $plan.");
        Chronicle::note("$user subscribed to $plan.");
        return 0;
    }
}

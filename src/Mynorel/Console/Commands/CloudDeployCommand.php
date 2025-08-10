<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Cloud;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class CloudDeployCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'cloud:deploy'; }
    public function description(): string { return 'Deploy an app to a cloud provider.'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        $app = $input['app'] ?? null;
        $provider = $input['provider'] ?? null;
        if (!Author::can('cloud.deploy', $user)) {
            StylizedPrinter::warn('You do not have permission to deploy.');
            Chronicle::warn('Unauthorized cloud:deploy attempt.');
            return 1;
        }
        if (!Validator::require($app, 'app', 'cloud:deploy') || !Validator::require($provider, 'provider', 'cloud:deploy')) {
            return 1;
        }
        Cloud::deploy($app, $provider);
        StylizedPrinter::poetic("$app deployed to $provider.");
        Chronicle::note("$app deployed to $provider.");
        return 0;
    }
}

<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Api;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class ApiHandleCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'api:handle'; }
    public function description(): string { return 'Handle an API request.'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        $request = $input['request'] ?? null;
        if (!Validator::require($user, 'user', 'api:handle') || !Validator::require($request, 'request', 'api:handle')) {
            return 1;
        }
        if (!Author::can('api.handle', $user)) {
            StylizedPrinter::warn('You do not have permission to handle API requests.');
            Chronicle::warn('Unauthorized api:handle attempt.');
            return 1;
        }
        $response = Api::handle($request);
        StylizedPrinter::poetic("API response: " . json_encode($response));
        Chronicle::note("API request handled for user.");
        return 0;
    }
}

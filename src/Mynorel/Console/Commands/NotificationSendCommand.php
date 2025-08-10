<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Notification;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class NotificationSendCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'notification:send'; }
    public function description(): string { return 'Send a notification to a user.'; }
    public function execute(array $input, array &$output): int
    {
        $user = $input['user'] ?? null;
        $message = $input['message'] ?? null;
        if (!Author::can('notification.send', $user)) {
            StylizedPrinter::warn('You do not have permission to send notifications.');
            Chronicle::warn('Unauthorized notification:send attempt.');
            return 1;
        }
        if (!Validator::require($message, 'message', 'notification:send')) {
            return 1;
        }
        Notification::send($user, $message);
        StylizedPrinter::poetic("Notification sent to $user: $message");
        Chronicle::note("Notification sent to $user: $message");
        return 0;
    }
}

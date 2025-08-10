<?php
namespace Mynorel\Facades;

use Mynorel\Notification\NotificationService;

/**
 * Facade for Mynorel Notification feature.
 * @see NotificationService
 */
class Notification
{
    public static function send($user, $message)
    {
        return NotificationService::send($user, $message);
    }
}

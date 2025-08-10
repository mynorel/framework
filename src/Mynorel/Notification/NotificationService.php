<?php
namespace Mynorel\Notification;

use Mynorel\Config\Config;

/**
 * NotificationService: Handles in-app and email notifications.
 * Integrates with Chronicle for logging.
 */
class NotificationService
{
    /**
     * Send a notification to a user (in-app or email).
     */
    public static function send($to, $message, $channel = 'in-app'): bool
    {
        // Validate recipient and message
        if (empty($to) || empty($message)) {
            self::log("Notification send failed: missing recipient or message");
            return false;
        }
        // Only allow authenticated users to send notifications
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized notification send attempt");
            throw new \Exception('Unauthorized');
        }
        // In-app notification logic
        if ($channel === 'in-app') {
            // Store notification in a persistent store (stub)
            self::log("In-app notification sent to $to: $message");
            return true;
        }
        // Email notification logic
        if ($channel === 'email') {
            // Use mail() or a mailer service (stub)
            self::log("Email notification sent to $to: $message");
            return true;
        }
        self::log("Unknown notification channel: $channel");
        return false;
    }

    /**
     * Log a notification event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Notification] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}

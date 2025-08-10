<?php
namespace Mynorel\Media;

use Mynorel\Config\Config;

/**
 * MediaService: Handles file and image upload, organization, and serving.
 * Integrates with Chronicle for logging.
 */
class MediaService
{
    /**
     * Upload a file and return its storage path.
     */
    public static function upload($file): string
    {
        // Only allow authenticated users to upload
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized upload attempt");
            throw new \Exception('Unauthorized');
        }
        $storageDir = Config::get('media.storage_dir', __DIR__ . '/../../../public/media');
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }
        $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
        $path = rtrim($storageDir, '/') . '/' . $filename;
        if (isset($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
            if (move_uploaded_file($file['tmp_name'], $path)) {
                self::log("File uploaded: $filename");
                return $path;
            }
            self::log("Failed upload: $filename");
            return '';
        }
        self::log("Invalid upload: $filename");
        return '';
    }

    /**
     * List all media files in storage.
     */
    public static function list(): array
    {
        $storageDir = Config::get('media.storage_dir', __DIR__ . '/../../../public/media');
        if (!is_dir($storageDir)) return [];
        $files = array_diff(scandir($storageDir), ['.', '..']);
        return array_values($files);
    }

    /**
     * Log a media event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Media] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}

<?php
namespace Mynorel\Herald\Dashboard;

/**
 * HeraldDashboard: Real-time dashboard for Herald events and channels.
 */
class HeraldDashboard {
    /**
     * Render the dashboard (CLI or web).
     * If run via PHP built-in server, output HTML/JS for live updates.
     */
    public static function render() {
        if (php_sapi_name() === 'cli-server') {
            // Simple HTML/JS dashboard for live event streaming (scaffold)
            header('Content-Type: text/html; charset=utf-8');
            echo '<!DOCTYPE html><html><head><title>Herald Dashboard</title></head><body>';
            echo '<h2>📡 Herald Dashboard (Live)</h2>';
            echo '<div id="events"></div>';
            echo '<script>\n'
                . 'const ws = new WebSocket("ws://localhost:8080");\n'
                . 'ws.onmessage = function(e) {\n'
                . '  const data = JSON.parse(e.data);\n'
                . '  const div = document.getElementById("events");\n'
                . '  div.innerHTML += `<div><b>${data.channel}</b>: ${data.message}</div>`;\n'
                . '};\n'
                . '</script>';
            echo '</body></html>';
            exit;
        }
        // CLI fallback (simulated)
        $channels = [
            'story' => ['A new chapter begins!', 'Hero enters the scene.'],
            'chat' => ['User1: Hello!', 'User2: Welcome!']
        ];
        $out = "\n📡 Herald Dashboard (Simulated):\n";
        foreach ($channels as $channel => $events) {
            $out .= "Channel: $channel\n";
            foreach ($events as $event) {
                $out .= "  - $event\n";
            }
        }
        return $out;
    }
}

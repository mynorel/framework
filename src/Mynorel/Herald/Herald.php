<?php
namespace Mynorel\Herald;


use Workerman\Worker;
use Workerman\Connection\TcpConnection;

/**
 * Herald: Mynorel's narrative WebSocket layer (powered by Workerman).
 * Broadcasts, listens, and narrates real-time events and story fragments.
 */

class Herald
{
    protected $worker = null;
    protected array $clients = [];
    protected array $channels = [];
    protected array $sentinels = [];

    /**
     * Set a sentinel (permission callback) for a channel.
     * @param string $channel
     * @param callable $sentinel (function($connection, $payload): bool)
     */
    public function setSentinel(string $channel, callable $sentinel): void
    {
        $this->sentinels[$channel] = $sentinel;
    }

    /**
     * Start the Herald WebSocket server.
     * @param int $port
     */
    public function start(int $port = 8080): void
    {
        $this->worker = new Worker("websocket://0.0.0.0:$port");
        $this->worker->onConnect = function(TcpConnection $connection) {
            $this->clients[$connection->id] = $connection;
        };
        $this->worker->onMessage = function(TcpConnection $connection, $data) {
            $payload = json_decode($data, true);
            $channel = $payload['channel'] ?? 'default';
            $message = $payload['message'] ?? $data;
            // Sentinel check (auth/permission)
            if (isset($this->sentinels[$channel])) {
                $allowed = ($this->sentinels[$channel])($connection, $payload);
                if (!$allowed) {
                    $connection->send(json_encode([
                        'error' => 'Access denied by Sentinel',
                        'channel' => $channel
                    ]));
                    return;
                }
            }
            $this->channels[$channel][$connection->id] = $connection;
            // Broadcast to all in channel
            foreach ($this->channels[$channel] as $client) {
                $client->send(json_encode([
                    'channel' => $channel,
                    'message' => $message
                ]));
            }
        };
        $this->worker->onClose = function(TcpConnection $connection) {
            unset($this->clients[$connection->id]);
            foreach ($this->channels as $channel => &$clients) {
                unset($clients[$connection->id]);
            }
        };
        echo "[Herald] WebSocket server started on port $port\n";
        Worker::runAll();
    }

    /**
     * Broadcast a message to a channel.
     * @param string $channel
     * @param string $message
     */
    public function broadcast(string $channel, string $message): void
    {
        // This is a stub for CLI broadcast; in production, use a persistent process or IPC
        echo "[Herald] Broadcast to [$channel]: $message\n";
    }

    /**
     * Listen for messages on a channel (stub).
     * @param string $channel
     * @param callable $callback
     */
    public function listen(string $channel, callable $callback): void
    {
        // This is a stub for CLI listen; in production, use a persistent process or IPC
        echo "[Herald] Listening on [$channel]...\n";
    }
}

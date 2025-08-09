<?php
namespace Mynorel\Http;

class Request
{
    protected array $query;
    protected array $body;
    protected array $server;
    protected array $cookies;
    protected array $files;
    protected ?object $user;

    public function __construct(array $query = [], array $body = [], array $server = [], array $cookies = [], array $files = [], $user = null)
    {
        $this->query = $query ?: $_GET;
        $this->body = $body ?: $_POST;
        $this->server = $server ?: $_SERVER;
        $this->cookies = $cookies ?: $_COOKIE;
        $this->files = $files ?: $_FILES;
        $this->user = $user;
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        return strtok($uri, '?');
    }

    public function query(?string $key = null, $default = null)
    {
        if ($key === null) return $this->query;
        return $this->query[$key] ?? $default;
    }

    public function input(?string $key = null, $default = null)
    {
        if ($key === null) return $this->body;
        return $this->body[$key] ?? $default;
    }

    public function user()
    {
        return $this->user;
    }
}

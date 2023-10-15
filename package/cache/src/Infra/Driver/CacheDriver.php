<?php

namespace Epush\Cache\Infra\Driver;

use DateInterval;
use DateTimeInterface;
use Illuminate\Support\Facades\Cache;

class CacheDriver implements CacheDriverContract
{
    public function add(string $key, mixed $value, DateTimeInterface|DateInterval|int|null $ttl = null): bool
    {
        return Cache::add($key, $value, $ttl);
    }

    public function get(string|array $key, mixed $default = null): mixed
    {
        return Cache::get($key, $default);
    }

    public function many(array $keys): array
    {
        return Cache::many($keys);
    }

    public function put(array|string $key, mixed $value, DateTimeInterface|DateInterval|int|null $seconds): bool
    {
        return Cache::put($key, $value, $seconds);
    }

    public function putMany(array $values, DateTimeInterface|DateInterval|int|null $seconds): bool
    {
        return Cache::putMany($values, $seconds);
    }

    public function increment(string $key, mixed $value = 1): int|bool
    {
        return Cache::increment($key, $value);
    }

    public function decrement(string $key, mixed $value = 1): int|bool
    {
        return Cache::decrement($key, $value);
    }

    public function forever(string $key, mixed $value): bool
    {
        return Cache::forever($key, $value);
    }

    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }

    public function flush(): bool
    {
        return Cache::flush();
    }

    public function getPrefix(): string
    {
        return Cache::getPrefix();
    }
}
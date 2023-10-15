<?php

namespace Epush\Cache\Infra\Driver;

use DateInterval;
use DateTimeInterface;

interface CacheDriverContract
{
    public function add(string $key, mixed $value, DateTimeInterface|DateInterval|int|null $ttl = null): bool;

    public function get(string|array $key, mixed $default = null): mixed;

    public function many(array $keys): array;

    public function put(array|string $key, mixed $value, DateTimeInterface|DateInterval|int|null $seconds): bool;

    public function putMany(array $values, DateTimeInterface|DateInterval|int|null $seconds): bool;

    public function increment(string $key, mixed $value = 1): int|bool;

    public function decrement(string $key, mixed $value = 1): int|bool;

    public function forever(string $key, mixed $value): bool;

    public function forget(string $key): bool;

    public function flush(): bool;

    public function getPrefix(): string;

}
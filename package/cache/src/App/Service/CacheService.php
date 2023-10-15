<?php

namespace Epush\Cache\App\Service;

use DateInterval;
use DateTimeInterface;

use Epush\Cache\Infra\Driver\CacheDriverContract;
use Epush\Cache\App\Contract\CacheServiceContract;


class CacheService implements CacheServiceContract
{
    public function __construct(

        private CacheDriverContract $cacheDriver

    ) {}


    public function add(string $key, mixed $value, DateTimeInterface|DateInterval|int|null $ttl = null): bool
    {
        return $this->cacheDriver->add($key, $value, $ttl);
    }

    public function get(string|array $key, mixed $default = null): mixed
    {
        return $this->cacheDriver->get($key, $default);
    }

    public function many(array $keys): array
    {
        return $this->cacheDriver->many($keys);
    }

    public function put(array|string $key, mixed $value, DateTimeInterface|DateInterval|int|null $seconds): bool
    {
        return $this->cacheDriver->put($key, $value, $seconds);
    }

    public function putMany(array $values, DateTimeInterface|DateInterval|int|null $seconds): bool
    {
        return $this->cacheDriver->putMany($values, $seconds);
    }

    public function increment(string $key, mixed $value = 1): int|bool
    {
        return $this->cacheDriver->increment($key, $value);
    }

    public function decrement(string $key, mixed $value = 1): int|bool
    {
        return $this->cacheDriver->decrement($key, $value);
    }

    public function forever(string $key, mixed $value): bool
    {
        return $this->cacheDriver->forever($key, $value);
    }

    public function forget(string $key): bool
    {
        return $this->cacheDriver->forget($key);
    }

    public function flush(): bool
    {
        return $this->cacheDriver->flush();
    }

    public function getPrefix(): string
    {
        return $this->cacheDriver->getPrefix();
    }
}
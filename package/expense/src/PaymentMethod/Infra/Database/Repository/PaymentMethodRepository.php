<?php

namespace Epush\Expense\PaymentMethod\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Expense\PaymentMethod\Infra\Database\Model\PaymentMethod;
use Epush\Expense\PaymentMethod\Infra\Database\Repository\Contract\PaymentMethodRepositoryContract;

class PaymentMethodRepository implements PaymentMethodRepositoryContract
{
    public function __construct(

        private PaymentMethod $paymentMethod,
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->paymentMethod->all()->toArray();

        });
    }

    public function get(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->paymentMethod->findOrFail($id)->toArray();
        });
    }

    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->paymentMethod->create($client)->toArray();
        });
    }

    public function update(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $client = $this->paymentMethod->findOrFail($id);

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        });
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            return $this->paymentMethod->where('id', $id)->delete();

        }); 
    }

    public function getPaymentMethods(array $paymentMethodsID): array
    {
        return DB::transaction(function () use ($paymentMethodsID) {

            return $this->paymentMethod->whereIn('id', $paymentMethodsID)->get()->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $paymentMethod = $this->paymentMethod->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            $paymentMethod = $take >= 1000000000000 ? $paymentMethod->paginate($take, ['*'], 'page', 1) : $paymentMethod->paginate($take);
            return $paymentMethod->toArray();
        });
    }
}
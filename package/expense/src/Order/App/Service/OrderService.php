<?php

namespace Epush\Expense\Order\App\Service;


use Epush\Shared\Infra\Utils\WalletActions;

use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;
use Epush\Expense\PaymentMethod\App\Contract\PaymentMethodServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class OrderService implements OrderServiceContract
{
    public function __construct(

        private PaymentMethodServiceContract $paymentMethodService,
        private OrderDatabaseServiceContract $orderDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}


    public function list(int $take, int $partnerID = null): array
    {
        $orders = $this->orderDatabaseService->paginateOrders($take);

        $usersID = array_unique(array_column($orders['data'], 'user_id'));
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID, $partnerID)[0];

        $orders['data'] = tableWith($orders['data'], $clients, "user_id", "user_id", "client");

        if (! empty($partnerID)) {
            $orders['data'] = array_values(array_filter($orders['data'], function ($order) {
                return ! empty($order['client']);
            }));
        }

        $pricelistsID = array_unique(array_column($orders['data'], 'pricelist_id'));
        $pricelists = $this->communicationEngine->broadcast("core:pricelist:get-pricelists", $pricelistsID)[0];

        $orders['data'] = tableWith($orders['data'], $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($orders['data'], 'payment_method_id'));
        $paymentMethods = $this->paymentMethodService->getPaymentMethods($paymentMethodsID);
        $orders['data'] = tableWith($orders['data'], $paymentMethods, "payment_method_id");

        return $orders;
    }

    public function get(string $orderID): array
    {
        $order = [$this->orderDatabaseService->getOrder($orderID)];
        
        $usersID = array_unique(array_column($order, 'user_id'));
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID)[0];

        $order = tableWith($order, $clients, "user_id", "user_id", "client");

        $pricelistsID = array_unique(array_column($order, 'pricelist_id'));
        $pricelists = $this->communicationEngine->broadcast("core:pricelist:get-pricelists", $pricelistsID)[0];
        $order = tableWith($order, $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($order, 'payment_method_id'));
        $paymentMethods = $this->paymentMethodService->getPaymentMethods($paymentMethodsID);
        $order = tableWith($order, $paymentMethods, "payment_method_id");

        return $order[0];
    }

    public function add(string $action, array $order): array
    {
        $action =  in_array(strtolower($action), ["add", "refund"]) ? WalletActions::REFUND : WalletActions::DEDUCT;
        $order['deduct'] = ($action->value == "deduct");
        $this->communicationEngine->broadcast("core:client:update-client-wallet", $order["user_id"], $order["credit"], $action->value);
        $order = $this->orderDatabaseService->addOrder($order);
        $client = $this->communicationEngine->broadcast("core:client:get-client", $order['user_id'])[0];
        $order['balance'] = $client['balance'];
        $pricelist = $this->communicationEngine->broadcast("core:pricelist:get-pricelist", $order['pricelist_id'])[0];
        $order['price'] = $pricelist['price'];
        $order['messages_count'] = floor($order['balance'] / $order['price']);
        return $order;
    }

    public function update(string $orderID, array $order): array
    {
        return $this->orderDatabaseService->updateOrder($orderID, $order);
    }

    public function getClientOrders(string $userID): array
    {
        return $this->orderDatabaseService->getClientOrders($userID);
    }

    public function getClientLatestOrder(string $userID): array
    {
        return $this->orderDatabaseService->getClientLatestOrder($userID);
    }

    public function getOrdersByID(array $ordersID, int $take = 10): array
    {
        $orders = $this->orderDatabaseService->getOrdersByID($ordersID, $take);

        $usersID = array_unique(array_column($orders['data'], 'user_id'));
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID)[0];
        $orders['data'] = tableWith($orders['data'], $clients, "user_id", "user_id", "client");

        $pricelistsID = array_unique(array_column($orders['data'], 'pricelist_id'));
        $pricelists = $this->communicationEngine->broadcast("core:pricelist:get-pricelists", $pricelistsID)[0];
        $orders['data'] = tableWith($orders['data'], $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($orders['data'], 'payment_method_id'));
        $paymentMethods = $this->paymentMethodService->getPaymentMethods($paymentMethodsID);
        $orders['data'] = tableWith($orders['data'], $paymentMethods, "payment_method_id");

        return $orders;
    }

    public function getOrdersByUsersID(array $usersID, int $take = 10): array
    {
        return $this->orderDatabaseService->getOrdersByUsersID($usersID, $take);
    }

    public function getOrdersByPricelistsID(array $pricelistsID, int $take = 10): array
    {
        return $this->orderDatabaseService->getOrdersByPricelistsID($pricelistsID, $take);
    }

    public function getOrdersByPaymentMethodsID(array $paymentMethodsID, int $take = 10): array
    {
        return $this->orderDatabaseService->getOrdersByPaymentMethodsID($paymentMethodsID, $take);
    }

    public function searchColumn(string $column, string $value, int $take = 10, int $partnerID = null): array
    {   
        switch ($column) {
            case "sales":
            case "sales_name":
                $sales = $this->communicationEngine->broadcast("core:sales:search-column", "name", $value, 1000000000000)[0];
                $salesID = array_column($sales['data'], 'id');
                $clients = $this->communicationEngine->broadcast("core:client:get-clients-by-sales-id", $salesID)[0];
                $usersID = array_column($clients, 'user_id');
                $orders = $this->getOrdersByUsersID($usersID, $take);
                break;

            case "company":
            case "company_name":
                $clients = $this->communicationEngine->broadcast("core:client:search-column", "company_name", $value, true, 1000000000000)[0];
                $usersID = array_column($clients['data'], 'user_id');
                $orders = $this->getOrdersByUsersID($usersID, $take);
                break;

            case "pricelist":
            case "pricelist_name":
                $pricelists = $this->communicationEngine->broadcast("core:pricelist:search-column", "name", $value, 1000000000000)[0];
                $pricelistsID = array_column($pricelists['data'], 'id');
                $orders = $this->getOrdersByPricelistsID($pricelistsID, $take);
                break;
        
            case "payment_method":
            case "payment_method_name":
                $paymentMethods = $this->paymentMethodService->searchColumn("name", $value, 1000000000000);
                $paymentMethodsID = array_column($paymentMethods['data'], 'id');
                $orders = $this->getOrdersByPaymentMethodsID($paymentMethodsID, $take);
                break;

            default:
                $orders = $this->orderDatabaseService->searchOrderColumn($column, $value, $take);
        }

        $usersID = array_unique(array_column($orders['data'], 'user_id'));
        $clients = $this->communicationEngine->broadcast("core:client:get-clients", $usersID, $partnerID)[0];
        $orders['data'] = tableWith($orders['data'], $clients, "user_id", "user_id", "client");

        if (! empty($partnerID)) {
            $orders['data'] = array_values(array_filter($orders['data'], function ($order) {
                return ! empty($order['client']);
            }));
        }

        $pricelistsID = array_unique(array_column($orders['data'], 'pricelist_id'));
        $pricelists = $this->communicationEngine->broadcast("core:pricelist:get-pricelists", $pricelistsID)[0];
        $orders['data'] = tableWith($orders['data'], $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($orders['data'], 'payment_method_id'));
        $paymentMethods = $this->paymentMethodService->getPaymentMethods($paymentMethodsID);
        $orders['data'] = tableWith($orders['data'], $paymentMethods, "payment_method_id");

        return $orders;
    }
}
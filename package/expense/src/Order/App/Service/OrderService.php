<?php

namespace Epush\Expense\Order\App\Service;


use Epush\Shared\Infra\Utils\WalletActions;

use Epush\Shared\App\Contract\CoreServiceContract;
use Epush\Shared\App\Contract\ExpenseServiceContract;

use Epush\Shared\App\Contract\MailServiceContract;
use Epush\Expense\Order\App\Contract\OrderServiceContract;
use Epush\Expense\Order\App\Contract\OrderDatabaseServiceContract;

class OrderService implements OrderServiceContract
{
    public function __construct(

        private MailServiceContract $mailService,
        private CoreServiceContract $coreService,
        private ExpenseServiceContract $expenseService,
        private OrderDatabaseServiceContract $orderDatabaseService

    ) {}


    public function list(int $take): array
    {
        $orders = $this->orderDatabaseService->paginateOrders($take);

        $usersID = array_unique(array_column($orders['data'], 'user_id'));
        $clients = $this->coreService->getClients($usersID);
        $orders['data'] = tableWith($orders['data'], $clients, "user_id", "user_id", "client");

        $pricelistsID = array_unique(array_column($orders['data'], 'pricelist_id'));
        $pricelists = $this->coreService->getPricelists($pricelistsID);
        $orders['data'] = tableWith($orders['data'], $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($orders['data'], 'payment_method_id'));
        $paymentMethods = $this->expenseService->getPaymentMethods($paymentMethodsID);
        $orders['data'] = tableWith($orders['data'], $paymentMethods, "payment_method_id");

        return $orders;
    }

    public function get(string $orderID): array
    {
        $order = [$this->orderDatabaseService->getOrder($orderID)];
        
        $usersID = array_unique(array_column($order, 'user_id'));
        $clients = $this->coreService->getClients($usersID);
        $order = tableWith($order, $clients, "user_id", "user_id", "client");

        $pricelistsID = array_unique(array_column($order, 'pricelist_id'));
        $pricelists = $this->coreService->getPricelists($pricelistsID);
        $order = tableWith($order, $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($order, 'payment_method_id'));
        $paymentMethods = $this->expenseService->getPaymentMethods($paymentMethodsID);
        $order = tableWith($order, $paymentMethods, "payment_method_id");

        return $order[0];
    }

    public function add(string $action, array $order): array
    {
        $action =  in_array(strtolower($action), ["add", "refund"]) ? WalletActions::REFUND : WalletActions::DEDUCT;
        $this->coreService->updateClientWallet($order["user_id"], $order["credit"], $action->value);
        $order = $this->orderDatabaseService->addOrder($order);
        $client = $this->coreService->getClient($order['user_id']);
        $order['balance'] = $client['balance'];
        $pricelist = $this->coreService->getPricelist($order['pricelist_id']);
        $order['price'] = $pricelist['price'];
        $order['messages_count'] = floor($order['balance'] / $order['price']);
        $this->mailService->sendOrderAddedMail($client['email'], $order);
        return $order;
    }

    public function getClientOrders(string $userID): array
    {
        return $this->orderDatabaseService->getClientOrders($userID);
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

    public function searchColumn(string $column, string $value, int $take = 10): array
    {   
        switch ($column) {
            case "sales":
            case "sales_name":
                $sales = $this->coreService->searchSalesColumn("name", $value, 1000000000000);
                $salesID = array_column($sales['data'], 'id');
                $clients = $this->coreService->getClientsBySalesID($salesID);
                $usersID = array_column($clients, 'user_id');
                $orders = $this->getOrdersByUsersID($usersID, $take);
                break;

            case "company":
            case "company_name":
                $clients = $this->coreService->searchClientColumn("company_name", $value, 1000000000000);
                $usersID = array_column($clients['data'], 'user_id');
                $orders = $this->getOrdersByUsersID($usersID, $take);
                break;

            case "pricelist":
            case "pricelist_name":
                $pricelists = $this->coreService->searchPricelistColumn("name", $value, 1000000000000);
                $pricelistsID = array_column($pricelists['data'], 'id');
                $orders = $this->getOrdersByPricelistsID($pricelistsID, $take);
                break;
        
            case "payment_method":
            case "payment_method_name":
                $paymentMethods = $this->expenseService->searchPaymentMehtodColumn("name", $value, 1000000000000);
                $paymentMethodsID = array_column($paymentMethods['data'], 'id');
                $orders = $this->getOrdersByPaymentMethodsID($paymentMethodsID, $take);
                break;

            default:
                $orders = $this->orderDatabaseService->searchOrderColumn($column, $value, $take);
        }

        $usersID = array_unique(array_column($orders['data'], 'user_id'));
        $clients = $this->coreService->getClients($usersID);
        $orders['data'] = tableWith($orders['data'], $clients, "user_id", "user_id", "client");

        $pricelistsID = array_unique(array_column($orders['data'], 'pricelist_id'));
        $pricelists = $this->coreService->getPricelists($pricelistsID);
        $orders['data'] = tableWith($orders['data'], $pricelists, "pricelist_id");

        $paymentMethodsID = array_unique(array_column($orders['data'], 'payment_method_id'));
        $paymentMethods = $this->expenseService->getPaymentMethods($paymentMethodsID);
        $orders['data'] = tableWith($orders['data'], $paymentMethods, "payment_method_id");

        return $orders;
    }
}
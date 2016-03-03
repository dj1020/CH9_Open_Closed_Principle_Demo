<?php
/**
 * Author: twinkledj
 * Date: 3/3/16
 */

namespace App\MyCart\Validators;


use App\MyCart\Order;
use App\MyCart\Repository\OrderRepository;
use Exception;

class RecentOrderValidator implements OrderValidatorInterface
{
    protected $orders;

    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }


    public function validate(Order $order)
    {
        $recent = $this->orders->getRecentOrderCount($order);

        if ($recent > 0) {
            throw new Exception('Duplicate order likely.');
        }
    }
}
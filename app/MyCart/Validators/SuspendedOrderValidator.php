<?php
/**
 * Author: twinkledj
 * Date: 3/3/16
 */

namespace App\MyCart\Validators;


use App\MyCart\Order;
use App\MyCart\Repository\OrderRepository;
use Exception;

class SuspendedOrderValidator implements OrderValidatorInterface
{
    protected $orders;

    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    public function validate(Order $order)
    {
        if ($order->getAccount()->isSuspended()) {
            throw new Exception('Suspended account may not order.');
        }
    }
}
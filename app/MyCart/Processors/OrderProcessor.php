<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Processors;


use App\MyCart\Billers\BillerInterface;
use App\MyCart\Order;
use App\MyCart\Repository\OrderRepository;
use Carbon\Carbon;
use DB;
use Exception;

class OrderProcessor
{
    protected $orders;
    private   $validators;

    /**
     * OrderProcessor constructor.
     */
    public function __construct(
        BillerInterface $biller,
        OrderRepository $orders,
        array $validators = []
    )
    {
        $this->biller = $biller;
        $this->orders = $orders;
        $this->validators = $validators;
    }

    public function process(Order $order)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($order);
        }

        $this->biller->bill($order->getAccount()->id, $order->getAmount());

        $id = $this->orders->logOrder($order);

        return $id;
    }
}
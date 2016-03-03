<?php
/**
 * Author: twinkledj
 * Date: 3/3/16
 */

namespace App\MyCart\Validators;

use App\MyCart\Order;

interface OrderValidatorInterface
{
    public function validate(Order $order);
}
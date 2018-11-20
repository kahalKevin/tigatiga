<?php

namespace App\Helpers;

use Midtrans;

class MidtransHelper
{
    public static function purchase($order_detail)
    {
        $transaction_details = [
            'order_id' => $order_detail['order_id'],
            'gross_amount' => $order_detail['amount']
        ];
        
        $customer_details = [
            'first_name' => $order_detail['customer_name'],
            'email' => $order_detail['customer_email'],
            'phone' => $order_detail['customer_phone']
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        return Midtrans::getSnapToken($transaction_data);
    }
}

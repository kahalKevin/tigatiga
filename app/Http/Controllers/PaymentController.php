<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\OrderPaymentGatewayHistory;

class PaymentController extends Controller
{
    public function paymentNotification(Request $request) {
        $notification = $request->all();
        $payment_type = $notification['payment_type'];
        $response = null;
        $order = Order::find($notification['order_id']);

        switch ($payment_type) {
            case 'bank_transfer':
                $response = $this->bankTransferNotification($notification, $order);
                break;
            case 'credit_card':
                $response = $this->creditCardNotification($notification, $order);
                break;
            default:
                break;
        }

        return response()->api($response);
    }

    private function creditCardNotification($notification, $order) {
        $order->status_id =  "STATUSORDER1";
        $order->_payment_at = date("Y-m-d H:i:s");
        $order->payment_gateway_id = "PAYMENTGW01";
        $order->payment_method_id = "PAYMENTMETHOD02";
        $order->payment_gateway_trx_ref_no = $notification["transaction_id"];
        $order->payment_gateway_callback_status = $notification["transaction_status"];
        $order->payment_gateway_callback_raw = json_encode($notification);
        $order->payment_gateway_callback_date = $notification["transaction_time"];
        $order->save();

        $order_payment_history = new OrderPaymentGatewayHistory;
        
        $order_payment_history->order_payment_gateway_history_no = $notification["transaction_id"];
        $order_payment_history->order_no = $order->id;
        $order_payment_history->payment_gateway_callback_status = $notification["transaction_status"];
        $order_payment_history->payment_gateway_callback_raw = json_encode($notification);
        $order_payment_history->payment_gateway_callback_date = date("Y-m-d H:i:s");
        $order_payment_history->create_date = date("Y-m-d H:i:s");
        $order_payment_history->save();

        return null;
    }

    private function bankTransferNotification($notification, $order) {
        $order->status_id =  "STATUSORDER1";
        $order->_payment_at = date("Y-m-d H:i:s");
        $order->payment_gateway_id = "PAYMENTGW01";
        $order->payment_method_id = "PAYMENTMETHOD03";
        $order->payment_gateway_trx_ref_no = $notification["transaction_id"];
        $order->payment_gateway_callback_status = $notification["transaction_status"];
        $order->payment_gateway_callback_raw = json_encode($notification);
        $order->payment_gateway_callback_date = $notification["transaction_time"];
        $order->save();

        return null;
    }
}

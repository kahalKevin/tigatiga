<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\OrderPaymentGatewayHistory;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function paymentNotification(Request $request) {
        $notification = $request->all();
        $status = $notification['transaction_status'];
        if('pending' == $status){
            return;
        }
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
        $status = $this->getStatusPayment($notification);
        if($status == 'STATUSORDER0' || ($order->status_id != 'STATUSORDER0' && $order->status_id != 'STATUSORDER10')){
            return null;
        }

        $order->status_id =  $status;
        $order->_payment_at = date("Y-m-d H:i:s");
        $order->payment_gateway_id = "PAYMENTGW01";
        $order->payment_method_id = "PAYMENTMETHOD02";
        $order->payment_gateway_trx_ref_no = $notification["transaction_id"];
        $order->payment_gateway_callback_status = $notification["transaction_status"];
        $order->payment_gateway_callback_raw = json_encode($notification);
        $order->payment_gateway_callback_date = $notification["transaction_time"];
        $order->save();

        if($order->status_id == 'STATUSORDER1'){
            $this->countBuyProduct($order->id);
        }

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
        $status = $this->getStatusPayment($notification);
        if($status == 'STATUSORDER0' || ($order->status_id != 'STATUSORDER0' && $order->status_id != 'STATUSORDER10')){
            return null;
        }

        $order->status_id =  $status;
        $order->_payment_at = date("Y-m-d H:i:s");
        $order->payment_gateway_id = "PAYMENTGW01";
        $order->payment_method_id = "PAYMENTMETHOD01";
        $order->payment_gateway_trx_ref_no = $notification["transaction_id"];
        $order->payment_gateway_callback_status = $notification["transaction_status"];
        $order->payment_gateway_callback_raw = json_encode($notification);
        $order->payment_gateway_callback_date = $notification["transaction_time"];
        $order->save();

        if($order->status_id == 'STATUSORDER1'){
            $this->countBuyProduct($order->id);
        }

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

    public function pendingPayment(Request $request){
        $currentOrder = Order::query()
            ->where('id', $request->orderId)
            ->where('status_id', 'STATUSORDER0')
            ->first();
        $paymentMethod = ($request->paymentType=="bank_transfer") ? "PAYMENTMETHOD01" : "PAYMENTMETHOD02";
        $currentOrder->status_id = 'STATUSORDER10';
        $currentOrder->payment_gateway_va_number = $request->accountVa;
        $currentOrder->payment_method_id = $paymentMethod;
        $currentOrder->payment_gateway_id = "PAYMENTGW01";
        $currentOrder->_payment_at = Carbon::now();

        $currentOrder->save();
    }

    public function ccSuccess(Request $request){
        $orderId = $request->orderId;
         return view('order.thanks-cc', compact('orderId'));
    }

    private function getStatusPayment($notification)
    {
        $status = "STATUSORDER0";

        if ($notification['transaction_status'] == 'settlement' || 
            $notification['transaction_status'] == 'capture') {
            if ($notification['fraud_status'] == 'challenge') {
              $status = "STATUSORDER7";
            } else if ($notification['fraud_status'] == 'accept') {
              $status = "STATUSORDER1";
            }
        } elseif ($notification['transaction_status'] == 'cancel') {
            $status = "STATUSORDER8";
        } elseif ($notification['fraud_status'] == 'deny') {
            $status = "STATUSORDER6";
        }

        return $status;
    }

    private function countBuyProduct($orderId){
        $details = OrderDetail::query()
            ->where('order_id', $orderId)
            ->get();
        foreach ($details as $detail) {
            $product = $detail->products;
            $product->_count_buy = $product->_count_buy + $detail->_qty;
            $product->save();
        }
    }
}

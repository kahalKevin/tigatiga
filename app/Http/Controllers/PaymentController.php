<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentNotification(Request $request) {
        $payment_type = $request->input('payment_type');
        $notification = $request->all();
        $response = null;

        switch ($payment_type) {
            case 'bank_transfer':
                $response = this.bankTransferNotification($notification);
                break;
            case 'credit_card':
                $response = this.creditCardNotification($notification);
                break;
            default:
                break;
        }

        return response()->json();
    }

    private function creditCardNotification($notification) {

    }

    private function bankTransferNotification($notification) {

    }
}

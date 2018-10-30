<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentNotification(Request $request) {
        $notification = $request->all();
        $payment_type = $notification['payment_type'];
        $response = null;

        switch ($payment_type) {
            case 'bank_transfer':
                $response = bankTransferNotification($notification);
                break;
            case 'credit_card':
                $response = creditCardNotification($notification);
                break;
            default:
                break;
        }

        return response()->api($response);
    }

    private function creditCardNotification($notification) {
        return null;
    }

    private function bankTransferNotification($notification) {
        return null;
    }
}

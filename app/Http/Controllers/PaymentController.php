<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createRazorpayPayment(Request $request)
    {
        
        $keyId = 'rzp_test_OKVX8tNzUFDmQO';
        $keySecret = 't5VfWH9T0wLuWR6twvokpCOV';
        $api = new Api($keyId, $keySecret);
        $total = $request->total;
        $totalRS = $total * 100 ;
        // Create a Razorpay payment
        $paymentData = [
            'amount' => $totalRS, 
            'currency' => 'INR', 
   
        ];

        try {
            
            $payment = $api->order->create($paymentData);
           
            return response()->json([
                'id' => $payment->id,
                'amount' => $payment->amount,
                'currency' => $payment->currency,
               
            ]);
        } catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

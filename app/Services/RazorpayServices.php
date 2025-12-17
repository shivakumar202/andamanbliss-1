<?php

namespace App\Services;

use App\Models\RazorpayTransactions;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorpayServices
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder($amount, $currency = 'INR', $receipt = null)
    {
        try {
            $order = $this->api->order->create([
                'amount' => $amount * 100, 
                'currency' => $currency,
                'receipt' => $receipt ?? uniqid(),
            ]);
            return $order;
        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function verifyPaymentSignature($attributes)
    {
        try {
            $this->api->utility->verifyPaymentSignature($attributes);
            return ['verified' => true];
        } catch (Exception $e) {
            return [
                'verified' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Fetch payment details from Razorpay
     */
    public function fetchPaymentDetails($paymentId)
    {
        try {
            $payment = $this->api->payment->fetch($paymentId);
            return $payment;
        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}

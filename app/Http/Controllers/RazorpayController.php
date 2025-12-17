<?php


// RazorpayController.php
namespace App\Http\Controllers;

use App\Models\RazorpayTransactions;
use App\Services\RazorpayServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    protected $razorpayService;


    public function __construct(RazorpayServices $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function index()
    {

        $payments = session('payments');

        if (!$payments) {
            return redirect()->back()->with('error', 'Payment details are missing.');
        }
        $order = $this->razorpayService->createOrder($payments['amount'], 'INR', $payments['purpose']);

        if (isset($order['error'])) {
            return redirect()->back()->with('error', 'Failed to create Razorpay order: ' . $order['message']);
        }

        $transaction = RazorpayTransactions::create([
            'purpose' => $payments['purpose'],
            'booking_id' => $payments['booking_id'],
            'name' => $payments['name'],
            'email' => $payments['email'],
            'phone' => $payments['mobile'],
            'payment_id' => null,
            'order_id' => $order['id'],
            'currency' => 'INR',
            'amount' => $payments['amount'],
            'mode' => 'test',
            'json_response' => json_encode($order),
        ]);

        if ($transaction) {

            return view('razorpay.index', [
                'order' => $order,
                'payments' => $payments,
                'razorpayKey' => config('services.razorpay.key'),
            ]);
        }
    }
    public function verifyPayment(Request $request)
    {
        

        $paymentId = $request->razorpay_payment_id;
        $orderId = $request->razorpay_order_id;
        $signature = $request->razorpay_signature;

        $isValid = $this->verifyPaymentSignature($paymentId, $orderId, $signature);

        if ($isValid) {

            $payment = RazorpayTransactions::where('order_id',$orderId)->first();
            $payment->update([
                'payment_id' => $paymentId,
                'status' => 'Paid',
            ]);
            session()->flush();
            return response()->json(['success' => true,'message' => 'Payment verified successfully','token' => $payment->booking_id]);
        } else {
            session()->flush();
            return response()->json(['success' => false, 'message' => 'Payment verification failed']);
        }
    }

    private function verifyPaymentSignature($paymentId, $orderId, $signature)
    {
        $razorpaySecretKey = env('RAZORPAY_API_SECRET');
        $generatedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $razorpaySecretKey);

        return hash_equals($generatedSignature, $signature);
    }
}

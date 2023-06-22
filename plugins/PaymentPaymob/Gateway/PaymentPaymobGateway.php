<?php
namespace Plugins\PaymentPaymob\Gateway;

use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Models\Payment;
use Validator;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;

class PaymentPaymobGateway extends \Modules\Booking\Gateways\BaseGateway
{
    protected $id   = 'paymob_gateway';
    public    $name = 'Paymob';
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Paymob?')
            ],
            /*[
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("Paymob"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'input',
                'id'    => 'paymob_account_number',
                'label' => __('Account Number'),
            ],
            */ 
            /*[
                'type'  => 'input',
                'id'    => 'live_paymob_url',
                'label' => __('Live Paymob Url'),
            ],*/
            [
                'type'  => 'input',
                'id'    => 'live_paymob_api_key',
                'label' => __('Live Secret api'),
            ],
            [
                'type'  => 'input',
                'id'    => 'live_paymob_iframe_id',
                'label' => __('Live iframe id'),
            ],
            [
                'type'  => 'input',
                'id'    => 'live_paymob_integration_id',
                'label' => __('Live integration id'),
            ],
            [
                'type'  => 'input',
                'id'    => 'live_paymob_hmac',
                'label' => __('Live hmac'),
            ],


            /*[
                'type'  => 'checkbox',
                'id'    => 'paymob_enable_sandbox',
                'label' => __('Enable Sandbox Mode'),
            ],
            [
                'type'  => 'input',
                'id'    => 'testing_paymob_url',
                'label' => __('Testing Paymob Url'),
            ],
            [
                'type'  => 'input',
                'id'    => 'testing_paymob_api_key',
                'label' => __('Testing Secret api'),
            ],
            [
                'type'  => 'input',
                'id'    => 'testing_paymob_integration_id',
                'label' => __('Testing integration id'),
            ],*/
            
        ];
    }

    public function process(Request $request, $booking, $service)
    {

        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {

            throw new Exception(__("Booking status does need to be paid"));
        }
        if (!$booking->total) {
            throw new Exception(__("Booking total is zero. Can not process payment gateway!"));
        }

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;
        $payment->status = 'draft';
        $payment->save();
 

         $response = \Http::withHeaders([
            'content-type' => 'application/json'
         ])->post('https://accept.paymobsolutions.com/api/auth/tokens',[
                "api_key"=>$this->getOption('live_paymob_api_key')
         ]);
         $json=$response->json();
         $response_final=\Http::withHeaders([
            'content-type' => 'application/json'
         ])->post('https://accept.paymobsolutions.com/api/ecommerce/orders',[
                "auth_token"=>$json['token'], 
                "delivery_needed"=>"false",
                "merchant_order_id"=>$booking->code,
                "amount_cents"=>(float)$booking->pay_now,
                "items"=>[
                ]
          ]);
          $json_final=$response_final->json();
    
         $response_final_final=\Http::withHeaders([
            'content-type' => 'application/json'
         ])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys',[
                "auth_token"=>$json['token'], 
                "expiration"=> 36000, 
                "amount_cents"=>(float)$booking->pay_now*100,
                "order_id"=>$json_final['id'],
                "billing_data"=>[
                    "apartment"=> "NA", 
                    "email"=> $booking->email, 
                    "floor"=> "NA", 
                    "first_name"=> $booking->first_name, 
                    "street"=> "NA", 
                    "building"=> "NA", 
                    "phone_number"=> "01234567890",//$booking->phone , 
                    "shipping_method"=> "NA", 
                    "postal_code"=> "NA", 
                    "city"=> "NA", 
                    "country"=> "NA", 
                    "last_name"=> "ahmed" ,//$booking->last_name, 
                    "state"=> "NA" 
                ],
                "currency"=>"EGP",
                "integration_id"=>$this->getOption('live_paymob_integration_id')
        ]);
        $response_final_final_json=$response_final_final->json();
        $booking->status = $booking::UNPAID;
        $booking->payment_id = $payment->id;
        $booking->save();

        response()->json(['url'=>"https://accept.paymobsolutions.com/api/acceptance/iframes/".$this->getOption('live_paymob_iframe_id')."?payment_token=".$response_final_final_json['token'] ])->send();


 
        
    }

    public function processNormal($payment)
    {
       /* $payment->payment_gateway = $this->id;
        $data = $this->handlePurchaseDataNormal($payment,\request());

        if ($this->getOption('paymob_enable_sandbox')) {
            $checkout_url_sandbox = 'https://sandbox.2checkout.com/checkout/purchase';
        } else {
            $checkout_url_sandbox = 'https://www.2checkout.com/checkout/purchase';
        }
        $twoco_args = http_build_query($data, '', '&');

        return [true,'',$checkout_url_sandbox . "?" . $twoco_args];*/
    }

    public function handlePurchaseData($data, $booking, $request)
    {
        $paymob_args = array();
        $paymob_args['sid'] = $this->getOption('paymob_account_number');
        $paymob_args['paypal_direct'] = 'Y';
        $paymob_args['cart_order_id'] = $booking->code;
        $paymob_args['merchant_order_id'] = $booking->code;
        $paymob_args['total'] = (float)$booking->pay_now;
        $paymob_args['return_url'] = $this->getCancelUrl() . '?c=' . $booking->code;
        $paymob_args['x_receipt_link_url'] = $this->getReturnUrl() . '?c=' . $booking->code;
        $paymob_args['currency_code'] = setting_item('currency_main');
        $paymob_args['card_holder_name'] = $request->input("first_name") . ' ' . $request->input("last_name");
        $paymob_args['street_address'] = $request->input("address_line_1");
        $paymob_args['street_address2'] = $request->input("address_line_1");
        $paymob_args['city'] = $request->input("city");
        $paymob_args['state'] = $request->input("state");
        $paymob_args['country'] = $request->input("country");
        $paymob_args['zip'] = $request->input("zip_code");
        $paymob_args['phone'] = "";
        $paymob_args['email'] = $request->input("email");
        $paymob_args['lang'] = app()->getLocale();
        return $paymob_args;
    }
    public function handlePurchaseDataNormal($payment, $request)
    {
        $paymob_args = array();
        $paymob_args['sid'] = $this->getOption('paymob_account_number');
        $paymob_args['paypal_direct'] = 'Y';
        $paymob_args['cart_order_id'] = $payment->code;
        $paymob_args['merchant_order_id'] = $payment->code;
        $paymob_args['total'] = (float)$payment->amount;
        $paymob_args['return_url'] = $this->getCancelUrl(true) . '?pid=' . $payment->code;
        $paymob_args['x_receipt_link_url'] = $this->getReturnUrl(true) . '?pid=' . $payment->code;
        $paymob_args['currency_code'] = setting_item('currency_main');
//        $paymob_args['card_holder_name'] = $request->input("first_name") . ' ' . $request->input("last_name");
//        $paymob_args['street_address'] = $request->input("address_line_1");
//        $paymob_args['street_address2'] = $request->input("address_line_1");
//        $paymob_args['city'] = $request->input("city");
//        $paymob_args['state'] = $request->input("state");
//        $paymob_args['country'] = $request->input("country");
//        $paymob_args['zip'] = $request->input("zip_code");
//        $paymob_args['phone'] = "";
//        $paymob_args['email'] = $request->input("email");
        $paymob_args['lang'] = app()->getLocale();
        return $paymob_args;
    }


 /*   public function getDisplayHtml()
    {
        return $this->getOption('html', '');
    }*/

    public function confirmPayment(Request $request)
    {



 
        if($request["is_3d_secure"]=="false"){
            //['alert' => "عفواً البطاقة الخاصة بك غير مؤمنة بحماية 3D برجاء الرجوع الى البنك", 'alert-type' => "warning"]
        }
        else if($request["success"]=="false"){
            //['alert' => "عملية غير مكتملة", 'alert-type' => "warning"]
        }


        if(
            $request["success"]=="true" && 
            $request["pending"]=="false" &&  
            $request['error_occured'] =="false" &&  
            $request['is_refund']=="false" && 
            $request['order'] !=null &&
            $this->verify_paymob( $request ) == $request['hmac']
        ){

            //$payment = \Modules\Booking\Models\Payment::where('code',$request['merchant_order_id'])->firstOrFail();
            $booking = \Modules\Booking\Models\Booking::where('code',$request['merchant_order_id'])->firstOrFail();
            $payment = $booking->payment;
            if ($payment) {
                $payment->status = 'completed';
                $payment->logs = \GuzzleHttp\json_encode($request);
                $payment->save();
            }
            try {
                $booking->paid += (float)$booking->pay_now;
                $booking->markAsPaid();
            } catch (\Swift_TransportException $e) {
                Log::warning($e->getMessage());
            }
            return redirect($booking->getDetailUrl())->with("success", __("You payment has been processed successfully"));
        }else{ 

            $payment = $booking->payment;
            if ($payment) {
                $payment->status = 'fail';
                $payment->logs = \GuzzleHttp\json_encode($request);
                $payment->save();
            }
            try {
                $booking->markAsPaymentFailed();
            } catch (\Swift_TransportException $e) {
                Log::warning($e->getMessage());
            }
            return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
        } 



        /*$c = $request->query('c');
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {
            $compare_string = $this->getOption('paymob_secret_word') . $this->getOption('paymob_account_number') . $request->input("order_number") . $request->input("total");
            $compare_hash1 = strtoupper(md5($compare_string));
            $compare_hash2 = $request->input("key");
            if ($compare_hash1 != $compare_hash2) {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'fail';
                    $payment->logs = \GuzzleHttp\json_encode($request->input());
                    $payment->save();
                }
                try {
                    $booking->markAsPaymentFailed();
                } catch (\Swift_TransportException $e) {
                    Log::warning($e->getMessage());
                }
                return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
            } else {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'completed';
                    $payment->logs = \GuzzleHttp\json_encode($request->input());
                    $payment->save();
                }
                try {
                    $booking->paid += (float)$booking->pay_now;
                    $booking->markAsPaid();
                } catch (\Swift_TransportException $e) {
                    Log::warning($e->getMessage());
                }
                return redirect($booking->getDetailUrl())->with("success", __("You payment has been processed successfully"));
            }
        }
        if (!empty($booking)) {
            return redirect($booking->getDetailUrl(false));
        } else {
            return redirect(url('/'));
        }*/
    }
    public function confirmNormalPayment()
    {
        $request = request()->all();
        $c=$request['merchant_order_id'];
        $payment = Payment::where('code', $c)->first();
        if (!empty($payment) and in_array($payment->status,['draft'])) {
            if ($this->verify_paymob($request)) {
                return $payment->markAsCompleted();
            } else {
                return $payment->markAsFailed();
            }
        }
        return [false]; 
    }
    public function verify_paymob($request){
        $string = $request['amount_cents'].$request['created_at'].$request['currency'].$request['error_occured'].$request['has_parent_transaction'].$request['id'].$request['integration_id'].$request['is_3d_secure'].$request['is_auth'].$request['is_capture'].$request['is_refunded'].$request['is_standalone_payment'].$request['is_voided'].$request['order'].$request['owner'].$request['pending'].$request['source_data_pan'].$request['source_data_sub_type'].$request['source_data_type'].$request['success']; 
        return hash_hmac('sha512', $string,$this->getOption('live_paymob_hmac'));
    }
    public function cancelPayment(Request $request)
    {

/*
        https://accept.paymob.com/api/acceptance/void_refund/refund
        $c = $request->query('c');
        $booking = Booking::where('code', $c)->first()
        {
        "auth_token": "auth_token_from_step1",
        "transaction_id": 655,
        "amount_cents": 1000
        }
*/
        /*$c = $request->query('c');
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {
            $payment = $booking->payment;
            if ($payment) {
                $payment->status = 'cancel';
                $payment->logs = \GuzzleHttp\json_encode([
                    'customer_cancel' => 1
                ]);
                $payment->save(); 
                $booking->tryRefundToWallet(false);
            }
            return redirect($booking->getDetailUrl())->with("error", __("You cancelled the payment"));
        }
        if (!empty($booking)) {
            return redirect($booking->getDetailUrl());
        } else {
            return redirect(url('/'));
        }*/
    }


}

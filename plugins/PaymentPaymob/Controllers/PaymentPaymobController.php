<?php
namespace Plugins\PaymentPaymob\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugins\PaymentPaymob\Gateway\PaymentPaymobGateway;
class PaymentPaymobController extends Controller
{
    public function handleCheckout(Request $request)
    {
        if (!empty($request->input('key')) and !empty($request->input('x_receipt_link_url'))) {
            $twoco_args = http_build_query($request->input(), '', '&');
            return redirect($request->input('x_receipt_link_url') . "&" . $twoco_args);
        }
        return redirect("/");
    }
    public function confirmPayment(Request $request){
        return (new PaymentPaymobGateway())->confirmPayment($request);
    }
}

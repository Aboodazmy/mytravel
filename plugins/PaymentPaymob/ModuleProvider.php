<?php
namespace Plugins\PaymentPaymob;

use Modules\ModuleServiceProvider;
use Plugins\PaymentPaymob\Gateway\PaymentPaymobGateway;

class ModuleProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getPaymentGateway()
    {
        return [
            'paymob_gateway' => PaymentPaymobGateway::class
        ];
    }

    public static function getPluginInfo()
    {
        return [
            'title'   => __('Paymob'),
            'desc'    => __('Paymob Payment Gateway.'),
            'author'  => "Peter Ayoub",
            'version' => "1.0.0",
        ];
    }
}

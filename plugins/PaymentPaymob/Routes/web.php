<?php
use Illuminate\Support\Facades\Route;
Route::get('confirmPaymentPaymob','PaymentPaymobController@handleCheckout')->middleware('auth');
Route::get('gateway/gateway_callback/paymob','PaymentPaymobController@confirmPayment')->middleware('auth');
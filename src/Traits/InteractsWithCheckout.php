<?php

namespace Bryangruneberg\OPPWA\Traits;

use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWAResponse;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

trait InteractsWithCheckout
{
    public function prepareCheckout($amount, $currency, $paymentType, array $options = [])
    {
        $baseOptions = [
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => $paymentType
        ];

        $sendOptions = array_merge($baseOptions, $options);

        $response = $this->getClient()->doPost(OPPWA::URL_CHECKOUTS, $sendOptions);
        
        return $response;
    }
    
    public function isPrepareCheckoutSuccess(OPPWAResponse $response)
    {
        return $response->getResultCode() === OPPWAResponseCode::CREATED_CHECKOUT;
    }
    
    public function getCheckoutRegistration($checkoutId)
    {
        $url = OPPWA::URL_CHECKOUTS . '/' . $checkoutId . '/registration';
        $response = $this->getClient()->doGet($url);
        return $response;
    }
}
<?php

namespace Bryangruneberg\OPPWA\Traits;

use Bryangruneberg\OPPWA\OPPWA;

trait InteractsWithPayment
{
    public function getPaymentStatus($checkoutId)
    {
        $url = OPPWA::URL_CHECKOUTS . '/' . $checkoutId . '/payment';
        $response = $this->getClient()->doGet($url);
        
        return $response;
    }
    
    public function payUsingCard($amount, $currency, $paymentType, OPPWACard $card)
    {
        $baseOptions = [
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => $paymentType
        ];
        
        $baseOptions = array_merge($baseOptions, $card->getOPPWAArray());

        $sendOptions = array_merge($baseOptions, $options);

        $response = $this->getClient()->doPost(OPPWA::URL_CHECKOUTS, $sendOptions);
        
        return $response;
    }
}
<?php

namespace Bryangruneberg\OPPWA\Traits;

use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;

trait InteractsWithPayment
{
    public function getPaymentStatus($checkoutId)
    {
        $url = OPPWA::URL_CHECKOUTS . '/' . $checkoutId . '/payment';
        $response = $this->getClient()->doGet($url);
        
        return $response;
    }
    
    public function payUsingOPPWACard($amount, $currency, $paymentType, OPPWACard $card, array $options = [])
    {
        $baseOptions = [
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => $paymentType
        ];
        
        $baseOptions = array_merge($baseOptions, $card->getArray());

        $sendOptions = array_merge($baseOptions, $options);

        $response = $this->getClient()->doPost(OPPWA::URL_PAYMENTS, $sendOptions);
        
        return $response;
    }
}
<?php

namespace Bryangruneberg\OPPWA\Traits;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;

trait InteractsWith3DSecure
{
   public function get3DSecureStatus($transactionId)
    {
        $url = OPPWA::URL_3DSECURE . '/' . $transactionId;
        $response = $this->getClient()->doGet($url);
        return $response;
    }
    
    public function requestUsingOPPWACard($amount, $currency, $redirectURL, OPPWACard $card, array $options = [])
    {
        $baseOptions = [
            'amount' => $amount,
            'currency' => $currency,
            'shopperResultUrl' => $redirectURL
        ];
        
        $baseOptions = array_merge($baseOptions, $card->getArray());

        $sendOptions = array_merge($baseOptions, $options);

        $response = $this->getClient()->doPost(OPPWA::URL_3DSECURE, $sendOptions);
        
        return $response;
    }
}
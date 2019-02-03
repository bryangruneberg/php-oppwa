<?php

namespace Bryangruneberg\OPPWA\Traits;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;

trait InteractsWithRegister
{
    public function registerUsingOPPWACard(OPPWACard $card, array $options = [])
    {
        $sendOptions = array_merge($card->getArray(), $options);
        $response = $this->getClient()->doPost(OPPWA::URL_REGISTRATIONS, $sendOptions);
        
        return $response;
    }
    
    public function payUsingRegistration($amount, $currency, $paymentType, $registrationId, array $options = [])
    {
        $url = OPPWA::URL_REGISTRATIONS . '/' . $registrationId . '/payments';
        
        $baseOptions = [
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => $paymentType
        ];
        
        $sendOptions = array_merge($baseOptions, $options);
        $response = $this->getClient()->doPost($url, $sendOptions);
        
        return $response;
    }
}
<?php

namespace Bryangruneberg\OPPWA\Traits;

use Bryangruneberg\OPPWA\OPPWA;

trait InteractsWithCopyAndPay
{
    public function getCopyAndPayScript($checkoutId)
    {
        return '<script src='
            . '"' . $this->getCopyAndPayScriptUrl($checkoutId) . '"'
            . '></script>';
    }
    
    public function getCopyAndPayScriptUrl($checkoutId)
    {
        return $this->getClient()->getUrl() . OPPWA::URL_PAYMENTWIDGET 
            . '?checkoutId=' . $checkoutId; 
    }
}
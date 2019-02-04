<?php

namespace Bryangruneberg\OPPWA;

use Bryangruneberg\OPPWA\Traits\InteractsWithCheckout;
use Bryangruneberg\OPPWA\Traits\InteractsWithPayment;
use Bryangruneberg\OPPWA\Traits\InteractsWithRegister;
use Bryangruneberg\OPPWA\Traits\InteractsWithCopyAndPay;
use Bryangruneberg\OPPWA\Traits\InteractsWith3DSecure;

class OPPWA 
{
    use InteractsWithCheckout, InteractsWithPayment, 
        InteractsWithRegister, InteractsWithCopyAndPay,
        InteractsWith3DSecure;
    
    protected $client;
    
    const URL_CHECKOUTS = '/v1/checkouts';
    const URL_PAYMENTS = '/v1/payments';
    const URL_REGISTRATIONS = '/v1/registrations';
    const URL_PAYMENTWIDGET = '/v1/paymentWidgets.js';
    const URL_3DSECURE = '/v1/threeDSecure';
    
    
    const PAYMENT_TYPE_PREAUTH = 'PA';
    const PAYMENT_TYPE_DEBIT = 'DB';
    const PAYMENT_TYPE_CREDIT = 'CD';
    const PAYMENT_TYPE_CAPTURE = 'CP';
    const PAYMENT_TYPE_REFUND = 'RF';
    const PAYMENT_TYPE_REVERSE = 'RV';
    
    const RECURRING_TYPE_INITIAL = 'INITIAL';
    const RECURRING_TYPE_REPEATED = 'REPEATED';
    
    const PAYMENT_BRAND_VISA = 'VISA';
    const PAYMENT_BRAND_MASTERCARD = 'MASTER';
    const PAYMENT_BRAND_AMEX = 'AMEX';
    const PAYMENT_BRAND_DINERSCLUB = 'DINERS';

    
    public function setClient(OPPWAClient $client)
    {
        $this->client = $client;
        return $this;
    }
    
    public function getClient()
    {
        return $this->client;
    }
}

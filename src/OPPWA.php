<?php

namespace Bryangruneberg\OPPWA;

use Bryangruneberg\OPPWA\Traits\InteractsWithCheckout;
use Bryangruneberg\OPPWA\Traits\InteractsWithPayment;
use Bryangruneberg\OPPWA\Traits\InteractsWithRegister;
use Bryangruneberg\OPPWA\Traits\InteractsWithCopyAndPay;

class OPPWA 
{
    use InteractsWithCheckout, InteractsWithPayment, 
        InteractsWithRegister, InteractsWithCopyAndPay;
    
    protected $client;
    
    const URL_CHECKOUTS = '/v1/checkouts';
    const URL_PAYMENTS = '/v1/payments';
    const URL_REGISTRATIONS = '/v1/registrations';
    const URL_PAYMENTWIDGET = '/v1/paymentWidget.js';
    
    
    const PAYMENT_TYPE_PREAUTH = 'PA';
    const PAYMENT_TYPE_DEBIT = 'DB';
    const PAYMENT_TYPE_CREDIT = 'CD';
    const PAYMENT_TYPE_CAPTURE = 'CP';
    const PAYMENT_TYPE_REFUND = 'RF';
    const PAYMENT_TYPE_REVERSE = 'RV';
    
    const RECURRING_TYPE_INITIAL = 'INITIAL';
    const RECURRING_TYPE_REPEATED = 'REPEATED';
    
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
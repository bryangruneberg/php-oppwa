<?php

namespace Bryangruneberg\OPPWA;

use Bryangruneberg\OPPWA\Traits\InteractsWithCheckout;
use Bryangruneberg\OPPWA\Traits\InteractsWithPayment;
use Bryangruneberg\OPPWA\Traits\InteractsWithRegister;
use Bryangruneberg\OPPWA\Traits\InteractsWithCopyAndPay;

class OPPWACard
{
    protected $number;
    protected $holder;
    protected $expiryMonth;
    protected $expiryYear;
    protected $cvv;
    
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }
    
    public function getNumber() 
    {
        return $this->number;
    }
    
    public function setHolder($holder)
    {
        $this->holder = $holder;
        return $this;
    }
    
    public function getHolder() 
    {
        return $this->holder;
    }
    
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
        return $this;
    }
    
    public function getExpiryMonth() 
    {
        return $this->expiryMonth;
    }
    
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
        return $this;
    }
    
    public function getExpiryYear() 
    {
        return $this->expiryYear;
    }
    
    public function setCVV($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }
    
    public function getCVV($cvv)
    {
        return $this->cvv;
    }
    
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }
    
    public function getBrand()
    {
        return $this->brand;
    }
}
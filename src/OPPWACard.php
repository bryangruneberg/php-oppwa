<?php

namespace Bryangruneberg\OPPWA;

class OPPWACard
{
    protected $number;
    protected $holder;
    protected $expiryMonth;
    protected $expiryYear;
    protected $cvv;
    
    public function getArray()
    {
        return [
            'card.number' => $this->getNumber(),
            'card.holder' => $this->getHolder(),
            'card.expiryMonth' => $this->getExpiryMonth(),
            'card.expiryYear' => $this->getExpiryYear(),
            'card.cvv' => $this->getCVV(),
            'paymentBrand' => $this->getBrand()
        ];
    }
    
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
    
    public function getCVV()
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
    
    public function getLast4Digits()
    {
        return substr($this->number, -4);
    }
}
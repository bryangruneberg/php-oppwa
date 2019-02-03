<?php

namespace Bryangruneberg\OPPWA;

class OPPWAException extends \Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
<?php

namespace Bryangruneberg\OPPWA\Traits\Client;

use Bryangruneberg\OPPWA\OPPWAResponse;

trait PerformsPOST
{
    public function doPOST($url, array $data = [])
    {
        $data = $this->buildParameterArray($data);
    
        $httpResponse = $this->getGuzzleClient()
                            ->post($url,['form_params' => $data]);
                                
        $oppwaResponse = new OPPWAResponse;
        $oppwaResponse->fromGuzzleResponse($httpResponse);
        
        return $oppwaResponse;
    }
}
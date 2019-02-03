<?php

namespace Bryangruneberg\OPPWA\Traits\Client;

use Bryangruneberg\OPPWA\OPPWAResponse;

trait PerformsGET
{
    public function doGET($url, array $queryParameters = [])
    {
        $queryParameters = $this->buildParameterArray($queryParameters);
       
        $httpResponse = $this->getGuzzleClient()
                            ->request('GET', 
                                $url,
                                $queryParameters);
        
        $oppwaResponse = new OPPWAResponse;
        $oppwaResponse->fromGuzzleResponse($httpResponse);
        
        return $oppwaResponse;
    }
}
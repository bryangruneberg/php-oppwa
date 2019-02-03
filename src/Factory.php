<?php

namespace Bryangruneberg\OPPWA;

class Factory 
{
    public static function createClient($userId, $password, $entityId, $url)
    {
        $oppwaClient = new OPPWAClient();
        
        $oppwaClient->setUserId($userId)
            ->setPassword($password)
            ->setEntityId($entityId)
            ->initGuzzle($url);
            
        return $oppwaClient;
    }
    
    public static function createAPI(OPPWAClient $client)
    {
        $oppwaAPI = new OPPWA();
        
        $oppwaAPI->setClient($client);
        
        return $oppwaAPI;
    }
}

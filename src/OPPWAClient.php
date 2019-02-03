<?php

namespace Bryangruneberg\OPPWA;

use GuzzleHttp\Client;
use Bryangruneberg\OPPWA\Traits\Client\PerformsGET;
use Bryangruneberg\OPPWA\Traits\Client\PerformsPOST;

class OPPWAClient
{
    use PerformsGET, PerformsPOST;
    
    protected $entityId;
    protected $userId;
    protected $password;
    protected $url;
    protected $guzzleClient;
    
    protected $defaultGuzzleOptions = [
        'http_errors' => false
    ];
    
    public function __construct()
    {
        $this->guzzleClient = new Client();
    }
    
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
        return $this;
    }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    public function initGuzzle($url, array $options = [])
    {
        $this->url = $url;
        
        $options = array_merge($this->defaultGuzzleOptions, $options);
        $this->guzzleClient = new Client( array_merge(['base_uri' => $url], $options));
        
        return $this;
    }
    
    public function getEntityId() 
    {
        return $this->entityId;
    }
    
    public function getUserId() 
    {
        return $this->userId;
    }
    
    public function getPassword() 
    {
        return $this->password;
    }
    
    public function getUrl() 
    {
        return $this->url;
    }
    
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }
    
    public function getAuthArray()
    {
        return [
            'authentication.userId' => $this->getUserId(),
            'authentication.password' => $this->getPassword(),
            'authentication.entityId' => $this->getEntityId()
        ];
    }
    
    public function buildParameterArray(array $parameters) 
    {
        return array_merge($this->getAuthArray(), $parameters);
    }
}
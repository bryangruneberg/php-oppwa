<?php

namespace Bryangruneberg\OPPWA;

use GuzzleHttp\Psr7\Response;
use Bryangruneberg\OPPWA\Traits\InterpretsResultCode;
use Bryangruneberg\OPPWA\OPPWAException;

class OPPWAResponse
{
    use InterpretsResultCode;
    
    const RESULT_CODE_CAT_SUCCESS_PROCESS = "SUCCESS_PROCESS";
    const RESULT_CODE_CAT_SUCCESS_PROCESS_MANUAL_REVIEW = "SUCCESS_PROCESS_MANUAL_REVIEW";
    const RESULT_CODE_CAT_PENDING = "PENDING";
    const RESULT_CODE_CAT_PENDING_WAITING = "PENDING_WAITING";
    const RESULT_CODE_CAT_REJECTED_3DS_INTERBANK = "REJECTED_3DS_INTERBANK";
    const RESULT_CODE_CAT_REJECTED_EXTERNAL = "REJECTED_EXTERNAL";
    const RESULT_CODE_CAT_REJECTED_COMMS = "REJECTED_COMMS";
    const RESULT_CODE_CAT_REJECTED_SYS = "REJECTED_SYS";
    const RESULT_CODE_CAT_REJECTED_ASYNC = "REJECTED_ASYNC";
    const RESULT_CODE_CAT_REJECTED_RISK = "REJECTED_RISK";
    const RESULT_CODE_CAT_REJECTED_ADDRESS = "REJECTED_ADDRESS";
    const RESULT_CODE_CAT_REJECTED_3DS = "REJECTED_3DS";
    const RESULT_CODE_CAT_REJECTED_BLACKLIST = "REJECTED_BLACKLIST";
    const RESULT_CODE_CAT_REJECTED_RISK_VALIDATION = "REJECTED_RISK_VALIDATION";
    const RESULT_CODE_CAT_REJECTED_CONFIG = "REJECTED_CONFIG";
    const RESULT_CODE_CAT_REJECTED_REGISTRATION = "REJECTED_REGISTRATION";
    const RESULT_CODE_CAT_REJECTED_JOB = "REJECTED_JOB";
    const RESULT_CODE_CAT_REJECTED_REF = "REJECTED_REF";
    const RESULT_CODE_CAT_REJECTED_FORMAT = "REJECTED_FORMAT";
    const RESULT_CODE_CAT_REJECTED_ADDRESS_VALIDATION = "REJECTED_ADDRESS_VALIDATION";
    const RESULT_CODE_CAT_REJECTED_CONTACT = "REJECTED_CONTACT";
    const RESULT_CODE_CAT_REJECTED_ACCOUNT = "REJECTED_ACCOUNT";
    const RESULT_CODE_CAT_REJECTED_AMOUNT = "REJECTED_AMOUNT";
    const RESULT_CODE_CAT_REJECTED_RISK_MANAGEMENT = "REJECTED_RISK_MANAGMENT";
    const RESULT_CODE_CAT_CHARGEBACK = "CHARGEBACK";
    
    protected $json;
    protected $data;
    protected $guzzleResponse;
    
    public function setJson($json)
    {
        $this->json = $json;
        return $this;
    }
    
    public function getJson()
    {
        return $this->json;
    }
    
    public function fromGuzzleResponse(Response $response)
    {
        $this->guzzleResponse = $response;
        
        if(count($response->getHeader('Content-Type'))) {
            $contentType = strtolower($response->getHeader('Content-Type')[0]);
            if(strpos($contentType, 'application/json') === 0) 
            {
                $json = $response->getBody();
                $this->setJson($json)->parseJson();
            } else {
                throw new OPPWAException('The request did not return JSON', 
                        $response->getStatusCode());
            }
        } 
    }
    
    public function getGuzzleResponse()
    {
        return $this->guzzleResponse;
    }
    
    public function parseJson()
    {
        $this->data = json_decode($this->json, true);
        return $this;
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function get($key)
    {
        if(isset($this->data[$key]))
        {
            return $this->data[$key];
        }
    }
    
    public function getResultData() 
    {
        $result = $this->get('result');
        if($result && is_array($result)) {
            return $result;
        }
        
        return [];
    }
    
    public function getResultCode() 
    {
        $data = $this->getResultData();
        if(isset($data['code'])) {
            return $data['code'];
        }
    }
    
    public function getResultDescription() 
    {
       $data = $this->getResultData();
        if(isset($data['description'])) {
            return $data['description'];
        }
    }
    
    public function getId()
    {
        return $this->get('id');
    }
}
<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;
use Bryangruneberg\OPPWA\OPPWAResponse;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

class InteractsWithRegisterTest extends TestCase
{
	public function testRegisterAndPay()
	{
		$card = $this->getTestOPPWACardSuccess();
		$api = $this->getOPPWA();
		
		$registerRequest = $api->registerUsingOPPWACard($card);
		$registerCategories = $registerRequest->getResultCodeCategories($registerRequest->getResultCode());
		
		$this->assertTrue(in_array(OPPWAResponse::RESULT_CODE_CAT_SUCCESS_PROCESS, $registerCategories), 'The registration was not successful and should have been');
		$this->assertGreaterThanOrEqual(1, $registerRequest->get('id'), 'The registration registrationId was not returned');
		$this->assertEquals($card->getLast4Digits(), $registerRequest->get('card')['last4Digits']);
		
		$paymentRequest = $api->payUsingRegistration(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT, $registerRequest->getId());
		$paymentCategories = $paymentRequest->getResultCodeCategories($paymentRequest->getResultCode());
		$this->assertTrue(in_array(OPPWAResponse::RESULT_CODE_CAT_SUCCESS_PROCESS, $paymentCategories), 'The payment was not successful and should have been');
	}
}

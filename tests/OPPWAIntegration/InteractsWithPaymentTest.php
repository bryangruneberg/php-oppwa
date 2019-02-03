<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;
use Bryangruneberg\OPPWA\OPPWAResponse;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

class InteractsWithPaymentTest extends TestCase
{
	public function testGetPaymentStatus()
	{
		$api = $this->getOPPWA();
		$checkoutResponse = $api->prepareCheckout(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT);
		$this->assertTrue($api->isPrepareCheckoutSuccess($checkoutResponse), 'The checkout returned ' . $checkoutResponse->getResultCode() . ' instead of ' . OPPWAResponseCode::CREATED_CHECKOUT);
		$this->assertGreaterThanOrEqual(1, strlen($checkoutResponse->getId()));
		
		$paymentStatus = $api->getPaymentStatus($checkoutResponse->getId());
		$this->assertEquals(OPPWAResponseCode::TRANSACTION_PENDING, $paymentStatus->getResultCode(), 'The transaction should be pending, but is ' . $paymentStatus->getResultCode());
	}
	
	public function testPayWithOPPWACardSuccess()
	{
		$card = $this->getTestOPPWACardSuccess();
		$api = $this->getOPPWA();
		
		$paymentRequest = $api->payUsingOPPWACard(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT, $card);
		$paymentCategories = $paymentRequest->getResultCodeCategories($paymentRequest->getResultCode());
		
		$this->assertTrue(in_array(OPPWAResponse::RESULT_CODE_CAT_SUCCESS_PROCESS, $paymentCategories), 'The payment was not successful and should have been');
	}
	
	public function testPayWithOPPWACardSuccessWithRegistration()
	{
		$card = $this->getTestOPPWACardSuccess();
		$api = $this->getOPPWA();
		
		$options = [
			'createRegistration' => true
		];
		
		$paymentRequest = $api->payUsingOPPWACard(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT, $card, $options);
		$paymentCategories = $paymentRequest->getResultCodeCategories($paymentRequest->getResultCode());
		
		$this->assertTrue(in_array(OPPWAResponse::RESULT_CODE_CAT_SUCCESS_PROCESS, $paymentCategories), 'The payment was not successful and should have been');
		$this->assertGreaterThanOrEqual(1, $paymentRequest->get('registrationId'), 'The payment registrationId was not returned');
		$this->assertEquals($card->getLast4Digits(), $paymentRequest->get('card')['last4Digits']);
	}
	
	public function testPayWithOPPWACardFail()
	{
		$card = $this->getTestOPPWACardFail();
		$api = $this->getOPPWA();
		
		$paymentRequest = $api->payUsingOPPWACard(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT, $card);
		$paymentCategories = $paymentRequest->getResultCodeCategories($paymentRequest->getResultCode());
		
		$this->assertFalse(in_array(OPPWAResponse::RESULT_CODE_CAT_SUCCESS_PROCESS, $paymentCategories), 'The payment was successful and should not have been');
	}
}

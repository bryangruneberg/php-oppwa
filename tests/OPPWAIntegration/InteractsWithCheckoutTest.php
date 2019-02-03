<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

class InteractsWithCheckoutTest extends TestCase
{
	public function testPrepareCheckoutReturnsValidResponse()
	{
		$api = $this->getOPPWA();
		$checkoutResponse = $api->prepareCheckout(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT);
		$this->assertTrue($api->isPrepareCheckoutSuccess($checkoutResponse), 'The checkout returned ' . $checkoutResponse->getResultCode() . ' instead of ' . OPPWAResponseCode::CREATED_CHECKOUT);
		$this->assertGreaterThanOrEqual(1, strlen($checkoutResponse->getId()));
	}
	
	public function testPrepareCheckoutForRecurringReturnsValidResponse()
	{
		$api = $this->getOPPWA();
		$recurringOptions = [
			'recurringType' => OPPWA::RECURRING_TYPE_INITIAL,
			'createRegistration' => true
		];
		
		$checkoutResponse = $api->prepareCheckout(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT, $recurringOptions);
		$this->assertTrue($api->isPrepareCheckoutSuccess($checkoutResponse), 'The checkout returned ' . $checkoutResponse->getResultCode() . ' instead of ' . OPPWAResponseCode::CREATED_CHECKOUT);
		$this->assertGreaterThanOrEqual(1, strlen($checkoutResponse->getId()));
	}
}

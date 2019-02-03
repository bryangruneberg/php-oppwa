<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

class InteractsWithPaymentTest extends TestCase
{
	public function testGetPaymentStatus()
	{
		$api = $this->getOPPWA();
		$checkoutResponse = $api->prepareCheckout(10, 'ZAR', OPPWA::PAYMENT_TYPE_DEBIT);
		$this->assertTrue($api->isPrepareCheckoutSuccess($checkoutResponse), 'The checkout returned ' . $checkoutResponse->getResultCode() . ' instead of ' . OPPWAResponseCode::CREATED_CHECKOUT);
		$this->assertGreaterThanOrEqual(1, strlen($checkoutResponse->getId()));
		print_r($checkoutResponse->getData());
		
		$paymentStatus = $api->getPaymentStatus($checkoutResponse->getId());
		$this->assertEquals(OPPWAResponseCode::TRANSACTION_PENDING, $paymentStatus->getResultCode(), 'The transaction should be pending, but is ' . $paymentStatus->getResultCode());
	}
}

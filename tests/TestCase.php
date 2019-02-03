<?php

namespace Bryangruneberg\OPPWA\Tests;

use PHPUnit\Framework\TestCase as PTestCase;
use Bryangruneberg\OPPWA\Factory;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;

abstract class TestCase extends PTestCase
{
	public function getOPPWA()
	{
		$client = Factory::createClient(
			getenv('OPPWA_USER_ID'),
			getenv('OPPWA_PASSWORD'),
			getenv('OPPWA_ENTITY_ID'),
			getenv('OPPWA_URL')
		);
		
		$api = Factory::createAPI($client);

		return $api;
	}
	
	public function getTestOPPWACardFail()
	{
		$card = new OPPWACard;
		return $card->setNumber('4200000000000000')
				->setHolder('John Doe')
				->setExpiryMonth(11)
				->setExpiryYear(2050)
				->setCVV(123)
				->setBrand(OPPWA::PAYMENT_BRAND_VISA);
	}
	
	public function getTestOPPWACardSuccess()
	{
		$card = new OPPWACard;
		return $card->setNumber('5454545454545454')
				->setHolder('Jane Doe')
				->setExpiryMonth(11)
				->setExpiryYear(2050)
				->setCVV(123)
				->setBrand(OPPWA::PAYMENT_BRAND_MASTERCARD);
	}
	
	public function getTestOPPWACard3DSecure()
	{
		$card = new OPPWACard;
		return $card->setNumber('4012001036275556')
				->setHolder('Jane Doe')
				->setExpiryMonth(11)
				->setExpiryYear(2050)
				->setCVV(123)
				->setBrand(OPPWA::PAYMENT_BRAND_VISA);
	}
}

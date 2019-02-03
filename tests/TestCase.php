<?php

namespace Bryangruneberg\OPPWA\Tests;

use PHPUnit\Framework\TestCase as PTestCase;
use Bryangruneberg\OPPWA\Factory;

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
}

<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWACard;
use Bryangruneberg\OPPWA\OPPWAResponse;
use Bryangruneberg\OPPWA\OPPWAResponseCode;

class InteractsWith3DSecureTest extends TestCase
{
	public function testRequestWithOPPWACard()
	{
		$card = $this->getTestOPPWACard3DSecure();
		$api = $this->getOPPWA();
		
		$request3D = $api->requestUsingOPPWACard(10, 'ZAR', 'https://bryangruneberg.com/oh-no', $card);
		$request3DCategories = $request3D->getResultCodeCategories($request3D->getResultCode());
	
		$this->assertTrue(in_array(OPPWAResponse::RESULT_CODE_CAT_PENDING, $request3DCategories), 'The 3D request is not pending and should be');
		$redirect = $request3D->get('redirect');
		$this->assertTrue(is_array($redirect), 'There is no redirect information from the API');
		$this->assertTrue(isset($redirect['url']), 'There is no url in the redirect information from the API');
	}
}

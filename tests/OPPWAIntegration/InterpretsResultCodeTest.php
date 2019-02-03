<?php

namespace Bryangruneberg\OPPWA\Tests\OPPWAIntegration;

use Bryangruneberg\OPPWA\Tests\TestCase;
use Bryangruneberg\OPPWA\OPPWA;
use Bryangruneberg\OPPWA\OPPWAResponse;

class InterpretsResultCodeTest extends TestCase
{
	public function testInitializeResultCodesReturnsArray()
	{
		$allCodes = OPPWAResponse::initializeResultCodes();
		$this->assertTrue(is_array($allCodes), 'initializeResultCodes is not returning an array');
		$this->assertGreaterThanOrEqual(0, count($allCodes), 'initializeResultCodes is empty');
	}
	
	public function testThatEveryCodeHasADescription()
	{
		$allCodes = OPPWAResponse::initializeResultCodes();
		foreach($allCodes as $code => $description) {
			$this->assertGreaterThanOrEqual(1, strlen(OPPWAResponse::lookupResultCode($code)), 'Code has an empty description');
		}
	}
	
	public function testResultCodesMatches()
	{
		$allCodes = OPPWAResponse::initializeResultCodes();
		
		foreach($allCodes as $code => $description) {
			$categories = OPPWAResponse::getResultCodeCategories($code);
			$this->assertGreaterThanOrEqual(0, count($categories), $code.' has no matches');
		}
	}
}

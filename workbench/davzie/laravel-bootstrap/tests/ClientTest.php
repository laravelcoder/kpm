<?php

class ClientTest extends TestCase {
	/**
	 *
	 */
	public function testHome()
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->get('kpm/');

		return $this->assertTrue($response->getStatusCode() == 200);
	}

	/**
	 *
	 */
	public function testNews()
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->get('kpm/news');

		return $this->assertTrue($response->getStatusCode() == 200);
	}

	/**
	 *
	 */
	public function testContact()
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->get('kpm/contact');

		return $this->assertTrue($response->getStatusCode() == 200);
	}
}
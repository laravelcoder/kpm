<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->action('GET', 'HomeController@index');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	/**
	 *
	 */
	public function testNews()
	{
		$crawler = $this->call('GET', '/news');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	/**
	 *
	 */
	public function testContacts()
	{
		$crawler = $this->call('GET', '/contact');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

}

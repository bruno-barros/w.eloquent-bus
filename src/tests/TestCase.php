<?php namespace Weloquent\Bus\Tests;

/**
 * TestCase
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2014 Bruno Barros
 */
class TestCase extends \PHPUnit_Framework_TestCase
{


	public function setUp()
	{
	}

	public function tearDown()
	{
		\Mockery::close();
	}

}
<?php namespace Weloquent\Bus\Tests;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Weloquent\Bus\DefaultCommandBus;
use Weloquent\Core\Application;

/**
 * DefaultCommandBusTest
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
class DefaultCommandBusTest extends TestCase
{

	private $bus;

	public function setUp()
	{
		parent::setUp();

		$c = new Container();

		$this->bus = new DefaultCommandBus($c->make('Weloquent\Core\Application'),
			$c->make('Weloquent\Bus\BasicCommandTranslator'));
	}

	/**
	 * @test
	 */
	public function it_should_be_instantiable()
	{

		assertInstanceOf('Weloquent\Bus\DefaultCommandBus', $this->bus);
	}

	/**
	 * @test
	 */
	public function it_should_return_a_handler_instance()
	{
		$return = $this->bus->execute(new FakeCommand('foo'));
		assertEquals('foo', $return);
	}

	/**
	 * @test
	 */
	public function it_should_prepend_a_command()
	{

		$return = $this->bus->before(['Weloquent\Bus\Tests\BeforeCommandHandler'])
			->execute(new FakeCommand('foo'));

		assertEquals('before foo', $return);
	}

}
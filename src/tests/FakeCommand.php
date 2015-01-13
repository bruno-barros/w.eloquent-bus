<?php  namespace Weloquent\Bus\Tests;


/**
 * FakeCommand
 * 
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright	Copyright (c) 2015 Bruno Barros
 */
class FakeCommand {


	public $name;

	function __construct($name)
	{
		$this->name = $name;
	}

}
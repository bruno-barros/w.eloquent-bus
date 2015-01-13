<?php  namespace Weloquent\Bus\Tests;

use Weloquent\Bus\Contracts\CommandHandler;

/**
 * FakeCommand
 * 
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright	Copyright (c) 2015 Bruno Barros
 */
class FakeCommandHandler implements CommandHandler{


	/**
	 * Just return the name property
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		return $command->name;
	}
}
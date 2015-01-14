<?php  namespace Weloquent\Bus\Tests;

use Weloquent\Bus\Contracts\CommandHandler;

/**
 * BeforeCommandHandler
 * 
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright	Copyright (c) 2015 Bruno Barros
 */
class BeforeCommandHandler implements CommandHandler{

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$command->name = 'before ' . $command->name;
		return $command;
	}
}
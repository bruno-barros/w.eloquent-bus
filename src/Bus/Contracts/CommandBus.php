<?php namespace Weloquent\Bus\Contracts;

/**
 * CommandBus
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
interface CommandBus
{

	/**
	 * Execute a command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function execute($command);
}
<?php namespace Weloquent\Bus\Contracts;

/**
 * CommandHandler
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
interface CommandHandler
{
	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command);
}
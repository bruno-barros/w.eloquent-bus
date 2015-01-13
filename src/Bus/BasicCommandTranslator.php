<?php namespace Weloquent\Bus;

use Weloquent\Bus\Contracts\CommandTranslator;
use Weloquent\Bus\Exceptions\HandlerNotRegisteredException;

/**
 * BasicCommandTranslator
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
class BasicCommandTranslator implements CommandTranslator
{
	/**
	 * Translate a command to its handler counterpart
	 *
	 * @param $command
	 * @return mixed
	 * @throws HandlerNotRegisteredException
	 */
	public function toCommandHandler($command)
	{
		$commandClass = get_class($command);
		$handler      = substr_replace($commandClass, 'CommandHandler', strrpos($commandClass, 'Command'));

		if (!class_exists($handler))
		{
			$message = "Command handler [$handler] does not exist.";

			throw new HandlerNotRegisteredException($message);
		}

		return $handler;
	}

	/**
	 * Translate a command to its validator counterpart
	 *
	 * @param $command
	 * @return mixed
	 */
	public function toValidator($command)
	{
		$commandClass = get_class($command);

		return substr_replace($commandClass, 'Validator', strrpos($commandClass, 'Command'));
	}
}
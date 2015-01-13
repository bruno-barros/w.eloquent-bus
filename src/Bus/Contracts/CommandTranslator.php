<?php namespace Weloquent\Bus\Contracts;

use Exception;

/**
 * CommandTranslator
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
interface CommandTranslator
{
	/**
	 * Translate a command to its handler counterpart
	 *
	 * @param $command
	 * @return mixed
	 * @throws Exception
	 */
	public function toCommandHandler($command);

	/**
	 * Translate a command to its validator counterpart
	 *
	 * @param $command
	 * @return mixed
	 */
	public function toValidator($command);
}
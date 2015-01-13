<?php namespace Weloquent\Bus;

use InvalidArgumentException;
use Weloquent\Core\Application;
use Weloquent\Bus\Contracts\CommandBus;
use Weloquent\Bus\Contracts\CommandHandler;
use Weloquent\Bus\Contracts\CommandTranslator;

/**
 * DefaultCommandBus
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
class DefaultCommandBus implements CommandBus
{
	/**
	 * @var Application
	 */
	protected $app;
	/**
	 * @var CommandTranslator
	 */
	protected $commandTranslator;
	/**
	 * List of optional decorators for command bus.
	 *
	 * @var array
	 */
	protected $decorators = [];

	/**
	 * @var array
	 */
	private $before = [];

	/**
	 * @var array
	 */
	private $after = [];

	/**
	 * @param Application $app
	 * @param CommandTranslator $commandTranslator
	 */
	function __construct(Application $app, CommandTranslator $commandTranslator)
	{
		$this->app               = $app;
		$this->commandTranslator = $commandTranslator;
	}

	/**
	 * Decorate the command bus with any executable actions.
	 *
	 * @param  string $className
	 * @return mixed
	 */
	public function decorate($className)
	{
		$this->decorators[] = $className;
	}

	/**
	 * Set decorators to run before execute command
	 *
	 * @param array $decorators
	 * @return $this
	 */
	public function before($decorators = array())
	{
		$this->before = array_merge($this->before, (array)$decorators);

		return $this;
	}


	/**
	 * Set decorators to run after execute command
	 *
	 * @param array $decorators
	 * @return $this
	 */
	public function after($decorators = array())
	{
		$this->after = array_merge($this->after, (array)$decorators);

		return $this;
	}



	/**
	 * Execute the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function execute($command)
	{
		$handlerName = $this->commandTranslator->toCommandHandler($command);

		$command = $this->executeDecorators($command, 'before');

		$command = $this->app->make($handlerName)->handle($command);

		return $this->executeDecorators($command, 'after');



//		$this->executeDecorators($command);
//		$handler = $this->commandTranslator->toCommandHandler($command);
//
//		return $this->app->make($handler)->handle($command);
	}



	/**
	 * Execute decorators
	 *
	 * @param $command
	 * @param string $decoratorSide
	 * @return mixed
	 * @throws \InvalidArgumentException
	 */
	private function executeDecorators($command, $decoratorSide = '')
	{
		$commandState = $command;

		dd($this->before);
//		dd($this->$decoratorSide);
		foreach ($this->$decoratorSide as $className)
		{
			if(! class_exists($className))
			{
				throw new InvalidArgumentException("The decorate class [$className] does not exists.");
			}

			$instance = $this->app->make($className);

			if (! $instance instanceof CommandHandler)
			{
				$message = 'The class to decorate must be an implementation of Weloquent\Bus\Contracts\CommandHandler';

				throw new InvalidArgumentException($message);
			}

			// execute
			$commandState = $instance->handle($commandState);
		}

		return $commandState;
	}

	/**
	 * Execute all registered decorators
	 *
	 * @param  object $command
	 * @return null
	 */
	protected function __executeDecorators($command)
	{
		foreach ($this->decorators as $className)
		{
			$instance = $this->app->make($className);
			if (!$instance instanceof CommandBus)
			{
				$message = 'The class to decorate must be an implementation of Weloquent\Bus\CommandBus';
				throw new InvalidArgumentException($message);
			}
			$instance->execute($command);
		}
	}
}
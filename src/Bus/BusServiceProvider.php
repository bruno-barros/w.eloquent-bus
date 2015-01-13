<?php namespace Weloquent\Bus;

use Illuminate\Support\ServiceProvider;

/**
 * BusServiceProvider
 *
 * @author Bruno Barros  <bruno@brunobarros.com>
 * @copyright    Copyright (c) 2015 Bruno Barros
 */
class BusServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommandTranslator();

		$this->registerCommandBus();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['weloquent.bus'];
	}

	/**
	 * Register the command translator binding
	 */
	protected function registerCommandTranslator()
	{
		$this->app->bind('Weloquent\Bus\Contracts\CommandTranslator',
			'Weloquent\Bus\BasicCommandTranslator');
	}

	/**
	 * Register the desired command bus implementation
	 */
	protected function registerCommandBus()
	{
		$this->app->bindShared('Weloquent\Bus\Contracts\CommandBus', function ()
		{
			return $this->app->make('Weloquent\Bus\DefaultCommandBus');
		});
	}
}
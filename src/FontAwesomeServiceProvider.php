<?php namespace Digbang\FontAwesome;

use Illuminate\Support\ServiceProvider;

/**
 * Class FontAwesomeServiceProvider
 * @package Digbang\FontAwesome
 */
class FontAwesomeServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(FontAwesome::class);
	}
}
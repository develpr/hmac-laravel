<?php namespace Develpr\HmacLaravel\Provider;

use Illuminate\Support\ServiceProvider;
use Develpr\HmacLaravel\Signature\RequestVerifier;

class HmacServiceProvider extends ServiceProvider
{
	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$path = realpath(__DIR__ . '/../../config/hmac_laravel.php');
		$this->publishes([$path => config_path('hmac_laravel.php')], 'hmac_laravel');
		$this->mergeConfigFrom($path, 'hmac_laravel');
	}
	public function register()
	{
		$this->app->singleton('develpr.hmac_laravel.request.verifier', function ($app) {
			$options = config('hmac_laravel.verifier');
			return new RequestVerifier($options);
		});
		$this->app->singleton('develpr.hmac_laravel.credentialProvider', function($app){
			$model = config('hmac_laravel.credential.provider');
			return new $model;
		});
//		$this->app->singleton('develpr.hmac_laravel.request.signer', function ($app) {
//			$options = config('hmac_laravel.signer');
//			return new RequestVerifier($options);
//		});
	}

}
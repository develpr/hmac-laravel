<?php namespace Develpr\HmacLaravel\Middleware;

use Closure;
use Develpr\HmacLaravel\Signature\RequestVerifier;
use HttpException;
use Illuminate\Contracts\Auth\UserProvider;

class Hmac
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		/** @var RequestVerifier $verifier */
		$verifier = app('develpr.hmac_laravel.request.verifier');
		$result = $verifier->verify($request);

		if($result === false){
			throw new HttpException(401, "Unable to verify request signature.");
		}
		else{
			if( ! $result instanceof UserProvider ){
				throw new \Exception("The HmacLaraval user configured does not implement the UserProvider contract. " .
									" This means that while the request was signed and validated, the actual user resolved" .
									" is not valid to sign into Laravel.");
			}

			//Log the user in
			\Auth::once($result);
			//Continue onto the next request
			return $next($request);
		}
	}
}

<?php namespace Develpr\HmacLaravel\Signature;

use Develpr\Hmac\Signature\RequestVerifier as BaseRequestVerifier;
use Develpr\HmacLaravel\Contracts\LaravelCredentialProvider;
use Symfony\Component\HttpFoundation\Request;

class RequestVerifier extends BaseRequestVerifier
{
	private $error = "";

	public function verify(Request $request, LaravelCredentialProvider $credentialProvider = null){

		if(! $credentialProvider ){
			$credentialProvider = app('develpr.hmac_laravel.credentialProvider');
		}

		//We're going to catch any exceptions and simply return false if this fails, for whatever reason.
		try{
			$result = $this->checkRequest($request, $credentialProvider);
		}catch(\Exception $e){
			$this->error = $e->getMessage();
			return false;
		}

		if( $result !== false ){
			return $credentialProvider->getCredentialedEntity($result);
		}

		return $result;
	}

	public function getError(){
		return $this->error;
	}
}
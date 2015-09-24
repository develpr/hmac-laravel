<?php namespace Develpr\HmacLaravel\Credential;

use Develpr\Hmac\Exceptions\DuplicateCredentialKeyException;
use Illuminate\Database\Eloquent\Model;

trait Credentialed
{
	public function getCredential($accessKeyId){
		/** @var Model $this */
		if(! isset($credentialIdentifier) )
			$credentialIdentifier = 'id';

		if(! isset($credentialSecretAttribute) )
			$credentialSecretAttribute = 'secret_key';

		$result = $this->where($credentialIdentifier, '=', $accessKeyId);

		if(count($result) > 1) {
			throw new DuplicateCredentialKeyException($accessKeyId, count($result));
		}

		$result = $result->first();

		return $result;
	}

	/**
	 * Get the actual credentialed entity that the credentials identify. Presumably the CredentialProvider may
	 * be any number of data sources, and the credentials may not be 1:1 with the user/system/entity that actually
	 * owns the credentials. getCredentialedEntity is intended to be used to (optionally) provide access to the
	 * actual owner of the provided credentials.
	 *
	 * @return mixed
	 */
	public function getCredentialedEntity($credential){
		if(isset($credentialedEntity))
			return $credential->$credentialedEntity;
		else
			return $credential;
	}

	/**
	 * Returns the unique identifier that can be used to retrieve/identify the secret key
	 *
	 * @return string
	 */
	public function getAccessKeyId(){
		if(! isset($credentialIdentifier) )
			$credentialIdentifier = 'id';
		return $this->$credentialIdentifier;
	}

	/**
	 * Returns the secret key used to sign request. *Secret* being the key.
	 *
	 * @return string
	 */
	public function getSecretKey(){
		$test = isset($credentialSecretAttribute);

		if(! isset($credentialSecretAttribute) )
			$credentialSecretAttribute = 'secret_key';
		return $this->$credentialSecretAttribute;
	}


}
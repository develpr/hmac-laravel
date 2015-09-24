<?php namespace Develpr\HmacLaravel\Contracts;

use Develpr\Hmac\Contracts\CredentialProvider;

interface LaravelCredentialProvider extends CredentialProvider
{

	/**
	 * Get the actual credentialed entity that the credentials identify. Presumably the CredentialProvider may
	 * be any number of data sources, and the credentials may not be 1:1 with the user/system/entity that actually
	 * owns the credentials. getCredentialedEntity is intended to be used to (optionally) provide access to the
	 * actual owner of the provided credentials.
	 *
	 * @return mixed
	 */
	public function getCredentialedEntity($accessKeyId);

}
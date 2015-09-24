<?php

return [

	'credential' => [

		/*
		|--------------------------------------------------------------------------
		| credential provider
		|--------------------------------------------------------------------------
		|
		| This is the class that will be used to supply the actual
		|
		*/
		'provider' => env('HMACL_CREDENTIAL_PROVIDER', config('auth.model')),

	],

	//This is for request verification
	'verifier' => [
		/*
		|--------------------------------------------------------------------------
		| header namespace
		|--------------------------------------------------------------------------
		|
		| Provides a default namespace for the headers that may be added to the request. This will be used
		| for things such as X-HmacLaravel-Date - where the date/time information will be added
		|
		*/
		'header_namespace' => env('V_HMACL_HEADER_NAMESPACE', 'HmacLaravel'),

		/*
		|--------------------------------------------------------------------------
		| authorization header
		|--------------------------------------------------------------------------
		|
		| This is what will be looked for in the headers, and will be used for checking/building the request
		|
		*/
		'auth_header_name' => env('V_HMACL_AUTH_HEADER', 'Authorization'),

		/*
		|--------------------------------------------------------------------------
		| check request age
		|--------------------------------------------------------------------------
		|
		| Should the X-<namespace>-Date be checked to verify it's fresh?
		| This is to prevent replay attacks.
		|
		*/
		'check_request_age' => boolval(env('V_HMACL_CHECK_AGE', false)),

		/*
		|--------------------------------------------------------------------------
		| max request age seconds
		|--------------------------------------------------------------------------
		|
		| How many seconds old can the request be before it's determined to be "stale"
		|
		*/
		'max_request_age_seconds' => intval(env('V_HMACL_MAX_AGE_SECONDS', 300)),

		/*
		|--------------------------------------------------------------------------
		| hash algorithm
		|--------------------------------------------------------------------------
		|
		| Which hashing algorithm should be used? Default is sha256, but there are others
		| which you may choose, although ymmv.
		|
		*/
			'hash_algorithm' => env('V_HMACL_HASH_ALGO', 'sha256'),
	],

	//request signing will be done with these defaults
	'signer' => [
		/*
		|--------------------------------------------------------------------------
		| header namespace
		|--------------------------------------------------------------------------
		|
		| Provides a default namespace for the headers that may be added to the request. This will be used
		| for things such as X-HmacLaravel-Date - where the date/time information will be added
		|
		*/
			'header_namespace' => env('S_HMACL_HEADER_NAMESPACE', 'HmacLaravel'),

		/*
		|--------------------------------------------------------------------------
		| authorization header
		|--------------------------------------------------------------------------
		|
		| This is what will be looked for in the headers, and will be used for checking/building the request
		|
		*/
			'auth_header_name' => env('S_HMACL_AUTH_HEADER', 'Authorization'),

		/*
		|--------------------------------------------------------------------------
		| check request age
		|--------------------------------------------------------------------------
		|
		| Should the X-<namespace>-Date be checked to verify it's fresh?
		| This is to prevent replay attacks.
		|
		*/
			'check_request_age' => boolval(env('S_HMACL_CHECK_AGE', true)),

		/*
		|--------------------------------------------------------------------------
		| max request age seconds
		|--------------------------------------------------------------------------
		|
		| How many seconds old can the request be before it's determined to be "stale"
		|
		*/
			'max_request_age_seconds' => intval(env('S_HMACL_MAX_AGE_SECONDS', 300)),

		/*
		|--------------------------------------------------------------------------
		| hash algorithm
		|--------------------------------------------------------------------------
		|
		| Which hashing algorithm should be used? Default is sha256, but there are others
		| which you may choose, although ymmv.
		|
		*/
			'max_request_age_seconds' => env('S_HMACL_HASH_ALGO', 'sha256'),
	],
];

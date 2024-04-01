# Keycloak Guard Packages
This package is a guard for keycloak. 
This package is a fork from [keycloak-guard](https://github.com/robsontenorio/laravel-keycloak-guard) package and change several code.

## Installation
```bash
composer require alterindonesia/keycloak-guard
```

## Environment
```dotenv
KEYCLOAK_REALM_PUBLIC_KEY=
KEYCLOAK_LOAD_USER_FROM_DATABASE=false
KEYCLOAK_USER_PROVIDER_CREDENTIAL=email
KEYCLOAK_TOKEN_PRINCIPAL_ATTRIBUTE=preferred_username
KEYCLOAK_APPEND_DECODED_TOKEN=true
KEYCLOAK_ALLOWED_RESOURCES=account
KEYCLOAK_IGNORE_RESOURCES_VALIDATION=false
KEYCLOAK_LEEWAY=0
KEYCLOAK_TOKEN_INPUT_KEY=null
KEYCLOAK_SESSION_SYNC=true
KEYCLOAK_URL=
KEYCLOAK_REALM=
```

### Publish Configuration
```bash
php artisan vendor:publish --provider="Alterindonesia\KeycloakGuard\KeycloakGuardServiceProvider"
```

## Usage
There are two ways to use this package:
1. Just decode the token and get the user data from the token.
2. Sync the user data from the token on keycloak server API.
```dotenv
KEYCLOAK_SESSION_SYNC=true
KEYCLOAK_URL=
KEYCLOAK_REALM=
```

### Laravel Auth
Changes on config/auth.php
```php
    ...
    'defaults' => [
        'guard' => 'api', # <-- For sure, i`m building an API
        'passwords' => 'users',
    ],

    ....

    'guards' => [
        # <!-----
        #     Make sure your "api" guard looks like this.
        #     Newer Laravel versions just removed this config block.
        #  ---->
        'api' => [
            'driver' => 'keycloak',
            'provider' => 'users',
        ],
    ],
```
### Laravel Routes
```php
// protected endpoints
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/protected-endpoint', 'SecretController@index');
    // more endpoints ...
});
```

## Big Thanks
- [robsontenorio](https://github.com/robsontenorio) for the original package.


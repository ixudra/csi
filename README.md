ixudra/csi
=====================

Custom PHP Crash Scene Investigation (CSI) library for the Laravel 5 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer:

```js

    {
        "require": {
            "ixudra/csi": "2.*"
        }
    }

```

Add the service provider to your `config/app.php` file:

```php

    providers     => array(

        //...
        Ixudra\Csi\CsiServiceProvider::class,

    )

```


Add your API key to your `.env` file:

```php

    CSI_BASE_URL=ixudra_api_url
    CSI_PUBLIC_KEY=your_api_key

```

Add the error handling instructions to your `bootstrap/app.php` file:

```php

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Ixudra\Csi\Exceptions\CsiExceptionHandler::class,
    App\Exceptions\Handler::class
);

```



## Usage

In order to use the package, you need to tell your app to send exception information to your portal of choice. This will happen automatically once you have completed the setup mentioned above. Once an exception is registered, the web portal administrator will receive the exception information as soon as he logs in and will take action as soon as possible.



## Configuration

You can also publish the package's configuration files using the artisan command:

```php

    php artisan config:publish ixudra/csi

```

This will allow you to change the web portal URL as well as browser and platform information that is used by the package.


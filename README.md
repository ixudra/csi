ixudra/csi
=====================

Custom PHP Crash Scene Investigation (CSI) library for the Laravel 4 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.




## Why use this package?

This




## Installation

Pull this package in through Composer:

```js

    {
        "require": {
            "ixudra/csi": "0.1.*"
        }
    }

```

Add the service provider to your `config/app.php` file:

```php

    providers     => array(

        //...
        'Ixudra\Csi\CsiServiceProvider',

    )

```

Add the facade to your `config/app.php` file:

```php

    facades     => array(

        //...
        'CSI'       => 'Ixudra\Csi\Facades\Csi',

    )

```

Add the error handling instructions to your `bootstrap/global.php` file:

```php

    App::error(function(Exception $exception, $code)
    {
        // Create crash report
        CSI::registerCrash( $exception );
    
        Log::error($exception);
    });

```


Add the resource controller to your `app/routes.php` file:

```php

    Route::group(array('before' => 'auth', 'prefix' => 'admin'), function()
    {

        Route::resource('crashes', 'Ixudra\Csi\Controllers\CrashController', array( 'only' => array('index', 'show', 'destroy' ) ));

    });

```

This last step is optional and is only required if you would like to use ths built-in controller. Alternatively, you can also create your own controller with custom logic and views.




## Usage


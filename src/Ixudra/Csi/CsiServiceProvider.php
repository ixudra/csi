<?php namespace Ixudra\Csi;


use Illuminate\Support\ServiceProvider;
use Ixudra\Csi\Services\CrashFactory;

class CsiServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function boot()
    {
        $this->package('ixudra/csi');
    }

    public function register()
    {
        $this->app['csi'] = $this->app->share(
            function($app)
            {
                return new CsiService( new CrashFactory() );
            }
        );
    }

    public function provides()
    {
        return array('csi');
    }

}

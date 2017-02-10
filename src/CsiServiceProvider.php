<?php namespace Ixudra\Csi;


use Illuminate\Support\ServiceProvider;

class CsiServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/config/config.php';

        $this->mergeConfigFrom($configPath, 'csi');
        $this->publishes(
            array(
                $configPath         => config_path('csi.php'),
            )
        );
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('Csi');
    }

}

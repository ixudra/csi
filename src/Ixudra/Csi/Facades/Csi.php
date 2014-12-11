<?php namespace Ixudra\Csi\Facades;


use Illuminate\Support\Facades\Facade;

class Csi extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'csi';
    }

}
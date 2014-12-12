<?php namespace Ixudra\Csi;


use Config;

use Ixudra\Curl\CurlService;
use Ixudra\Csi\Services\CrashFactory;

class CsiService {

    protected $curlService = null;


    public function __construct(CrashFactory $crashFactory)
    {
        $this->crashFactory = $crashFactory;
    }


    public function registerCrash(\Exception $exception)
    {
        $this->getCurlService()->post(
            Config::get('csi::url'), $this->crashFactory->createFromException( $exception )
        );
    }

    protected function getCurlService()
    {
        if( is_null($this->curlService) ) {
            $this->curlService = new CurlService();
        }

        return $this->curlService;
    }

}
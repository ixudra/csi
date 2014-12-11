<?php namespace Ixudra\Csi;


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
            $this->getUrl() .'/crashes', $this->crashFactory->createFromException( $exception )
        );
    }

    protected function getCurlService()
    {
        if( is_null($this->curlService) ) {
            $this->curlService = new CurlService();
        }

        return $this->curlService;
    }

    protected function getUrl()
    {
        return $this->app['config']->get('Csi::baseUrl');
    }

}
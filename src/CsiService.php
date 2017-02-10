<?php namespace Ixudra\Csi;


use Ixudra\Curl\CurlService;
use Ixudra\Csi\Services\CrashFactory;

use \Exception;

class CsiService {

    protected $crashFactory = null;

    protected $curlService = null;

    protected $baseUrl;


    public function __construct(CrashFactory $crashFactory, CurlService $curlService)
    {
        $this->crashFactory = $crashFactory;
        $this->curlService = $curlService;
        $this->baseUrl = env('CSI_BASE_URL');
    }


    public function registerCrash(Exception $exception)
    {
        $this->curlService
            ->to( $this->baseUrl )
            ->withData( $this->crashFactory->createFromException( $exception ) )
            ->asJson()
            ->post();
    }

}
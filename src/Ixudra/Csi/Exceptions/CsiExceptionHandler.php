<?php namespace Ixudra\Csi\Exceptions;


use Ixudra\Csi\CsiService;
use Psr\Log\LoggerInterface;
use App\Exceptions\Handler as BaseExceptionHandler;

use Exception;

class CsiExceptionHandler extends BaseExceptionHandler {

    protected $csiService;


    public function __construct(LoggerInterface $log, CsiService $csiService)
    {
        parent::__construct($log);

        $this->csiService = $csiService;
    }


    public function render($request, Exception $e)
    {
        if( !env('APP_DEBUG') ) {
            $this->csiService->registerCrash( $e );
        }

        return parent::render($request, $e);
    }

}
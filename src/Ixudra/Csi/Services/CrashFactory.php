<?php namespace Ixudra\Csi\Services;


use Auth;
use Config;
use Request;

class CrashFactory {

    public function createFromException(\Exception $exception)
    {
        return array(

            'project'           => array(

                'public_key'        => $_SERVER['csi.public_key']

            ),

            'exception'         => $this->extractExceptionInput( $exception ),

            'request'           => $this->extractRequestInput(),

            'session'           => $this->extractSessionInput(),

        );
    }

    protected function extractExceptionInput(\Exception $exception)
    {
        $input = array(
            'class_name'                => $exception->getTrace()[0]['class'],
            'method_name'               => $exception->getTrace()[0]['function'] .'()',
            'method_parameters'         => '',
            'line_number'               => $exception->getLine(),
            'exception_name'            => get_class( $exception ),
            'exception_message'         => $exception->getMessage(),
            'call_stack'                => ''
        );

        return $input;
    }

    protected function extractRequestInput()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $platform = $this->getPlatform( $userAgent );
        $browser = $this->getBrowser( $userAgent );

        $input = array(
            'user_ip'               => Request::getClientIp(),
            'platform_name'         => $platform['name'],
            'platform_version'      => $platform['version'],
            'browser_name'          => $browser['name'],
            'browser_version'       => $browser['version'],
            'url'                   => Request::url(),
            'http_method'           => Request::method(),
            'post_data'             => json_encode($_POST),
            'get_data'              => json_encode($_GET)
        );

        return $input;
    }

    protected function getPlatform($userAgent)
    {
        foreach( Config::get('platforms') as $regex => $value ) {
            if( preg_match($regex, $userAgent) ) {
                return $value;
            }
        }

        return array(
            'name'              => '',
            'version'           => ''
        );
    }

    protected function getBrowser($userAgent)
    {
        $version = '';
        try {
            $version = get_browser( $userAgent )['version'];
        } catch(\Exception $e) {

        }

        foreach( Config::get('browsers') as $regex => $value ) {
            if( preg_match($regex, $userAgent) ) {
                return array(
                    'name'              => $value,
                    'version'           => $version
                );
            }
        }

        return array(
            'name'              => '',
            'version'           => ''
        );
    }

    protected function extractSessionInput()
    {
        $input = array(
            'user_id'           => 0,
            'first_name'        => '',
            'last_name'         => '',
            'email'             => ''
        );

        $authenticatedUser = Auth::user();
        if( $authenticatedUser ) {
            $input[ 'user_id' ] = $authenticatedUser->id;
            $input[ 'first_name' ] = $authenticatedUser->first_name;
            $input[ 'last_name' ] = $authenticatedUser->last_name;
            $input[ 'email' ] = $authenticatedUser->email;
        }

        return $input;
    }

}
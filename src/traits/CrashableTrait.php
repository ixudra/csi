<?php namespace Ixudra\Csi\Traits;


Trait CrashableTrait {

    public function encodeJSON()
    {
        return json_encode( $this->attributesToArray() );
    }

}
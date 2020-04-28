<?php

namespace Armincms\Qasedak;
 
use Illuminate\Support\Facades\Facade;  

class Qasedak extends Facade  
{   
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    { 
        return 'qasedak';
    }
}

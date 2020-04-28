<?php

namespace Armincms\Qasedak;

use Illuminate\Support\Manager;
use Armincms\Qasedak\Contracts\Service;
use Illuminate\Support\Traits\Macroable;

class Repository
{ 
    use Macroable {
        __call as macroCall;
    }

    /**
     * The service implementation.
     *
     * @var \Armincms\Qasedak\Contracts\Service
     */
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    } 

    /**
     * Send text-message into a number.
     * 
     * @param  string $text    
     * @param  string $number   
     * @return bool          
     */
    public function message($message, $number)
    { 
        return is_array($number)
                ? $this->bulkMessage($message, $number) 
                : $this->store()->send($message, $number);  
    } 

    public function bulkMessage($message, (array) $numbers)
    {
        if($this->service implements Contracts\BulkService) {
            $this->service->bulk($message, $numbers);
        } else {
            $this->bulkMessageWithoutBulkServices($message, $numbers);
        }

        return $this;
    }

    public function bulkMessageWithoutBulkServices($message, $numbers)
    {
        collect($numbers)->every(function($number) use ($message) {
            $this->message($message, $number);
        });

        return $this;
    }

    /**
     * Get the service implementation.
     *
     * @return \Armincms\Qasedak\Contracts\Service
     */
    public function getService()
    {
        return $this->service;
    } 

    /**
     * Handle dynamic calls into macros or pass missing methods to the service.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->service->$method(...$parameters);
    }

    /**
     * Clone cache repository instance.
     *
     * @return void
     */
    public function __clone()
    {
        $this->service = clone $this->service;
    }
}

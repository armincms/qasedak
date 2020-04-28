<?php

namespace Armincms\Qasedak;

use Armincms\Qasedak\Contracts\Service; 
use SoapClient;

class ArminService implements Service
{   
    public function __construct($config)
    {
        $this->config = (array) $config;
    }

    /**
     * Send text-message into a number.
     * 
     * @param  string $text    
     * @param  string $number  
     * @param  array  $options 
     * @return bool          
     */
    public function send(string $text, $number, $options = [])
    {
        return $this->client()->SendSimpleSMS2(array_merge($this->config, $options));  
    }  

    public function url()
    { 
        $panel = $this->panel();

        return "http://api.{$panel}.com/post/send.asmx?wsdl"; 
    }

    public function panel()
    {
        return $this->config('panel', 'arminsms');
    }

    public function config(string $key, $default)
    {
        return data_get($this->config, $key, $default);
    }

    public function client()
    {
        return new SoapClient($this->url(), array('encoding'=>'UTF-8'));
    }
}

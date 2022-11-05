<?php

namespace Armincms\Qasedak;

use Armincms\Qasedak\Contracts\BulkService;
use SoapClient;

class ArminService implements BulkService
{
    public function __construct($config)
    {
        $this->config = $this->mergeConfigs((array) $config);

        ini_set("soap.wsdl_cache_enabled", "0");
    }

    /**
     * Send text-message into a number.
     * 
     * @param  string $text    
     * @param  string $to  
     * @param  array  $options 
     * @return bool          
     */
    public function sendMessage(string $text, $to, $options = [])
    {
        return $this->client()->SendSimpleSMS2(
            array_merge($this->config, $options, compact('text', 'to'))
        );
    }

    /**
     * Send pattern to the given number.
     * 
     * @param  string $pattern    
     * @param  string $number  
     * @param  array  $variables 
     * @param  array  $options 
     * @return bool          
     */
    public function sendPattern(string $pattern, $number, $variables = [], $options = [])
    {
        return $this->client()->sendPatternSms(
            $this->config('from'),
            $number,
            $this->config('username'),
            $this->config('password'),
            $pattern,
            $variables
        );
    }

    /**
     * Send text-message into a group of numbers.
     * 
     * @param  string $text    
     * @param  array  $to  
     * @param  array  $options 
     * @return bool          
     */
    public function bulk(string $text, array $to, $options = [])
    {
        return $this->client()->SendSimpleSMS(
            array_merge($this->config, $options, compact('text', 'to'))
        );
    }

    public function url()
    {
        return "http://ippanel.com/class/sms/wsdlservice/server.php?wsdl";
    }

    public function panel()
    {
        return $this->config('panel', 'payamak-panel');
    }

    public function mergeConfigs(array $config)
    {
        return array_merge([
            'isflash'   => false,
            'username'  => '',
            'password'  => '',
            'from'  => '',
            'to'    => '',
            'text'  => '',
            'udh'   => '',
        ], $config);
    }

    public function config(string $key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }

    public function client()
    {
        return new SoapClient($this->url(), array('encoding' => 'UTF-8'));
    }
}

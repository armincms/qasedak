<?php

namespace Armincms\Qasedak\Contracts;


interface BulkService extends Service
{
	/**
	 * Send text-message to the given number.
	 * 
	 * @param  string $text    
	 * @param  array  $numbers  
	 * @param  array  $options 
	 * @return bool          
	 */
	public function bulk(string $text, array $numbers, $options = []);
}

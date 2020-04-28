<?php 

namespace Armincs\Qasedak\Contracts;


interface BulkService extends Service
{ 
	/**
	 * Send text-message into a group of numbers.
	 * 
	 * @param  string $text    
	 * @param  array  $numbers  
	 * @param  array  $options 
	 * @return bool          
	 */
	public function bulk(string $text, array $numbers, $options = []);
}
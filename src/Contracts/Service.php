<?php 

namespace Armincs\Qasedak\Contracts;

interface Service 
{
	/**
	 * Send text-message into a number.
	 * 
	 * @param  string $text    
	 * @param  string $number  
	 * @param  array  $options 
	 * @return bool          
	 */
	public function send(string $text, $number, $options = []);  
}
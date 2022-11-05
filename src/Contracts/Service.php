<?php

namespace Armincms\Qasedak\Contracts;

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
	public function sendMessage(string $text, $number, $options = []);

	/**
	 * Send pattern to the given number.
	 * 
	 * @param  string $pattern    
	 * @param  string $number  
	 * @param  array  $variables 
	 * @param  array  $options 
	 * @return bool          
	 */
	public function sendPattern(string $pattern, $number, $variables = [], $options = []);
}

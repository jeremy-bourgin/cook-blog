<?php
namespace App\Exception;

use Exception;

class ConfigException extends Exception
{	
	public function __construct(string $config_name, string $message)
	{
		$message = str_replace("{{1}}", $config_name, $message);
		
		parent::__construct($message);
	}
}

<?php
namespace App\Exception;

use Exception;

abstract class AbstractMessageException extends Exception
{	
	public function __construct(string $message, array $vars)
	{
		foreach ($vars as $i => &$e)
		{
			$v = '{{' . $i . '}}';
			$message = str_replace($v, $e, $message);
		}
		
		parent::__construct($message);
	}
}

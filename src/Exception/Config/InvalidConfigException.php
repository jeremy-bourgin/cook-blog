<?php
namespace App\Exception\Config;

use App\Exception\AbstractMessageException;

class InvalidConfigException extends AbstractMessageException
{
	const MESSAGE = "La configuration {{1}} est invalide (le type ne correspond pas avec la valeur).";
	
	public function __construct($config_name)
	{		
		parent::__construct(self::MESSAGE, array(
			$config_name
		));
	}
}

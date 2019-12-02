<?php
namespace App\Exception\Config;

use App\Exception\ConfigException;

class InvalidConfigException extends ConfigException
{
	const MESSAGE = "La configuration {{1}} est invalide (le type ne correspond pas avec la valeur).";
	
	public function __construct($config_name)
	{		
		parent::__construct($config_name, self::MESSAGE);
	}
}

<?php
namespace App\Exception\Config;

use App\Exception\ConfigException;

class ConfigNotFoundException extends ConfigException
{
	const MESSAGE = "La configuration {{1}} n'a pas été trouvé. Vérifiez la base de données.";
	
	public function __construct($config_name)
	{
		parent::__construct($config_name, self::MESSAGE);
	}
}

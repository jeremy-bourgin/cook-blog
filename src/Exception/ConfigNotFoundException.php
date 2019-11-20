<?php
namespace App\Exception;

use Exception;

class ConfigNotFoundException extends Exception
{
	const MESSAGE = "La configuration {{1}} n'a pas été trouvé. Vérifiez la base de données.";
	
	public function __construct($config_name)
	{
		$message = str_replace("{{1}}", $config_name, self::MESSAGE);
		
		parent::__construct($message);
	}
}

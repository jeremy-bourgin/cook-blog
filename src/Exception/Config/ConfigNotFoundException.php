<?php
namespace App\Exception\Config;

use App\Exception\AbstractMessageException;

class ConfigNotFoundException extends AbstractMessageException
{
	const MESSAGE = "La configuration {{1}} n'a pas été trouvé. Vérifiez la base de données.";
	
	public function __construct($config_name)
	{
		parent::__construct(self::MESSAGE, array(
			$config_name
		));
	}
}

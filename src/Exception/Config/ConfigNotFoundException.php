<?php
namespace App\Exception\Config;

use App\Exception\AbstractMessageException;

class ConfigNotFoundException extends AbstractMessageException
{
	const MESSAGE = "La configuration {{0}} n'a pas été trouvé. Vérifiez la base de données.";
	
	public function __construct(string $config_name)
	{
		parent::__construct(self::MESSAGE, array(
			$config_name
		));
	}
}

<?php
namespace App\Exception;

use Exception;

class PageNotFoundException extends Exception
{
	const MESSAGE = "La page que vous souhaitez consulter n'existe pas.";
	
	public function __construct()
	{		
		parent::__construct(self::MESSAGE);
	}
}

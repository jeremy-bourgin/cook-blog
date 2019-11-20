<?php
namespace App\Exception;

use Exception;

class ContentNotFoundException extends Exception
{
	const MESSAGE = "Le contenu que vous souhaitez consulter n'existe pas.";
	
	public function __construct()
	{
		parent::__construct(self::MESSAGE);
	}
}

<?php
namespace App\Exception;

use Exception;

class ArticleNotFoundException extends Exception
{
	const MESSAGE = "L'article que vous souhaitez consulter n'existe pas.";
	
	public function __construct()
	{
		parent::__construct(self::MESSAGE);
	}
}

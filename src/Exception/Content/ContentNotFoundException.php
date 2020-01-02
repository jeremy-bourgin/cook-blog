<?php
namespace App\Exception\Content;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentNotFoundException extends NotFoundHttpException
{
	const MESSAGE = "Le contenu que vous souhaitez consulter n'existe pas.";
	
	public function __construct()
	{
		parent::__construct(self::MESSAGE);
	}
}

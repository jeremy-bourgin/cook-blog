<?php
namespace App\EventSubscriber\Traits;

use App\Service\UserService;

trait AdminSubscriberTrait
{
	private $user_service;
	
	public function setUserService(UserService $user_service)
	{
		$this->user_service = $user_service;
	}
}

<?php
namespace App\EventSubscriber\Interfaces;

use App\Service\UserService;

interface IAdminSubscriber
{
	function setUserService(UserService $user_service);
}

<?php
namespace App\EventSubscriber\Interfaces;

use App\Service\ConfigService;

interface IControllerSubscriber
{
	function setConfigService(ConfigService $config_service): void;
}

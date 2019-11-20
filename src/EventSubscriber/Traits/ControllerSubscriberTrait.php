<?php
namespace App\EventSubscriber\Traits;

use App\Service\ConfigService;

trait ControllerSubscriberTrait
{
	private $config_service;
	
	public function setConfigService(ConfigService $config_service)
	{
		$this->config_service = $config_service;
	}
}

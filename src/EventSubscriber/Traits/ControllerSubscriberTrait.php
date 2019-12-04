<?php
namespace App\EventSubscriber\Traits;

use App\Service\ConfigService;

trait ControllerSubscriberTrait
{
	protected $config_service;
	
	public function setConfigService(ConfigService $config_service): void
	{
		$this->config_service = $config_service;
	}
}

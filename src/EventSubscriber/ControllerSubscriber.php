<?php
namespace App\EventSubscriber;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\Service\ConfigService;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Twig\Environment;

class ControllerSubscriber implements EventSubscriberInterface
{
	private $config_service;
	private $twig;
	
	public function __construct(Environment $twig, ConfigService $config_service)
	{
		$this->config_service = $config_service;
		$this->twig = $twig;
	}
	
	public function onKernelController(ControllerEvent $event)
	{
		$controller = $event->getController();
		
		$this->twig->addGlobal("config", $this->config_service->getAllConfig());
		
		if (!($controller instanceof IControllerSubscriber))
		{
			return;
		}
		
		$controller->setConfigService($this->config_service);
	}
	
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => "onKernelController"
        );
    }

}

<?php
namespace App\EventSubscriber;

use App\EventSubscriber\Interfaces\IHasAllPagesSubscriber;
use App\Service\ConfigService;
use App\Service\Content\PageService;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Twig\Environment;

class ControllerSubscriber implements EventSubscriberInterface
{
	private $config_service;
	private $page_service;
	private $twig;
	
	public function __construct(ConfigService $config_service, PageService $page_service, Environment $twig)
	{
		$this->config_service = $config_service;
		$this->page_service = $page_service;
		$this->twig = $twig;
	}
	
	public function onKernelController(ControllerEvent $event)
	{
		$temp = $event->getController();

		if (!is_array($temp))
		{
            return;
        }

		$controller = $temp[0];

		if ($controller instanceof IHasAllPagesSubscriber)
		{
			$controller->setPageService($this->page_service);
			$pages = $controller->getAllPages();
		}
		else
		{
			$pages = $this->page_service->getAll();
		}

		$this->twig->addGlobal("global_config", $this->config_service->getAllConfig());
		$this->twig->addGlobal("global_pages", $pages);
	}
	
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => "onKernelController"
        );
    }

}

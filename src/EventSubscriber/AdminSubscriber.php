<?php
namespace App\EventSubscriber;

use App\EventSubscriber\Interfaces\IAdminSubscriber;
use App\Service\UserService;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AdminSubscriber implements EventSubscriberInterface
{
	private $user_service;
	
	public function __construct(UserService $user_service)
	{
		$this->user_service = $user_service;
	}
	
	public function onKernelController(ControllerEvent $event)
	{
		$controller = $event->getController();
		
		if (!($controller instanceof IAdminSubscriber))
		{
			return;
		}
		
		$controller->setUserService($this->user_service);
	}
	
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController'
        );
    }

}

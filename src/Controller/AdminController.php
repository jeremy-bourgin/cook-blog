<?php
namespace App\Controller;

use App\EventSubscriber\Interfaces\IAdminSubscriber;
use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\AdminSubscriberTrait;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
	implements IAdminSubscriber, IControllerSubscriber
{
	use AdminSubscriberTrait;
	use ControllerSubscriberTrait;
	
    /**
     * @Route("%admin_path%/", name="cblog_admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}

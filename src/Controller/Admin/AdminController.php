<?php
namespace App\Controller\Admin;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Interfaces\IHasAllPagesSubscriber;
use App\EventSubscriber\Traits\AllPagesSubscriberTrait;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;
use App\Service\Content\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
	implements IControllerSubscriber, IHasAllPagesSubscriber
{
	use ControllerSubscriberTrait;
	use AllPagesSubscriberTrait;

	private $article_service;
	
	public function __construct(ArticleService $article_service)
	{
		$this->article_service = $article_service;
	}
	
    /**
     * @Route("%admin_path%/", name="cblog_admin")
     */
    public function index()
    {
		$articles = $this->article_service->getAll();
		$configs = $this->config_service->getConfigEntities();
		
        return $this->render('admin/index.html.twig', array(
			"configs" => $configs,
			"articles" => $articles
        ));
    }
}

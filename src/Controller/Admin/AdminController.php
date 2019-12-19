<?php
namespace App\Controller\Admin;

use App\Service\ConfigService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
	private $config_service;
	
	public function __construct(ConfigService $config_service)
	{
		$this->config_service = $config_service;
	}
	
    /**
     * @Route("%admin_path%/", name="cblog_admin")
     */
    public function index()
    {
		$configs = $this->config_service->getConfigEntities();
		
        return $this->render('admin/index.html.twig', array(
			"configs" => $configs
        ));
    }
}

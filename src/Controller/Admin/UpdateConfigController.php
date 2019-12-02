<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateConfigController extends AbstractController
{
    /**
     * @Route("%admin_path%/config/update", name="update_config")
     */
    public function index()
    {
        return $this->render('update_config/index.html.twig', [
            'controller_name' => 'UpdateConfigController',
        ]);
    }
}

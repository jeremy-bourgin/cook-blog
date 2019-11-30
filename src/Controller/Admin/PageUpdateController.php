<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageUpdateController extends AbstractController
{
    /**
     * @Route("%admin_path%/page/update/{id}", name="page_update")
     */
    public function index($id)
    {
        return $this->render('page_update/index.html.twig', [
            'controller_name' => 'PageUpdateController',
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageAddController extends AbstractController
{
    /**
     * @Route("%admin_path%/page/add", name="page_add")
     */
    public function index()
    {
        return $this->render('page_add/index.html.twig', [
            'controller_name' => 'PageAddController',
        ]);
    }
}

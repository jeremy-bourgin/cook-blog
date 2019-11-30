<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageDeleteController extends AbstractController
{
    /**
     * @Route("%admin_path%/page/delete/{id}", name="page_delete")
     */
    public function index(int $id)
    {
        return $this->render('page_delete/index.html.twig', [
            'controller_name' => 'PageDeleteController',
        ]);
    }
}

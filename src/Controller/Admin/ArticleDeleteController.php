<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleDeleteController extends AbstractController
{
    /**
     * @Route("%admin_path%/article/delete/{id}", name="article_delete")
     */
    public function index(int $id)
    {
        return $this->render('article_delete/index.html.twig', [
            'controller_name' => 'ArticleDeleteController',
        ]);
    }
}

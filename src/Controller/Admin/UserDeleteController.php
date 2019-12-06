<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserDeleteController extends AbstractController
{
    /**
     * @Route("/admin/user/delete", name="admin_user_delete")
     */
    public function index()
    {
        return $this->render('admin/user_delete.html.twig', [
            'controller_name' => 'UserDeleteController',
        ]);
    }
}

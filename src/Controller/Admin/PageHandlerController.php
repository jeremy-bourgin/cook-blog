<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageHandlerController extends AbstractController
{
    /**
     * @Route("%admin_path%/page/add", name="page_add")
     */
    public function add()
    {
        return $this->render('admin/content.html.twig', array(
            'controller_name' => 'PageAddController',
        ));
    }

    /**
     * @Route("%admin_path%/page/update/{id}", name="page_update")
     */
    public function update($id)
    {
        return $this->render('admin/content.html.twig', array(
            'controller_name' => 'PageUpdateController',
        ));
    }

    /**
     * @Route("%admin_path%/page/delete/{id}", name="page_delete")
     */
    public function delete(int $id)
    {
        return $this->render('admin/delete.html.twig', array(
            'controller_name' => 'PageDeleteController',
        ));
    }
}

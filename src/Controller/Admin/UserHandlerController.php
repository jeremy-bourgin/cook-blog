<?php

namespace App\Controller\Admin;

use App\Entity\UserEntity;
use App\Form\RegisterForm;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Model\UserManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserHandlerController extends AbstractController
{
    private $user_manager;
    private $form_factory;

    public function __construct(UserManagerInterface $user_manager, FactoryInterface $form_factory)
    {
        $this->user_manager = $user_manager;
        $this->form_factory = $form_factory;
    }

    /**
     * @Route("%admin_path%/user", name="admin_user_index")
     */
    public function index()
    {
        $users = $this->user_manager->findUsers();

        return $this->render('admin/user/index.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("%admin_path%/user/add", name="admin_user_add")
     */
    public function add(Request $request)
    {
        $user = $this->user_manager->createUser();

        $user->setEnabled(true);

        $form = $this->form_factory->createForm();
        $form->setData($user);
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $this->user_manager->updateUser($user);
        }

        return $this->render('admin/user/add.html.twig', array(
            'is_validate' => $is_validate,
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
     * @Route("%admin_path%/user/delete/{id}", name="admin_user_delete")
     */
    public function delete(int $id)
    {
        $user = $this->user_manager->findUserBy(array(
            'id' => $id
        ));

        if ($user === null)
        {
            throw $this->createNotFoundException('user doen\'t not exist');
        }

        /* Begin --- ROLE Check */
        $this->denyAccessUnlessGranted($user->getRoles()); // impossible to delete user who is more important

        if ($user->isSuperAdmin()) // impossible to delete super admin (console only)
        {
            throw $this->createAccessDeniedException('you can\'t delete a super admin user');
        }
        /* End --- ROLE Check */

        $this->user_manager->deleteUser($user);

        return $this->render('admin/user/delete.html.twig');
    }
}

<?php
namespace App\Controller\Admin;

use App\Entity\ContentEntity;
use App\Form\ContentForm;
use App\Service\Admin\AbstractContentHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractContentHandlerController extends AbstractController
{
    public function formHandler(Request $request, AbstractContentHandlerService $content_handler_service, ContentEntity $content)
    {
        $form = $this->createForm(ContentForm::class, $content);
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $data = $form->getData();
            $content_handler_service->save($data);
        }

        return $this->render('admin/content/form.html.twig', array(
            'is_validate' => $is_validate,
            'validate_message' => $this->getValidateMessage(),
            'form' => $form->createView(),
        ));
    }

    public function deleteHandler(AbstractContentHandlerService $content_handler_service, int $id)
    {
        $content_handler_service->delete($id);

        return $this->render('admin/content/delete.html.twig', array(
            'deleted_message' => $this->getDeletedMessage()
        ));
    }

    public abstract function getValidateMessage(): string;

    public abstract function getDeletedMessage(): string;
}
<?php
namespace App\Controller\Admin;

use App\Entity\ContentEntity;
use App\Service\Admin\AbstractContentHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;


abstract class AbstractContentHandlerController extends AbstractController
{
    protected $content_handler_service;

    public function __construct(AbstractContentHandlerService $content_handler_service)
    {
        $this->content_handler_service = $content_handler_service;
    }

    public function indexHandler(array $contents, string $update_path_name, string $delete_path_name)
    {
        return $this->render('admin/content/index.html.twig', array(
            'contents' => $contents,
            'update_path_name' => $update_path_name,
            'delete_path_name' => $delete_path_name
        ));
    }

    public function formHandler(Request $request, Form $form)
    {
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $data = $form->getData();
            $this->content_handler_service->save($data);
        }

        return array(
            'is_validate' => $is_validate,
            'validate_message' => $this->getValidateMessage(),
            'form' => $form->createView()
        );
    }

    public function deleteHandler(ContentEntity $content)
    {
        $this->content_handler_service->delete($content);

        return $this->render('admin/content/content_delete.html.twig', array(
            'deleted_message' => $this->getDeletedMessage()
        ));
    }

    protected abstract function getValidateMessage(): string;

    protected abstract function getDeletedMessage(): string;
}

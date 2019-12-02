<?php
namespace App\Controller\Admin;

use App\Entity\ContentEntity;
use App\Form\ContentForm;
use App\Service\Admin\AbstractContentHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AbstractContentHandlerController extends AbstractController
{
    public function formHandler(Request $request, AbstractContentHandlerService $content_handler_service, ContentEntity $content)
    {
        $form = $this->createForm(ContentForm::class, $content);

        $is_validate = false;

        if ($request->getMethod() === "POST")
        {
            $form->handleRequest($request);

            $is_validate = $form->isSubmitted() && $form->isValid();

            if ($is_validate)
            {
                $data = $form->getData();
                $content_handler_service->save($data);
            }
        }

        return $this->render('admin/content.html.twig', array(
            'is_validate' => $is_validate,
            'validate_message' => "ok",
            'form' => $form->createView(),
        ));
    }
}
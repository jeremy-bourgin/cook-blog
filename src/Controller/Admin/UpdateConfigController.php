<?php
namespace App\Controller\Admin;

use App\Entity\ConfigEntity;
use App\Form\ConfigForm;
use App\Service\Admin\ConfigHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateConfigController extends AbstractController
{
    private $config_handler_service;

    public function __construct(ConfigHandlerService $config_handler_service)
    {
        $this->config_handler_service = $config_handler_service;
    }

    /**
     * @Route("%admin_path%/config/update/{name}", name="update_config")
     */
    public function update(Request $request, ConfigEntity $config)
    {
        $form = $this->createForm(ConfigForm::class, $config);

        $is_validate = false;

        if ($request->getMethod() === "POST")
        {
            $form->handleRequest($request);

            $is_validate = $form->isSubmitted() && $form->isValid();

            if ($is_validate)
            {
                $data = $form->getData();
                $this->config_handler_service->save($data);
            }
        }

        return $this->render('admin/config.html.twig', array(
            'is_validate' => $is_validate,
            'form' => $form->createView(),
        ));
    }
}

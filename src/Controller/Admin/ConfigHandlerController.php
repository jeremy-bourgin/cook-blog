<?php
namespace App\Controller\Admin;

use App\Entity\ConfigEntity;
use App\Form\ConfigForm;
use App\Service\ConfigService;
use App\Service\Admin\ConfigHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConfigHandlerController extends AbstractController
{
    private $config_service;
    private $config_handler_service;

    public function __construct(ConfigService $config_service, ConfigHandlerService $config_handler_service)
    {
        $this->config_service = $config_service;
        $this->config_handler_service = $config_handler_service;
    }

    /**
     * @Route("%admin_path%/config/update/{id}", name="config_update")
     */
    public function update(Request $request, string $id)
    {
        $config = $this->config_service->getConfigEntityByName($id);

        $form = $this->createForm(ConfigForm::class, $config);
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $data = $form->getData();
            $this->config_handler_service->save($data);
        }

        return $this->render('admin/config/config.html.twig', array(
            'is_validate' => $is_validate,
            'form' => $form->createView(),
        ));
    }
}

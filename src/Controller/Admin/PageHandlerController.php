<?php
namespace App\Controller\Admin;

use App\Entity\PageEntity;
use App\Service\Admin\PageHandlerService;
use App\Service\Content\PageService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageHandlerController extends AbstractContentHandlerController
{
    private $page_service;
    private $page_handler_service;

    public function __construct(PageService $page_service, PageHandlerService $page_handler_service)
    {
        $this->page_service = $page_service;
        $this->page_handler_service = $page_handler_service;
    }

    /**
     * @Route("%admin_path%/page/add", name="page_add")
     */
    public function add(Request $request)
    {
        $page = new PageEntity();

        return parent::formHandler($request, $this->page_handler_service, $page);
    }

    /**
     * @Route("%admin_path%/page/update/{id}", name="page_update")
     */
    public function update(Request $request, int $id)
    {
        $page = $this->page_service->getById($id);

        return parent::formHandler($request, $this->page_handler_service, $page);
    }

    /**
     * @Route("%admin_path%/page/delete/{id}", name="page_delete")
     */
    public function delete(int $id)
    {
        return parent::deleteHandler($this->page_handler_service, $id);
    }

    public function getValidateMessage(): string
    {
        return "La page a bien été enregistré";
    }

    public function getDeletedMessage(): string
    {
        return "La page a bien été supprimé";
    }
}

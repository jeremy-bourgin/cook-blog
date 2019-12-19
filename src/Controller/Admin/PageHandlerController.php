<?php
namespace App\Controller\Admin;

use App\Entity\PageEntity;
use App\EventSubscriber\Interfaces\IHasAllPagesSubscriber;
use App\EventSubscriber\Traits\AllPagesSubscriberTrait;
use App\Service\Admin\PageHandlerService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageHandlerController extends AbstractContentHandlerController
    implements IHasAllPagesSubscriber
{
    use AllPagesSubscriberTrait;

    private $page_handler_service;

    public function __construct(PageHandlerService $page_handler_service)
    {
        $this->page_handler_service = $page_handler_service;
    }

    /**
     * @Route("%admin_path%/page/", name="admin_page_index")
     */
    public function index()
    {
        $pages = $this->getAllPages();

        return parent::indexHanlder(
            $pages,
            'admin_page_update',
            'admin_page_delete'
        );
    }

    /**
     * @Route("%admin_path%/page/add", name="admin_page_add")
     */
    public function add(Request $request)
    {
        $page = new PageEntity();

        return parent::formHandler($request, $this->page_handler_service, $page);
    }

    /**
     * @Route("%admin_path%/page/update/{id}", name="admin_page_update")
     */
    public function update(Request $request, PageEntity $page)
    {
        return parent::formHandler($request, $this->page_handler_service, $page);
    }

    /**
     * @Route("%admin_path%/page/delete/{id}", name="admin_page_delete")
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

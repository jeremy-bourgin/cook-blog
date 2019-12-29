<?php
namespace App\Controller\Admin;

use App\Entity\PageEntity;
use App\EventSubscriber\Interfaces\IHasAllPagesSubscriber;
use App\EventSubscriber\Traits\AllPagesSubscriberTrait;
use App\Form\ContentForm;
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

        return parent::indexHandler(
            $pages,
            'admin_page_update',
            'admin_page_delete'
        );
    }

    public function form(Request $request, PageEntity $page)
    {
        $form = $this->createForm(ContentForm::class, $page);
        $render_vars = parent::formHandler($request, $this->page_handler_service, $form);

        return $this->render('admin/content/content_form.html.twig', $render_vars);
    }
    
    /**
     * @Route("%admin_path%/page/add", name="admin_page_add")
     */
    public function add(Request $request)
    {
        $page = new PageEntity();

        return $this->form($request, $page);
    }

    /**
     * @Route("%admin_path%/page/update/{id}", name="admin_page_update")
     */
    public function update(Request $request, PageEntity $page)
    {
        return $this->form($request, $page);
    }

    /**
     * @Route("%admin_path%/page/delete/{id}", name="admin_page_delete")
     */
    public function delete(PageEntity $page)
    {
        return parent::deleteHandler($this->page_handler_service, $page);
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

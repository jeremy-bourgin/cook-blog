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

    public function __construct(PageHandlerService $page_handler_service)
    {
        parent::__construct($page_handler_service);
    }

    /**
     * @Route(
     *  "%admin_path%/page/",
     *  name="admin_page_index",
     *  methods={"GET"}
     * )
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
    
    /**
     * @Route(
     *  "%admin_path%/page/add",
     *  name="admin_page_add",
     *  methods={"GET", "POST"}
     * )
     */
    public function add(Request $request)
    {
        $page = new PageEntity();

        return $this->form($request, $page);
    }

    /**
     * @Route(
     *  "%admin_path%/page/update/{id}",
     *  name="admin_page_update",
     *  methods={"GET", "POST"},
     *  requirements={"id"="\d+"}
     * )
     */
    public function update(Request $request, PageEntity $page)
    {
        return $this->form($request, $page);
    }

    /**
     * @Route(
     *  "%admin_path%/page/delete/{id}",
     *  name="admin_page_delete",
     *  methods={"GET"},
     *  requirements={"id"="\d+"}
     * )
     */
    public function delete(PageEntity $page)
    {
        return parent::deleteHandler($page);
    }

    protected function getValidateMessage(): string
    {
        return "page_save_success";
    }

    protected function getDeletedMessage(): string
    {
        return "page_delete_success";
    }

    protected function form(Request $request, PageEntity $page)
    {
        $form = $this->createForm(ContentForm::class, $page);
        $render_vars = parent::formHandler($request, $form);

        return $this->render('admin/content/content_form.html.twig', $render_vars);
    }
}

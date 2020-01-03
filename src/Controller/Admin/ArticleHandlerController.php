<?php
namespace App\Controller\Admin;

use App\Entity\ArticleEntity;
use App\Form\ArticleForm;
use App\Service\Admin\ArticleHandlerService;
use App\Service\Content\ArticleService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleHandlerController extends AbstractContentHandlerController
{
    protected $article_service;

    public function __construct(ArticleService $article_service, ArticleHandlerService $article_handler_service)
    {
        parent::__construct($article_handler_service);

        $this->article_service = $article_service;
    }

    /**
     * @Route(
     *  "%admin_path%/article/",
     *  name="admin_article_index",
     *  methods={"GET"}
     * )
     */
    public function index()
    {
        $articles = $this->article_service->getAll();
        
        return parent::indexHandler(
            $articles,
            'admin_article_update',
            'admin_article_delete'
        );
    }

    /**
     * @Route(
     *  "%admin_path%/article/add",
     *  name="admin_article_add",
     *  methods={"GET", "POST"}
     * )
     */
    public function add(Request $request)
    {
        $article = new ArticleEntity();
        $article->setTime(time());
        $article->setUser($this->getUser());

        return $this->form($request, $article);
    }

    /**
     * @Route(
     *  "%admin_path%/article/update/{id}",
     *  name="admin_article_update",
     *  methods={"GET", "POST"},
     *  requirements={"id"="\d+"}
     * )
     */
    public function update(Request $request, ArticleEntity $article)
    {
        return $this->form($request, $article);
    }

    /**
     * @Route(
     *  "%admin_path%/article/delete/{id}",
     *  name="admin_article_delete",
     *  methods={"GET"},
     *  requirements={"id"="\d+"}
     * )
     */
    public function delete(ArticleEntity $article)
    {
        return parent::deleteHandler($article);
    }

    protected function getValidateMessage(): string
    {
        return "article_save_success";
    }

    protected function getDeletedMessage(): string
    {
        return "article_delete_success";
    }

    protected function form(Request $request, ArticleEntity $article)
    {
        $form = $this->createForm(ArticleForm::class, $article);
        $render_vars = parent::formHandler($request, $form);

        return $this->render('admin/content/article_form.html.twig', $render_vars);
    }
}

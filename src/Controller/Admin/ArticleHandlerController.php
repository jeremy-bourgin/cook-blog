<?php
namespace App\Controller\Admin;

use App\Entity\ArticleEntity;
use App\Form\ContentForm;
use App\Service\Admin\ArticleHandlerService;
use App\Service\Content\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleHandlerController extends AbstractContentHandlerController
{
    private $article_service;
    private $article_handler_service;

    public function __construct(ArticleService $article_service, ArticleHandlerService $article_handler_service)
    {
        $this->article_service = $article_service;
        $this->article_handler_service = $article_handler_service;
    }

    /**
     * @Route("%admin_path%/article/add", name="article_add", methods={"GET", "POST"})
     */
    public function add(Request $request)
    {
        $article = new ArticleEntity();
        $article->setTime(time());
        $article->setUser($this->getUser());

        return parent::formHandler($request, $this->article_handler_service, $article);
    }

    /**
     * @Route("%admin_path%/article/update/{id}", name="article_update", methods={"GET", "POST"})
     */
    public function update(Request $request, int $id)
    {
        $article = $this->article_service->getById($id);

        return parent::formHandler($request, $this->article_handler_service, $article);
    }

    /**
     * @Route("%admin_path%/article/delete/{id}", name="article_delete", methods={"GET", "POST"})
     */
    public function delete(int $id)
    {
        return $this->render('admin/delete.html.twig', array(
            'controller_name' => 'ArticleDeleteController',
        ));
    }
}

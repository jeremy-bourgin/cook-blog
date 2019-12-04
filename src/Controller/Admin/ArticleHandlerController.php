<?php
namespace App\Controller\Admin;

use App\Entity\ArticleEntity;
use App\Service\Admin\ArticleHandlerService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleHandlerController extends AbstractContentHandlerController
{
    private $article_handler_service;

    public function __construct(ArticleHandlerService $article_handler_service)
    {
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
    public function update(Request $request, ArticleEntity $article)
    {
        return parent::formHandler($request, $this->article_handler_service, $article);
    }

    /**
     * @Route("%admin_path%/article/delete/{id}", name="article_delete", methods={"GET", "POST"})
     */
    public function delete(int $id)
    {
        return parent::deleteHandler($this->article_handler_service, $id);
    }

    public function getValidateMessage(): string
    {
        return "L'article a bien été enregistré";
    }

    public function getDeletedMessage(): string
    {
        return "L'article a bien été supprimé";
    }
}

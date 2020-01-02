<?php
namespace App\Controller\Admin;

use App\Entity\CommentEntity;
use App\Service\Admin\CommentHandlerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentHandlerController extends AbstractController
{
    private $comment_handler_service;

    public function __construct(CommentHandlerService $comment_handler_service)
    {
        $this->comment_handler_service = $comment_handler_service;
    }

    /**
     * @Route(
     *  "%admin_path%/comment/delete/{id}",
     *  name="admin_comment_delete",
     *  methods={"GET"},
     *  requirements={"id"="\d+"}
     * )
     */
    public function delete(CommentEntity $comment)
    {
        $this->comment_handler_service->delete($comment);
        $article_url = $comment->getArticle()->getUrl();

        return $this->render('admin/content/comment_delete.html.twig', array(
            'article_url' => $article_url,
        ));
    }
}

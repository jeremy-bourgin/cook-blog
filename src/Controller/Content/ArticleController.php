<?php
namespace App\Controller\Content;

use App\Entity\CommentEntity;
use App\Form\CommentFormType;
use App\Service\Content\ArticleService;
use App\Service\Content\CommentService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $article_service;
    private $comment_service;

    public function __construct(ArticleService $article_service, CommentService $comment_service)
    {
        $this->article_service = $article_service;
        $this->comment_service = $comment_service;
    }

    /**
     * @Route(
     *  "/article/{url}",
     *  name="article",
     *  methods={"GET", "POST"}
     * )
     */
    public function index(Request $request, string $url)
    {
        $article = $this->article_service->getByUrl($url);

        $comment = new CommentEntity();
        $comment->setArticle($article);
        $comment->setTime(time());

        $comment_form = $this->createForm(CommentFormType::class, $comment);
        $comment_form->handleRequest($request);

        $is_submited = $comment_form->isSubmitted();
        $is_validate = $is_submited && $comment_form->isValid();

        if ($is_validate)
        {
            $this->comment_service->save($comment);
        }

        return $this->render('content/article.html.twig', array(
            'article' => $article,
            'comment_form' => $comment_form->createView(),
            'is_validate' => $is_validate
        ));
    }
}

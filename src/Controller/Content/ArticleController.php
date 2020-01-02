<?php
namespace App\Controller\Content;

use App\Entity\CommentEntity;
use App\Form\CommentFormType;
use App\Service\ConfigService;
use App\Service\Content\ArticleService;
use App\Service\Content\CommentService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $config_service;
    private $article_service;
    private $comment_service;

    public function __construct(ConfigService $config_service, ArticleService $article_service, CommentService $comment_service)
    {
        $this->config_service = $config_service;
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
        $is_comment_enable = $this->config_service->getConfigValue('comment_enable');

        if ($is_comment_enable)
        {
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

            $comment_form_view = $comment_form->createView();
        }
        else
        {
            $is_validate = false;
            $comment_form_view = null;
        }

        return $this->render('content/article.html.twig', array(
            'article' => $article,
            'comment_form' => $comment_form_view,
            'is_validate' => $is_validate
        ));
    }
}

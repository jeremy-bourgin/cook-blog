<?php
namespace App\Controller\Contact;

use App\Entity\ContactEntity;
use App\Form\ContactFormType;
use App\Service\MailerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $mailer_service;

    public function __construct(MailerService $mailer_service)
    {
        $this->mailer_service = $mailer_service;
    }

    /**
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function index(Request $request)
    {
        $contact = new ContactEntity();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $this->mailer_service->sendMail(
                $contact->getFrom(),
                $contact->getObject(),
                $contact->getMessage()
            );
        }

        return $this->render('contact/index.html.twig', array(
            'form' => $form->createView(),
            'is_validate' => $is_validate,
        ));
    }
}

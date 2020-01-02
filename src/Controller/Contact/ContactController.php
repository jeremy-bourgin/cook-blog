<?php
namespace App\Controller\Contact;

use App\Entity\ContactEntity;
use App\Form\ContactFormType;
use App\Service\ConfigService;
use App\Service\MailerService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $config_service;
    private $mailer_service;

    public function __construct(ConfigService $config_service, MailerService $mailer_service)
    {
        $this->config_service = $config_service;
        $this->mailer_service = $mailer_service;
    }

    /**
     * @Route(
     *  "/contact",
     *  name="contact",
     *  methods={"GET", "POST"}
     * )
     */
    public function index(Request $request)
    {
        if (!$this->config_service->getConfigValue('contact_enable'))
        {
            throw $this->createNotFoundException();
        }

        $contact = new ContactEntity();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        $is_submited = $form->isSubmitted();
        $is_validate = $is_submited && $form->isValid();

        if ($is_validate)
        {
            $this->mailer_service->sendMail(
                $contact->getFrom(),
                $this->config_service->getConfigValue('contact_email'),
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

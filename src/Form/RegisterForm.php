<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RegisterForm extends AbstractType
{
    private $checker;

    public function __construct(AuthorizationCheckerInterface $checker)
    {
        $this->checker = $checker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'roles'));
    }

    public function roles(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if ($user === null)
        {
            return;
        }

        if(!$this->checker->isGranted('ROLE_ADMIN'))
        {
            return;
        }

        $form
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'admin' => 'ROLE_ADMIN',
                    'user' => 'ROLE_USER'
                ),
                'multiple' => true,
                'required' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'user'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

}

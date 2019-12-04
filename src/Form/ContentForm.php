<?php
namespace App\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('url', TextType::class)
            ->add('title', TextType::class)
            ->add('content', CKEditorType::class)
            ->add('save', SubmitType::class);
    }
}

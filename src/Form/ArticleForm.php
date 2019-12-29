<?php
namespace App\Form;

use App\Entity\ArticleEntity;

use FOS\CKEditorBundle\Form\Type\CKEditorType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('summarize', CKEditorType::class)
            ->add('file', FileType::class, array(
                'required' => false,
                'mapped' => true
            ));
    }

    public function getParent()
    {
        return 'App\Form\ContentForm';
    }

}

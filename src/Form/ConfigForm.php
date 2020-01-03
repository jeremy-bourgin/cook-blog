<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $entity = $builder->getData();
        $type = $entity->getInputType();
        $choices = array();

        if ($type == ChoiceType::class)
        {
        	$choices['choices'] = array(
				'yes' => "1",
				'no' => "0",
        	);
        }

        $builder
        	->add('name', TextType::class, array(
                'disabled' => true
            ))
            ->add('raw_value', $type, $choices)
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'config'
        ));
    }
}

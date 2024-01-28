<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Stack;
use App\Form\DataTransformer\AppImageTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function __construct(
        private AppImageTransformer $transformer,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('lang', EntityType::class, [
                'class' => Stack::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('slug')
            ->add('imgFile', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'data_class' => null,
            ]);
//        $builder->get('imgFile')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}

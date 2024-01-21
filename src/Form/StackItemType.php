<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Tool;
use App\Repository\AppsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StackItemType extends AbstractType
{
    public function __construct(private readonly AppsRepository $applicationRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('description')
            ->add('application', EntityType::class, [
                'class' => Application::class,
                'query_builder' => function (AppsRepository $repo) {
                    return $repo->createQueryBuilder('a')
                        ->join('a.lang', 'l');
                },
                'choice_label' => function (Application $application) {
                    return sprintf("%s, %s", $application->getLang()->getName(), $application->getName());
                },
                'choice_value' => 'id',
                'multiple' => false,
//                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tool::class,
        ]);
    }
}

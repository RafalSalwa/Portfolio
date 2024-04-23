<?php

namespace App\Form;

use App\Enum\ContactPersonType;
use App\Enum\ContactReason;
use App\Enum\ContactTechStaffReason;
use App\Form\DataTransformer\EnumTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class DependentContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('visitor', EnumType::class,[
                'class'=>ContactPersonType::class,
                'choice_label'=> fn(ContactPersonType $type):string=> $type->name,
                'placeholder' => 'Who You are?',
            ])
            ->addDependent('kind', 'visitor', function (DependentField $field, ?ContactPersonType $reason) {
                if(null === $reason){
                    return;
                }
                if (ContactPersonType::Interviewer !== $reason) {
                    $field->add(EnumType::class, [
                        'class' => ContactTechStaffReason::class,
                        'placeholder' => '(tech) What is the intent of contact?',
                        'choice_label' => fn (ContactTechStaffReason $reason): string => $reason->name,
                        'required' => false,
                    ]);
                } else {
                    $field->add(EnumType::class, [
                        'class' => ContactReason::class,
                        'placeholder' => 'What is the intent of contact?',
                        'choice_label' => fn (ContactReason $reason): string => $reason->name,
                        'required' => false,
                    ]);
                }
            })
            ->addDependent('subject', 'kind', function (DependentField $field, ContactReason|ContactTechStaffReason|null $reason) {
                if (null === $reason) {
                    return;
                }

                $field->add(TextType::class, [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Topic, keywords or tags please.'
                    ],
                    'trim' => false,
                ]);
            })
            ->addDependent('message', 'subject', function (DependentField $field, $subject) {
                if (null === $subject) {
                    return;
                }

                $field->add(TextareaType::class, [
                    'required' => true,
                    'trim' => false,
                    'attr' => [
                        'rows'=>6,
                    ],
                ]);
            })
            ->addDependent('submit', 'message', function (DependentField $field, $message) {
                if (null === $message) {
                    return;
                }

                $field->add(SubmitType::class, [
                    'attr' => [
                        'class'=>'btn-contact-submit',
                    ],
                ]);
            })
        ;
    }
}

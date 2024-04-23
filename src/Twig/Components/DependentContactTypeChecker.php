<?php

namespace App\Twig\Components;

use App\Form\DependentContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class DependentContactTypeChecker extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;
    public $sendoutStatus;
    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(DependentContactType::class);
    }

    public function getSendoutStatus()
    {
        return $this->sendoutStatus;
    }
}

<?php

namespace App\Form\DataTransformer;

use App\Entity\Application;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AppImageTransformer implements DataTransformerInterface
{
    /** @var Application $value */
    public function transform(mixed $value): ?string
    {
        return '';
    }

    /** @var UploadedFile $value */
    public function reverseTransform(mixed $value): ?string
    {
        if (!$value) {
            return null;
        }
        if (!$value instanceof UploadedFile) {
            return null;
        }
        $value->getFilename();

        return 'img/app/'.$value->getClientOriginalName();
    }
}

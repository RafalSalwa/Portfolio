<?php

namespace App\Twig;

class CdnPackageProvider
{

    public function getVersion(string $path): string
    {
        return '';
    }

    public function getUrl(string $path): string
    {
        return 'https://cdn.salwa.com.pl';
    }
}
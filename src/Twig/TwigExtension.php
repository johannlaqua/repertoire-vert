<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
class TwigExtension extends AbstractExtension
{

    public function getName()
    {
         return 'twig_extension';
    }

    public function getFilters()
    {

        return [
            new TwigFilter('basename', [$this, 'basenameFilter'])
         ];

    }

    /**
    * @var string $value
    * @return string
    */
    public function basenameFilter($value, $suffix = '')
    {
        return basename($value, $suffix);
    }
}
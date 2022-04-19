<?php

namespace App\Data;

class SearchData
{
    /**
     * page
     * @var integer
     */
    public $page = 1;

    /**
     * mot-clé
     * @var string
     */
    public $q = '';

    /**
     *
     * @var array //Category []
     */
    public $category= [];

    /**
     * prix max
     *
     * @var null|integer
     */
    public $max;

    /**
     * prix min
     *
     * @var null|integer
     */
    public $min;




}
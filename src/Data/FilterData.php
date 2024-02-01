<?php

namespace App\Data;

use App\Entity\Author;
use App\Entity\Gender;

/**
 * Objet qui contient les données pour le filtre
 */
class FilterData
{
    /**
     * @var Author[]
     */
    public $authors;

    /**
     * @var Gender[]
     */
    public $genders;
}
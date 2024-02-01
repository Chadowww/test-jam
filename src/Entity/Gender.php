<?php

namespace App\Entity;

/**
 *  Objet Gender
 */
class Gender
{
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $gender_name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGenderName()
    {
        return $this->gender_name;
    }

    /**
     * @param mixed $gender_name
     */
    public function setGenderName($gender_name)
    {
        $this->gender_name = $gender_name;
    }

}
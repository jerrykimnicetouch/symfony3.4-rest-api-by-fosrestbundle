<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="star")
 */

class Star
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $profession;
    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $career;

    public function setName($newName)
    {
        $this->name = (string) $newName;
    }
    public function getName()
    {
        return $this->name;
    }
    public function changeName($newName)
    {
        $this->name = (string) $newName;

        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setProfession($newProfession)
    {
        $this->profession = (string) $newProfession;
    }
    public function getProfession()
    {
        return $this->profession;
    }
    public function setCareer($newCareer)
    {
        $this->career = (string) $newCareer;
    }
    public function getCareer()
    {
        return $this->career;
    }
}

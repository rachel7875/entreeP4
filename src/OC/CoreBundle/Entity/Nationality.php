<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nationality
 *
 * @ORM\Table(name="nationality")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\NationalityRepository")
 */
class Nationality

{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="nationalityName", type="string", length=255)
     */
    private $nationalityName;

   

    public function getId()
    {
        return $this->id;
    }

    public function setNationalityName($nationalityName)
    {
        $this->nationalityName = $nationalityName;

        return $this;
    }

    public function getNationalityName()
    {
        return $this->nationalityName;
    }


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity
 */
class Service extends Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    // /**
    // * @var string
    // *
    // * @ORM\Column(name="name", type="string", length=255, nullable=true)
    // */
    // private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceduration", type="string",length=255,nullable=true)
     */
    protected $serviceduration; //service

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Service
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getServiceduration()
    {
        return $this->serviceduration;
    }

    /**
     * @param string $serviceduration
     */
    public function setServiceduration($serviceduration)
    {
        $this->serviceduration = $serviceduration;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Location
 *
 * @ORM\Table(name="locations")
 * @ORM\Entity
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", unique=true, length=255)
     */
    private $name;

    /**
     * @var ArrayCollection|Ads
     * @OneToMany(targetEntity="App\Entity\Ads", mappedBy="location")
     */
    private $ads;


    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

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
     * @return Location
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
     * @return Ads|ArrayCollection
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param Ads|ArrayCollection $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
    }
}
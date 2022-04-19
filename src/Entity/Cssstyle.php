<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Cssstyle
 *
 * @ORM\Table(name="cssstyle")
 * @ORM\Entity
 */
class Cssstyle
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
     * @ORM\Column(name="value", type="string", unique=true, length=255)
     */
    private $value;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", unique=true, length=255)
     */
    private $name;
    /**
     * @var ArrayCollection|Ads
     * @OneToMany(targetEntity="App\Entity\Ads", mappedBy="value")
     */
    private $ads;


    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
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
    public function setAds($ads): void
    {
        $this->ads = $ads;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
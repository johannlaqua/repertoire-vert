<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Depense
 * @ORM\Entity
 * @ORM\Table(name="depense")

 */
class Depense
{

    public function __construct()
    {

    }

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
     * @ORM\Column(name="steps", type="integer")
     */
    protected $steps;
    /**
     * @var string
     *
     * @ORM\Column(name="co2", type="integer")
     */
    protected $co2;

    /**
     * @var string
     *
     * @ORM\Column(name="calories", type="integer")
     */
    protected $calories;
    /**
     * @var string
     *
     * @ORM\Column(name="transporttype", type="string", length=255)
     */
    protected $transporttype;
    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=255)
     */
    protected $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="integer")
     */
    protected $distance;
    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string")
     */
    protected $geo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *@ORM\JoinColumn(name="createur", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $createur;

    /**
     * @var \String
     *
     * @ORM\Column(name="privacy", type="string")
     */
    private $privacy;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param string $steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return string
     */
    public function getCo2()
    {
        return $this->co2;
    }

    /**
     * @param string $co2
     */
    public function setCo2($co2)
    {
        $this->co2 = $co2;
    }

    /**
     * @return string
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * @param string $calories
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;
    }

    /**
     * @return string
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param string $geo
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param string $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getTransporttype()
    {
        return $this->transporttype;
    }

    /**
     * @param string $transporttype
     */
    public function setTransporttype($transporttype)
    {
        $this->transporttype = $transporttype;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return User
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * @param User $createur
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;
    }

    /**
     * @return String
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * @param String $privacy
     */
    public function setPrivacy($privacy)
    {
        $this->privacy = $privacy;
    }



}
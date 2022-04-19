<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarifAdsUser
 *
 * @ORM\Table(name="tarifadsuser")
 * @ORM\Entity
 */
class TarifAdsUser
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TarifAds")
     * @ORM\JoinColumn(name="tarif", referencedColumnName="id")
     */
    private $tarif; //all

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads")
     * @ORM\JoinColumn(name="adv", referencedColumnName="id")
     */
    private $adv;
    /**
     * @var string
     *
     * @ORM\Column(name="paid", type="boolean")
     */
    protected $paid; //service

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="integer")
     */
    protected $price; //service
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
     * @return mixed
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * @param mixed $tarif
     */
    public function setTarif($tarif): void
    {
        $this->tarif = $tarif;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPaid(): string
    {
        return $this->paid;
    }

    /**
     * @param string $paid
     */
    public function setPaid(string $paid): void
    {
        $this->paid = $paid;
    }

    /**
     * @return mixed
     */
    public function getAdv()
    {
        return $this->adv;
    }

    /**
     * @param mixed $adv
     */
    public function setAdv($adv): void
    {
        $this->adv = $adv;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    } //all




}

<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ads
 * @ORM\Entity(repositoryClass="App\Repository\AdsRepository")
 * @ORM\Table(name="ads")
 */
class Ads
{

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */

    private $creator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
     */
    private $createdAt;

    /**
     * @ManyToOne(targetEntity="App\Entity\Location", inversedBy="ads")
     * @JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishdatebegin", type="date", nullable=true)
     */
    protected $publishdatebegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishdateend", type="date",nullable=true)
     */
    protected $publishdateend;

    /**
     * @ORM\Column(name="photo", type="string", length=5000)
     * @Assert\File(maxSize="5000k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    protected $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string")
     */
    protected $slogan;


    /**
     * @var boolean
     *
     * @ORM\Column(name="payed", type="boolean")
     */
    protected $payed;
    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    protected $price;
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Collection
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    /**
     * @param Collection $pages
     */
    public function setPages(Collection $pages): void
    {
        $this->pages = $pages;
    }


    /**
     * Get getPublishdatebegin
     *
     * @return \DateTime
     */
    public function getPublishdatebegin()
    {
        return $this->publishdatebegin;
    }

    /**
     * @param \DateTime $publishdatebegin
     */
    public function setPublishdatebegin(\DateTime $publishdatebegin)
    {
        $this->publishdatebegin = $publishdatebegin;
    }
    /**
     * Get getPublishdateend
     *
     * @return \DateTime
     */
    public function getPublishdateend()
    {
        return $this->publishdateend;
    }

    /**
     * @param \DateTime $publishdateend
     */
    public function setPublishdateend(\DateTime $publishdateend): void
    {
        $this->publishdateend = $publishdateend;
    }




    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getSlogan(): string
    {
        return $this->slogan;
    }

    /**
     * @param string $slogan
     */
    public function setSlogan(string $slogan): void
    {
        $this->slogan = $slogan;
    }

    /**
     * @return bool
     */
    public function isPayed(): bool
    {
        return $this->payed;
    }

    /**
     * @param bool $payed
     */
    public function setPayed(bool $payed): void
    {
        $this->payed = $payed;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }





}
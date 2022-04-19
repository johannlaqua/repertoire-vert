<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductAds
 * @ORM\Entity
 * @ORM\Table(name="productAds")
 */
class ProductAds
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="profilelink", type="string")
     */
    protected $profilelink;
    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string")
     */
    protected $slogan;
    /**
     * @var string
     *
     * @ORM\Column(name="companyname", type="string")
     */
    protected $companyname;
    /**
     * @ORM\Column(name="photo", type="string", length=500)
     * @Assert\File(maxSize="5000k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    private $photo;
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
     * @return string
     */
    public function getProfilelink(): string
    {
        return $this->profilelink;
    }

    /**
     * @param string $profilelink
     */
    public function setProfilelink(string $profilelink): void
    {
        $this->profilelink = $profilelink;
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
     * @return string
     */
    public function getCompanyname(): string
    {
        return $this->companyname;
    }

    /**
     * @param string $companyname
     */
    public function setCompanyname(string $companyname): void
    {
        $this->companyname = $companyname;
    }



}
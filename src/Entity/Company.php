<?php

namespace App\Entity;

use App\Entity\Category;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Serializable;
use Doctrine\Common\Collections\Collection;


/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * */
class Company extends User 
{
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->productclicks = new ArrayCollection();
        $this->visites = new ArrayCollection();
        $this->companyFavCompanies = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string",length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="certification", type="string",length=255,nullable=true)
     */
    protected $certification;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category",inversedBy="companies", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id",nullable=true)
     */
    private $categories;

    /**
     * @ORM\Column(name="niveau",type="string",nullable=false)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="influencezone", type="string",length=255)
     */
    protected $influencezone;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string",length=255)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="streetnumber", type="string",nullable=true)
     */
    protected $streetnumber;

    /**
     * @var smallint
     *
     * @ORM\Column(name="postcode", type="smallint")
     */
    protected $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string",length=255)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string",length=255)
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string",length=255)
     */
    protected $country;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string",length=255)
     */
    protected $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wantevaluation", type="boolean")
     */
    protected $wantevaluation;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var text
     *
     * @ORM\Column(name="vision", type="text")
     */
    protected $vision;

    /**
     * @var text
     *
     * @ORM\Column(name="socialreason", type="text")
     */
    protected $socialreason;

    /**
     * @var string
     *
     * @ORM\Column(name="urlwebsite", type="string",length=255,nullable=true)
     */
    protected $urlwebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="urlfacebook", type="string",length=255,nullable=true)
     */
    protected $urlfacebook;

    /**
     * @var string
     *
     * @ORM\Column(name="urltwitter", type="string",length=255,nullable=true)
     */
    protected $urltwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="urllinkedin", type="string",length=255,nullable=true)
     */
    protected $urllinkedin;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string",length=255)
     */
    protected $slug;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starting_date", type="date",nullable=true)
     */
    protected $startingdate;

    /**
     * @ORM\OneToMany(targetEntity=ProductClick::class, mappedBy="company",cascade={"persist"}, orphanRemoval=true)
     */
    private $productclicks;


    /**
     * @var smallint
     *
     * @ORM\Column(name="package", type="smallint",nullable=true)
     */
    protected $package;

    /**
     * @ORM\Column(name="image", type="string",nullable=true)
     **/
    protected $image;

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setCompany($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getCompany() === $this) {
                $visite->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductClick[]
     */
    public function getProductclicks(): Collection
    {
        return $this->productclicks;
    }

    public function addProductclick(ProductClick $productclick): self
    {
        if (!$this->productclicks->contains($productclick)) {
            $this->productclicks[] = $productclick;
            $productclick->setCompany($this);
        }

        return $this;
    }

    public function removeProductclick(ProductClick $productclick): self
    {
        if ($this->cartlines->removeElement($productclick)) {
            // set the owning side to null (unless already changed)
            if ($productclick->getCompany() === $this) {
                $productclick->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return boolean
     */
    public function isWantevaluation()
    {
        return $this->wantevaluation;
    }

    /**
     * @param boolean $wantevaluation
     */
    public function setWantevaluation($wantevaluation)
    {
        $this->wantevaluation = $wantevaluation;
    }

    /**
     * @return date
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param date $certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }

    /**
     * @return \DateTime
     */
    public function getstartingdate()
    {
        return $this->startingdate;
    }

    /**
     * @param \DateTime $startingdate
     */
    public function setstartingdate($startingdate)
    {
        $this->startingdate = $startingdate;
    }

    /**
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

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
    public function getInfluencezone()
    {
        return $this->influencezone;
    }

    /**
     * @param string $influencezone
     */
    public function setInfluencezone($influencezone)
    {
        $this->influencezone = $influencezone;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return text
     */
    public function getSocialreason()
    {
        return $this->socialreason;
    }

    /**
     * @param text $socialreason
     */
    public function setSocialreason($socialreason)
    {
        $this->socialreason = $socialreason;
    }

    /**
     * @return string
     */
    public function getUrlfacebook()
    {
        return $this->urlfacebook;
    }

    /**
     * @param string $urlfacebook
     */
    public function setUrlfacebook($urlfacebook)
    {
        $this->urlfacebook = $urlfacebook;
    }

    /**
     * @return string
     */
    public function getUrllinkedin()
    {
        return $this->urllinkedin;
    }

    /**
     * @param string $urllinkedin
     */
    public function setUrllinkedin($urllinkedin)
    {
        $this->urllinkedin = $urllinkedin;
    }

    /**
     * @return string
     */
    public function getUrltwitter()
    {
        return $this->urltwitter;
    }

    /**
     * @param string $urltwitter
     */
    public function setUrltwitter($urltwitter)
    {
        $this->urltwitter = $urltwitter;
    }

    /**
     * @return string
     */
    public function getUrlwebsite()
    {
        return $this->urlwebsite;
    }

    /**
     * @param string $urlwebsite
     */
    public function setUrlwebsite($urlwebsite)
    {
        $this->urlwebsite = $urlwebsite;
    }

    /**
     * @return text
     */
    public function getVision()
    {
        return $this->vision;
    }

    /**
     * @param text $vision
     */
    public function setVision($vision)
    {
        $this->vision = $vision;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    /*public function setCategory(Category $category)
    {
        $this->categories = $categories;
        return $this;
    } */

    /**
     * @return smallint
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param smallint $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * @param string $streetnumber
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;
    }

    /**
     * @return smallint
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param smallint $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return bool
     */
    public function isActived()
    {
        return $this->actived;
    }

    /**
     * @param bool $actived
     */
    public function setActived($actived)
    {
        $this->actived = $actived;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /* @param string $image
     * @return mixed
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    



    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longtitude;

    /**
     * @ORM\OneToMany(targetEntity="CompanyFav", mappedBy="company")
     */

    private $companyFavCompanies;

    /**
     * @ORM\OneToMany(targetEntity="Visite", mappedBy="company")
     */
    
    private $visites;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="company", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activated = true;

    /**
     * @return Collection|CompanyFav[]
     */
    public function getCompanyFavCompanies(): Collection
    {
        return $this->companyFavCompanies;
    }

    public function addCompanyFavCompany(CompanyFav $compfav): self
    {
        if (!$this->companyFavCompanies->contains($compfav)) {
            $this->companyFavCompanies[] = $compfav;
            $compfav->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyFavCompany(CompanyFav $compfav): self
    {
        if ($this->companyFavCompanies->removeElement($compfav)) {
            // set the owning side to null (unless already changed)
            if ($compfav->getCompany() === $this) {
                $compfav->setCompany(null);
            }
        }

        return $this;
    }

    public function getWantevaluation(): ?bool
    {
        return $this->wantevaluation;
    }



    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongtitude(): ?float
    {
        return $this->longtitude;
    }

    public function setLongtitude(float $longtitude): self
    {
        $this->longtitude = $longtitude;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCompany($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCompany() === $this) {
                $product->setCompany(null);
            }
        }

        return $this;
    }

    public function getActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }



}

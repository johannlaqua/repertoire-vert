<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"product" = "Product", "service" = "Service", "marchandise"="Marchandise"})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{

    public function __construct(){
        $this->date = new \Datetime();
        $this->subcategories = new ArrayCollection();
        $this->cartlines = new ArrayCollection();
        $this->productclicks = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->productFavProducts = new ArrayCollection();
    }


    /**
     * @ORM\OneToMany(targetEntity="ProductFav", mappedBy="product", cascade={"remove"}, orphanRemoval=true)
     *
     */
    private $productFavProducts;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id")
     */
    private $owner; //all
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string",length=255, unique=false)
     */
    protected $name; //all
    /**
     * @var double
     *
     * @ORM\Column(name="latitude", type="decimal",nullable=true)
     */
    protected $latitude; //all
    /**
     * @var double
     *
     * @ORM\Column(name="longitude", type="decimal",nullable=true)
     */
    protected $longitude; //all
    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    protected $description; //all

    /**
     * @ORM\Column(name="niveau",type="string",nullable=true)
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="string",length=255, nullable=true)
     */

    protected $origin; //all

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string",length=255)
     */
    protected $slug; //all

    /**
     * @var string
     *
     * @ORM\Column(name="certification", type="string",length=255)
     */
    protected $certification; //all

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="float",nullable=true)
     */
    protected $price; //all

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string",length=255, nullable=true)
     */
    protected $currency; //all

    /**
     * @var boolean
     *
     * @ORM\Column(name="wantevaluation", type="boolean")
     */

    protected $wantevaluation; //all
    /**
     * @var boolean
     *

     * @ORM\Column(name="gaearecommanded", type="boolean")
     */
    protected $gaearecommanded; //all

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="date")
     */
    protected $creationdate; //all

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="date", nullable=true)
     */
    protected $updateddate; //all


    /**
     * @ORM\Column(name="image", type="string", nullable=true)
     **/
    protected $image; //all
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductComment", mappedBy="product",cascade={"remove"}, orphanRemoval=true)
     */
    private $comments;

    /**
     * @var string $image
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     */
    private $image2;

    /**
     * @ORM\OneToMany(targetEntity=Cartline::class, mappedBy="produit",cascade={"persist"}, orphanRemoval=true)
     */
    private $cartlines;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Subcategory", mappedBy="products", cascade={"persist"})
     * @JoinTable(name="product_subcategory")
     */
    private $subcategories;

    /**
     * @ORM\OneToMany(targetEntity=ProductClick::class, mappedBy="product",cascade={"persist"}, orphanRemoval=true)
     */
    private $productclicks;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

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
            $productclick->setProduct($this);
        }

        return $this;
    }

    public function removeProductclick(ProductClick $productclick): self
    {
        if ($this->productclicks->removeElement($productclick)) {
            // set the owning side to null (unless already changed)
            if ($productclick->getProduct() === $this) {
                $productclick->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subcategory[]
     */
    
    public function getSubCategories(){
        return $this->subcategories;
    }

    public function addSubCategory(Subcategory $subcategory){
        if (!$this->subcategories->contains($subcategory)) {
            $this->subcategories[] = $subcategory;
            $subcategory->addProduct($this);
        }
        return $this;
    }

    public function removeSubCategory(Subcategory $subcategory){
        if ($this->subcategories->removeElement($subcategory)) {
          // set the owning side to null (unless already changed)
          $subcategory->removeProduct($this);
        }

        return $this;
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
     * @return string
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param string $certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }

    /**
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * @param \DateTime $creationdate
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $niveau
     */
    public function setName($name)
    {
        $this->name = $name;
    }

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
     * @return \DateTime
     */
    public function getUpdateddate()
    {
        return $this->updateddate;
    }

    /**
     * @param \DateTime $updateddate
     */
    public function setUpdateddate($updateddate)
    {
        $this->updateddate = $updateddate;
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
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param double $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return bool
     */
    public function isGaearecommanded()
    {
        return $this->gaearecommanded;
    }

    /**
     * @param bool $gaearecommanded
     */
    public function setGaearecommanded($gaearecommanded)
    {
        $this->gaearecommanded = $gaearecommanded;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return mixed
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function setImage2($image2)
    {
        $this->image2 = $image2;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection|ProductComment[]
     */
    
    public function getProductComments(){
        return $this->comments;
    }

    public function addProductComment(ProductComment $comment){
        $this->comments[] = $comment;
        return $this;
    }

    public function removeProductComment(ProductComment $comment){
        return $this->comments->removeElement($comment);
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return Collection|Cartline[]
     */
    public function getCartlines(): Collection
    {
        return $this->cartlines;
    }

    public function addCartline(Cartline $cartline): self
    {
        if (!$this->cartlines->contains($cartline)) {
            $this->cartlines[] = $cartline;
            $cartline->setProduit($this);
        }

        return $this;
    }

    public function removeCartline(Cartline $cartline): self
    {
        if ($this->cartlines->removeElement($cartline)) {
            // set the owning side to null (unless already changed)
            if ($cartline->getProduit() === $this) {
                $cartline->setProduit(null);
            }
        }

        return $this;
    }
// PRODUCT FAV

    /**
     * @return Collection|ProductFav[]
     */
    public function getProductFavProducts(): Collection
    {
        return $this->productFavProducts;
    }

    public function addProductFavProduct(ProductFav $productFavProduct): self
    {
        if (!$this->productFavProducts->contains($productFavProduct)) {
            $this->productFavProducts[] = $productFavProduct;
            $productFavProduct->setProduct($this);
        }

        return $this;
    }

    public function removeProductFavProduct(ProductFav $productFavProduct): self
    {
        if ($this->productFavProducts->removeElement($productFavProduct)) {
            // set the owning side to null (unless already changed)
            if ($productFavProduct->getProduct() === $this) {
                $productFavProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getCompany(): ?int
    {
        return $this->company->getId();
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}

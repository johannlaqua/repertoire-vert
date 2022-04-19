<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Subcategory
 *
 * @ORM\Table(name="subcategory")
 * @ORM\Entity(repositoryClass="App\Repository\SubcategoryRepository")
 * @UniqueEntity("name");
 */
class Subcategory
{

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->categories = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string",length=255)
     */
    protected $name;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string",length=255,nullable=true)
     */
    protected $slug;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",length=255)
     */
    protected $image;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Category",mappedBy="subcategories", cascade={"persist"}, fetch="EAGER")
     */
    protected $categories;

    public function getCategories()
    {
        return $this->categories;
    }
    public function addCategory(Category $Category){
        $this->categories->add($Category);
    }
    public function removeCategory(Category $Category){
        $this->categories->removeElement($Category);
    }
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="subcategories", cascade={"persist"})
     * @JoinTable(name="product_subcategory",
     *      joinColumns={@JoinColumn(name="subcategory_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="product_id", referencedColumnName="id",nullable=false,onDelete="CASCADE")}
     *      )
     */
    private $products;

     /**
     * @return Collection|Product[]
     */

    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }

    public function removeProduct(Product $product)
    {
        return $this->products->removeElement($product);
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

}

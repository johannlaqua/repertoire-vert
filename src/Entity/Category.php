<?php

namespace App\Entity;

use App\Entity\Subcategory;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{

    public function __construct()
    {
        $this->subcategories = new ArrayCollection();
        $this->companies = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string",length=255, unique=true)
     */
    protected $name;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(name="image", type="string")
     **/
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string",length=255,nullable=true)
     */
    protected $slug;




    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Company",mappedBy="categories", cascade={"persist"})
     */
    protected $companies;

    /**
     * @return mixed
     */
    public function getCompanies()
    {
        return $this->companies;
    }
    public function addCompany(Company $company){
        $this->companies->add($company);
    }
    public function removeCompany(Company $company){
        $this->companies->removeElement($company);
    }
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Subcategory",inversedBy="categories", cascade={"persist"}, fetch="EAGER")
     */
    protected $subcategories;

    /**
     * @return mixed
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
    public function addSubcategory(Subcategory $subcategory){
        $this->subcategories->add($subcategory);
    }
    public function removeSubcategory(Subcategory $subcategory){
        $this->subcategories->removeElement($subcategory);
    }

    /**
     * @param ArrayCollection $subcategories
     */
    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;
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

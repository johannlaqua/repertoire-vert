<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 * @ORM\Entity
 * @ORM\Table(name="Userorder")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\Column(name="products",type="text")
     */
    private $products; //all

    /**
     *
     * @ORM\Column(name="address",type="string" )
     */
    private $address; //all
    /**
     * @var string
     *
     * @ORM\Column(name="status",type="string")
     */
    private $status; //all

    /**
     * @var string
     *
     * @ORM\Column(name="shipping",type="string")
     */
    private $shipping; //all

    /**
     * @var string
     *
     * @ORM\Column(name="total",type="integer")
     */
    private $total; //all


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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param string $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
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
    public function setCreator($creator)
    {
        $this->creator = $creator;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getShipping(): string
    {
        return $this->shipping;
    }

    /**
     * @param string $shipping
     */
    public function setShipping(string $shipping): void
    {
        $this->shipping = $shipping;
    }

    /**
     * @return string
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @param string $total
     */
    public function setTotal(string $total): void
    {
        $this->total = $total;
    }

}
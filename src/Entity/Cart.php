<?php
namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\CartRepository;

/**
 * Cart
 * @ORM\Entity(repositoryClass=CartRepository::class)
 * @ORM\Table(name="cart")
 */
class Cart
{
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
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Cartline::class, mappedBy="panier", orphanRemoval=true)
     */
    private $cartlines;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->cartlines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator->getId();
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
            $cartline->setPanier($this);
        }

        return $this;
    }

    public function removeCartline(Cartline $cartline): self
    {
        if ($this->cartlines->removeElement($cartline)) {
            // set the owning side to null (unless already changed)
            if ($cartline->getPanier() === $this) {
                $cartline->setPanier(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

   

}
<?php

namespace App\Entity;

use App\Repository\ProductFavRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductFavRepository::class)
 */
class ProductFav
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="productFavUsers")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productFavProducts")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $product;


    public function getUser()
    {
        return $this->user->getId();
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function getProduct()
    {
        return $this->product->getId();
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}

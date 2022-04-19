<?php

namespace App\Entity;

use App\Repository\CartlineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartlineRepository::class)
 */
class Cartline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartlines")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $panier;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="cartlines")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPanier(): ?int
    {
        return $this->panier->getId();
    }

    public function setPanier(?Cart $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function getProduit(): ?int
    {
        return $this->produit->getId();
    }

    public function setProduit(?Product $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}

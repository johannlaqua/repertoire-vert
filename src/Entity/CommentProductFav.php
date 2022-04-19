<?php

namespace App\Entity;

use App\Repository\CommentProductFavRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentProductFavRepository::class)
 */
class CommentProductFav
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productSlug;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $companySlug;

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

    public function getProductSlug(): ?string
    {
        return $this->productSlug;
    }

    public function setproductSlug(string $productSlug): self
    {
        $this->productSlug = $productSlug;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCompanySlug(): ?string
    {
        return $this->companySlug;
    }

    public function setCompanySlug(string $companySlug): self
    {
        $this->companySlug = $companySlug;

        return $this;
    }
}

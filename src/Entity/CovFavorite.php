<?php

namespace App\Entity;

use App\Repository\CovFavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CovFavoriteRepository::class)
 */
class CovFavorite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="covFavorites")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $favorite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?int
    {
        return $this->user->getId();
    }

    public function setUser(?Person $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFavorite(): ?int
    {
        return $this->favorite->getId();
    }

    public function setFavorite(?Person $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }
}

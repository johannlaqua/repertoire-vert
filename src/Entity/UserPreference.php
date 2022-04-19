<?php

namespace App\Entity;

use App\Repository\UserPreferenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserPreferenceRepository::class)
 */
class UserPreference
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userPreferences")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Preference::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $preference;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?int
    {
        return $this->user->getId();
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPreference(): ?int
    {
        return $this->preference->getId();
    }

    public function setPreference(?Preference $preference): self
    {
        $this->preference = $preference;

        return $this;
    }
}

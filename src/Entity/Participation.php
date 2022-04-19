<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Communauty::class, inversedBy="participations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $covoiturage;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="participations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $participant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCovoiturage()
    {
        return $this->covoiturage->getId();
    }

    public function setCovoiturage(?Communauty $covoiturage): self
    {
        $this->covoiturage = $covoiturage;

        return $this;
    }

    public function getParticipant()
    {
        return $this->participant->getId();
    }

    public function setParticipant(?Person $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

    public function isConfirmed()
    {
        return $this->confirmed;
    }

    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

}

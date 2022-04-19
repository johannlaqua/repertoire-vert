<?php

namespace App\Entity;

use App\Repository\ActivityTransportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityTransportRepository::class)
 */
class ActivityTransport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $c02Emissions;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="activityTransports")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity=Transport::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $transport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getC02Emissions(): ?float
    {
        return $this->c02Emissions;
    }

    public function setC02Emissions(?float $c02Emissions): self
    {
        $this->c02Emissions = $c02Emissions;

        return $this;
    }

    public function getActivity(): ?int
    {
        return $this->activity->getId();
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getTransport(): ?int
    {
        return $this->transport->getId();
    }

    public function setTransport(?Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }
}

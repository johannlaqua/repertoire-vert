<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="activities")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateTimeStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateTimeEnd;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latStart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lonStart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latEnd;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lonEnd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $steps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $calories;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=ActivityType::class)
     */
    private $activityType;

    /**
     * @ORM\Column(type="float")
     */
    private $totalC02;

    /**
     * @ORM\OneToMany(targetEntity=ActivityTransport::class, mappedBy="activity")
     */
    private $activityTransports;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalDistance;

    /**
     * @ORM\OneToMany(targetEntity=ActivityPosition::class, mappedBy="activity", orphanRemoval=true)
     */
    private $activityPositions;

    public function __construct()
    {
        $this->activityTransports = new ArrayCollection();
        $this->activityPositions = new ArrayCollection();
    }

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

    public function getDateTimeStart(): ?\DateTimeInterface
    {
        return $this->dateTimeStart;
    }

    public function setDateTimeStart(?\DateTimeInterface $dateTimeStart): self
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    public function getDateTimeEnd(): ?\DateTimeInterface
    {
        return $this->dateTimeEnd;
    }

    public function setDateTimeEnd(?\DateTimeInterface $dateTimeEnd): self
    {
        $this->dateTimeEnd = $dateTimeEnd;

        return $this;
    }

    public function getLatStart(): ?float
    {
        return $this->latStart;
    }

    public function setLatStart(?float $latStart): self
    {
        $this->latStart = $latStart;

        return $this;
    }

    public function getLonStart(): ?float
    {
        return $this->lonStart;
    }

    public function setLonStart(?float $lonStart): self
    {
        $this->lonStart = $lonStart;

        return $this;
    }

    public function getLatEnd(): ?float
    {
        return $this->latEnd;
    }

    public function setLatEnd(?float $latEnd): self
    {
        $this->latEnd = $latEnd;

        return $this;
    }

    public function getLonEnd(): ?float
    {
        return $this->lonEnd;
    }

    public function setLonEnd(?float $lonEnd): self
    {
        $this->lonEnd = $lonEnd;

        return $this;
    }

    public function getSteps(): ?int
    {
        return $this->steps;
    }

    public function setSteps(int $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getActivityType(): ?int
    {
        return $this->activityType->getId();
    }

    public function setActivityType(?ActivityType $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    public function getTotalC02(): ?float
    {
        return $this->totalC02;
    }

    public function setTotalC02(float $totalC02): self
    {
        $this->totalC02 = $totalC02;

        return $this;
    }

    /**
     * @return Collection|ActivityTransport[]
     */
    public function getActivityTransports(): Collection
    {
        return $this->activityTransports;
    }

    public function addActivityTransport(ActivityTransport $activityTransport): self
    {
        if (!$this->activityTransports->contains($activityTransport)) {
            $this->activityTransports[] = $activityTransport;
            $activityTransport->setActivity($this);
        }

        return $this;
    }

    public function removeActivityTransport(ActivityTransport $activityTransport): self
    {
        if ($this->activityTransports->removeElement($activityTransport)) {
            // set the owning side to null (unless already changed)
            if ($activityTransport->getActivity() === $this) {
                $activityTransport->setActivity(null);
            }
        }

        return $this;
    }

    public function getTotalDistance(): ?float
    {
        return $this->totalDistance;
    }

    public function setTotalDistance(?float $totalDistance): self
    {
        $this->totalDistance = $totalDistance;

        return $this;
    }

    /**
     * @return Collection|ActivityPosition[]
     */
    public function getActivityPositions(): Collection
    {
        return $this->activityPositions;
    }

    public function addActivityPosition(ActivityPosition $activityPosition): self
    {
        if (!$this->activityPositions->contains($activityPosition)) {
            $this->activityPositions[] = $activityPosition;
            $activityPosition->setActivity($this);
        }

        return $this;
    }

    public function removeActivityPosition(ActivityPosition $activityPosition): self
    {
        if ($this->activityPositions->removeElement($activityPosition)) {
            // set the owning side to null (unless already changed)
            if ($activityPosition->getActivity() === $this) {
                $activityPosition->setActivity(null);
            }
        }

        return $this;
    }
}

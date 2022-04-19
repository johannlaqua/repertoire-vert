<?php

namespace App\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Communauty
 * @ORM\Entity
 * @ORM\Table(name="communauty")
 */
class Communauty
{

    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->invitations = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="departure", type="string" ,length=255)
     */
    protected $departure;
    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string",length=255)
     */
    protected $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="groupmaxsize", type="integer")
     */
    protected $groupmaxsize;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="App\Entity\Person")
     *@ORM\JoinColumn(name="createur", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $createur;


    /**
     * @return mixed
     */
    public function getCreateur()
    {
        return $this->createur->getId();
    }

    /**
     * @param mixed $createur
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;
    }

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.uT'>")
     * @ORM\Column(name="departuredate", type="datetime")
     */
    private $departuredate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $departureLatitude;

    /**
     * @ORM\Column(type="float")
     */
    private $departureLongitude;

    /**
     * @ORM\Column(type="float")
     */
    private $destinationLatitude;

    /**
     * @ORM\Column(type="float")
     */
    private $destinationLongitude;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="covoiturage")
     */
    private $participations;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $arrivalDate;

    /**
     * @ORM\OneToMany(targetEntity=CovInvitation::class, mappedBy="covoiturage")
     */
    private $invitations;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $trunk;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $roof;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $trailer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $roundTrip;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnDate;

    /**
     * @return string
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param string $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getGroupmaxsize()
    {
        return $this->groupmaxsize;
    }

    /**
     * @param string $groupmaxsize
     */
    public function setGroupmaxsize($groupmaxsize)
    {
        $this->groupmaxsize = $groupmaxsize;
    }

    /**
     * @return \DateTime
     */
    public function getDeparturedate()
    {
        return $this->departuredate;
    }

    /**
     * @param \DateTime $departuredate
     */
    public function setDeparturedate($departuredate)
    {
        $this->departuredate = $departuredate;
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

    public function getDepartureLatitude(): ?float
    {
        return $this->departureLatitude;
    }

    public function setDepartureLatitude(float $departureLatitude): self
    {
        $this->departureLatitude = $departureLatitude;

        return $this;
    }

    public function getDepartureLongitude(): ?float
    {
        return $this->departureLongitude;
    }

    public function setDepartureLongitude(float $departureLongitude): self
    {
        $this->departureLongitude = $departureLongitude;

        return $this;
    }

    public function getDestinationLatitude(): ?float
    {
        return $this->destinationLatitude;
    }

    public function setDestinationLatitude(float $destinationLatitude): self
    {
        $this->destinationLatitude = $destinationLatitude;

        return $this;
    }

    public function getDestinationLongitude(): ?float
    {
        return $this->destinationLongitude;
    }

    public function setDestinationLongitude(float $destinationLongitude): self
    {
        $this->destinationLongitude = $destinationLongitude;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setCovoiturage($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getCovoiturage() === $this) {
                $participation->setCovoiturage(null);
            }
        }

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    /**
     * @return Collection|CovInvitation[]
     */
    public function getInvitations(): Collection
    {
        return $this->invitations;
    }

    public function addInvitation(CovInvitation $invitation): self
    {
        if (!$this->invitations->contains($invitation)) {
            $this->invitations[] = $invitation;
            $invitation->setCovoiturage($this);
        }

        return $this;
    }

    public function removeInvitation(CovInvitation $invitation): self
    {
        if ($this->invitations->removeElement($invitation)) {
            // set the owning side to null (unless already changed)
            if ($invitation->getCovoiturage() === $this) {
                $invitation->setCovoiturage(null);
            }
        }

        return $this;
    }

    public function getTrunk(): ?string
    {
        return $this->trunk;
    }

    public function setTrunk(?string $trunk): self
    {
        $this->trunk = $trunk;

        return $this;
    }

    public function getRoof(): ?bool
    {
        return $this->roof;
    }

    public function setRoof(?bool $roof): self
    {
        $this->roof = $roof;

        return $this;
    }

    public function getTrailer(): ?bool
    {
        return $this->trailer;
    }

    public function setTrailer(?bool $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getRoundTrip(): ?bool
    {
        return $this->roundTrip;
    }

    public function setRoundTrip(?bool $roundTrip): self
    {
        $this->roundTrip = $roundTrip;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

}
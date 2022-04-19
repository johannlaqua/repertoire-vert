<?php

namespace App\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Serializable;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person extends User implements Serializable
{

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string",length=255,nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string",length=255,nullable=true)
     */
    protected $street;

    /**
     * @var
     *
     * @ORM\Column(name="streetnumber", type="smallint",nullable=true)
     */
    protected $streetnumber;

    /**
     *
     * @ORM\Column(name="postcode", type="smallint",nullable=true)
     */
    protected $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string",length=255,nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string",length=255,nullable=true)
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string",length=255,nullable=true)
     */
    protected $country;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string",length=255,nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateBirth;

    /**
     * @ORM\OneToMany(targetEntity=Communauty::class, mappedBy="createur", orphanRemoval=true)
     */
    private $covoiturages;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="participant")
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity=CovInvitation::class, mappedBy="user")
     */
    private $covInvitations;

    /**
     * @ORM\OneToMany(targetEntity=CovInvitation::class, mappedBy="friend")
     */
    private $covOthersInvitations;

    /**
     * @ORM\OneToMany(targetEntity=CovFavorite::class, mappedBy="user")
     */
    private $covFavorites;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="user")
     */
    private $activities;

     /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="creator")
     */
    private $carts;


    public function __construct()
    {
      $this->covoiturages = new ArrayCollection();
      $this->participations = new ArrayCollection();
      $this->covInvitations = new ArrayCollection();
      $this->covOthersInvitations = new ArrayCollection();
      $this->covFavorites = new ArrayCollection();
      $this->activities = new ArrayCollection();
      $this->carts = new ArrayCollection();
    }


    /***********Getters&Setters***********/

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return smallint
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param int $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return smallint
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * @param int $streetnumber
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }



    /**
     * @return bool
     */
    public function isEmailValidated(): ?bool
    {
        return $this->emailValidated;
    }



    /**
     * @return bool
     */
    public function isActived(): ?bool
    {
        return $this->actived;
    }



    /**
     * @return \DateTime
     */
    public function getInscriptiondate(): ?\DateTime
    {
        return $this->inscriptiondate;
    }


    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($data)
    {
        // TODO: Implement unserialize() method.
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(?\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * @return Collection|Communauty[]
     */
    public function getCovoiturages(): Collection
    {
        return $this->covoiturages;
    }

    public function addCovoiturages(Communauty $covoiturage): self
    {
        if (!$this->covoiturages->contains($covoiturage)) {
            $this->covoiturages[] = $covoiturage;
            $covoiturage->setCreateur($this);
        }

        return $this;
    }

    public function removeCovoiturages(Communauty $covoiturage): self
    {
        if ($this->covoiturages->removeElement($covoiturage)) {
            // set the owning side to null (unless already changed)
            if ($covoiturage->getCreateur() === $this) {
                $covoiturage->setCreateur(null);
            }
        }

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
            $participation->setParticipant($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getParticipant() === $this) {
                $participation->setParticipant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CovInvitation[]
     */
    public function getCovInvitations(): Collection
    {
        return $this->covInvitations;
    }

    public function addCovInvitation(CovInvitation $covInvitation): self
    {
        if (!$this->covInvitations->contains($covInvitation)) {
            $this->covInvitations[] = $covInvitation;
            $covInvitation->setUser($this);
        }

        return $this;
    }

    public function removeCovInvitation(CovInvitation $covInvitation): self
    {
        if ($this->covInvitations->removeElement($covInvitation)) {
            // set the owning side to null (unless already changed)
            if ($covInvitation->getUser() === $this) {
                $covInvitation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CovInvitation[]
     */
    public function getCovOthersInvitations(): Collection
    {
        return $this->covOthersInvitations;
    }

    public function addCovOthersInvitation(CovInvitation $covOthersInvitation): self
    {
        if (!$this->covOthersInvitations->contains($covOthersInvitation)) {
            $this->covOthersInvitations[] = $covOthersInvitation;
            $covOthersInvitation->setFriend($this);
        }

        return $this;
    }

    public function removeCovOthersInvitation(CovInvitation $covOthersInvitation): self
    {
        if ($this->covOthersInvitations->removeElement($covOthersInvitation)) {
            // set the owning side to null (unless already changed)
            if ($covOthersInvitation->getFriend() === $this) {
                $covOthersInvitation->setFriend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CovFavorite[]
     */
    public function getCovFavorites(): Collection
    {
        return $this->covFavorites;
    }

    public function addCovFavorite(CovFavorite $covFavorite): self
    {
        if (!$this->covFavorites->contains($covFavorite)) {
            $this->covFavorites[] = $covFavorite;
            $covFavorite->setUser($this);
        }

        return $this;
    }

    public function removeCovFavorite(CovFavorite $covFavorite): self
    {
        if ($this->covFavorites->removeElement($covFavorite)) {
            // set the owning side to null (unless already changed)
            if ($covFavorite->getUser() === $this) {
                $covFavorite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setUser($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getUser() === $this) {
                $activity->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): ?Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setCreator($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getCreator() === $this) {
                $cart->setCreator(null);
            }
        }

        return $this;
    }
}


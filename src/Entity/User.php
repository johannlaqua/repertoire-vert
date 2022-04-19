<?php

namespace App\Entity;

use App\Entity\Company;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="userrv")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "person" = "Person","company" = "Company" })
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     *
     * @ORM\Column(name="gaeaUserId", type="integer", unique=true, nullable=true)
     */
    private $gaeaUserId;

    /**
     * @var string
     * NE PAS LE SUPPRIMER DE LA TABLE DANS LA BDD, sinon aura l'exception getUserIdentifier : expected string, null returned quand on se login
     * @ORM\Column(name="username", type="string",length=255,nullable=true)
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string",length=255,nullable=false)
     */
    protected $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="emailValidated", type="boolean")
     */
    protected $emailValidated;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $actived;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inscription_date", type="date", nullable=true)
     */
    protected $inscriptiondate;

    /**
     * @var string
     */
    private $discr;


    /**
     * @return string
     */
    public function getgaeaUserId()
    {
        return $this->gaeaUserId;
    }

    /**
     * @param string $username
     */
    public function setgaeaUserId($gaeaUserId)
    {
        $this->gaeaUserId = $gaeaUserId;
    }
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

     /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function isEmailValidated()
    {
        return $this->emailValidated;
    }

    /**
     * @param bool $emailValidated
     */
    public function setEmailValidated($emailValidated)
    {
        $this->emailValidated = $emailValidated;
    }

    /**
     * @return bool
     */
    public function isActived()
    {
        return $this->actived;
    }

    /**
     * @return bool
     */
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * @param bool $actived
     */
    public function setActived($actived)
    {
        $this->actived = $actived;
    }
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getRoles()
    {
        return [$this->getRole()];
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
     * @return \DateTime
     */
    public function getInscriptiondate()
    {
        return $this->inscriptiondate;
    }

    /**
     * @param \DateTime $inscriptiondate
     */
    public function setInscriptiondate($inscriptiondate)
    {
        $this->inscriptiondate = $inscriptiondate;
    }

////////////////////////////////////////


    /**
     * @ORM\ManyToMany(targetEntity="Company")
     * @ORM\JoinTable (name="fav_company")
     */
    private $companyfavs;

    /**
     * @ORM\OneToMany(targetEntity="ProductFav", mappedBy="user", orphanRemoval=true, cascade={"persist", "remove", "merge"})
     */
    private $productFavUsers;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Friendship", mappedBy="friend", fetch="EAGER")
     */
    private $friendsWithMe;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Friendship", mappedBy="user", fetch="EAGER")
     */
    private $myFriends;

    /**
     * @ORM\OneToMany(targetEntity="CompanyFav", mappedBy="user")
     */
    private $companyFavUsers;

    /**
     * @ORM\OneToMany(targetEntity="Notification", mappedBy="owner")
     */
    private $notifications;

    public function _construct()
    {
        $this->companyfavs = new ArrayCollection();
        $this->companyFavUsers = new ArrayCollection();
        $this->productFavUsers = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    public function addCompanyFavs(Company $company)
    {
        if ($this->companyfavs->contains($company))
        {
            return;
        }
         $this->companyfavs[]=$company;
    }


    public function getCompanyFavs()
    {
        return $this->companyfavs;
    }



    public function deleteCompanyFavs($company)
    {
        return $this->companyfavs->removeElement($company);
    }

    public function getDiscr(): ?string
    {
        return $this->discr;
    }

    public function setDiscr(string $discr)
    {
        $this->discr = $discr;

        return $this;
    }
    

    /**
     * @return Collection|ProductFav[]
     */
    public function getProductFavUsers(): Collection
    {
        return $this->productFavUsers;
    }

    public function addProductFav(ProductFav $productFav): self
    {
        if (!$this->productFavUsers->contains($productFav)) {
            $this->productFavUsers[] = $productFav;
            $productFav->setUser($this);
        }
        return $this;
    }
    public function removeProductFav(ProductFav $possession): self
    {
        if ($this->possession->removeElement($possession)) {
            // set the owning side to null (unless already changed)
            if ($possession->getUser() === $this) {
                $possession->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setOwner($this);
        }
        return $this;
    }
    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getOwner() === $this) {
                $notification->setOwner(null);
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * @param array $friendsWithMe
     */
    public function setFriendsWithMe(array $friendsWithMe): void
    {
        $this->friendsWithMe = $friendsWithMe;
    }

    /**
     * @return array
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }

    /**
     * @param array $myFriends
     */
    public function setMyFriends(array $myFriends): void
    {
        $this->myFriends = $myFriends;
    }

    /**
     * @return mixed
     */
    public function getCompanyFavUsers()
    {
        return $this->companyFavUsers;
    }

    /**
     * @param mixed $companyFavUsers
     */
    public function setCompanyFavUsers($companyFavUsers): void
    {
        $this->companyFavUsers = $companyFavUsers;
    }
    /**
     * @var boolean
     *
     * @ORM\Column(name="connected", type="boolean", nullable=true)
     */
    private $connected;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity=UserPreference::class, mappedBy="user")
     */
    private $userPreferences;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteCategory::class, mappedBy="user", orphanRemoval=true)
     */
    private $favoriteCategories;

    /**
     * @ORM\OneToMany(targetEntity=FavoriteCompany::class, mappedBy="user", orphanRemoval=true)
     */
    private $favoriteCompanies;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $x;

    public function __construct()
    {
        $this->userPreferences = new ArrayCollection();
        $this->favoriteCategories = new ArrayCollection();
        $this->favoriteCompanies = new ArrayCollection();
    }

    

    // /**
    //  * @ORM\OneToMany(targetEntity=Newsletter::class, mappedBy="gaeaUserNewsletter", orphanRemoval=true)
    //  */
    // private $gaeaUserNewsletter;

    // public function __construct()
    // {
    //     $this->gaeaUserNewsletter = new ArrayCollection();
    // }

    /**
     * @return bool
     */
    public function isConnected(): ?bool
    {
        return $this->connected;
    }

    // /**
    //  * @param bool $connected
    //  */
    public function setConnected(bool $connected): void
    {
        $this->connected = $connected;
    }

    // /**
    //  * @return Collection|newsletter[]
    //  */
    // public function getGaeaUserNewsletter(): Collection
    // {
    //     return $this->gaeaUserNewsletter;
    // }

    // public function addGaeaUserNewsletter(newsletter $gaeaUserNewsletter): self
    // {
    //     if (!$this->gaeaUserNewsletter->contains($gaeaUserNewsletter)) {
    //         $this->gaeaUserNewsletter[] = $gaeaUserNewsletter;
    //         $gaeaUserNewsletter->setGaeaUserNewsletter($this);
    //     }

    //     return $this;
    // }

    // public function removeGaeaUserNewsletter(newsletter $gaeaUserNewsletter): self
    // {
    //     if ($this->gaeaUserNewsletter->removeElement($gaeaUserNewsletter)) {
    //         // set the owning side to null (unless already changed)
    //         if ($gaeaUserNewsletter->getGaeaUserNewsletter() === $this) {
    //             $gaeaUserNewsletter->setGaeaUserNewsletter(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection|UserPreference[]
     */
    public function getUserPreferences(): Collection
    {
        return $this->userPreferences;
    }

    public function addUserPreference(UserPreference $userPreference): self
    {
        if (!$this->userPreferences->contains($userPreference)) {
            $this->userPreferences[] = $userPreference;
            $userPreference->setUser($this);
        }

        return $this;
    }

    public function removeUserPreference(UserPreference $userPreference): self
    {
        if ($this->userPreferences->removeElement($userPreference)) {
            // set the owning side to null (unless already changed)
            if ($userPreference->getUser() === $this) {
                $userPreference->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FavoriteCategory[]
     */
    public function getFavoriteCategories(): Collection
    {
        return $this->favoriteCategories;
    }

    public function addFavoriteCategory(FavoriteCategory $favoriteCategory): self
    {
        if (!$this->favoriteCategories->contains($favoriteCategory)) {
            $this->favoriteCategories[] = $favoriteCategory;
            $favoriteCategory->setUser($this);
        }

        return $this;
    }

    public function removeFavoriteCategory(FavoriteCategory $favoriteCategory): self
    {
        if ($this->favoriteCategories->removeElement($favoriteCategory)) {
            // set the owning side to null (unless already changed)
            if ($favoriteCategory->getUser() === $this) {
                $favoriteCategory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FavoriteCompany[]
     */
    public function getFavoriteCompanies(): Collection
    {
        return $this->favoriteCompanies;
    }

    public function addFavoriteCompanies(FavoriteCompany $favoriteCompany): self
    {
        if (!$this->favoriteCompanies->contains($favoriteCompany)) {
            $this->favoriteCompanies[] = $favoriteCompany;
            $favoriteCompany->setUser($this);
        }

        return $this;
    }

    public function removeFavoriteCompanies(FavoriteCompany $favoriteCompany): self
    {
        if ($this->favoriteCompanies->removeElement($favoriteCompany)) {
            // set the owning side to null (unless already changed)
            if ($favoriteCompany->getUser() === $this) {
                $favoriteCompany->setUser(null);
            }
        }

        return $this;
    }

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(string $x): self
    {
        $this->x = $x;

        return $this;
    }

}

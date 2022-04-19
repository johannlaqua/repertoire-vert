<?php

namespace App\Entity;

use App\Repository\CovInvitationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CovInvitationRepository::class)
 */
class CovInvitation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Communauty::class, inversedBy="invitations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $covoiturage;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="covInvitations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="covOthersInvitations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $friend;

    /**
     * @ORM\OneToOne(targetEntity=Notification::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $notification;

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

    public function getUser()
    {
        return $this->user->getId();
    }

    public function setUser(?Person $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFriend()
    {
        return $this->friend->getId();
    }

    public function setFriend(?Person $friend): self
    {
        $this->friend = $friend;

        return $this;
    }

    public function getNotification(): ?int
    {
        return $this->notification->getId();
    }

    public function setNotification(?Notification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }
}

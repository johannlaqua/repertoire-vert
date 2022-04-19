<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendship
 * @ORM\Entity
 * @ORM\Table(name="friendship")
 */
class Friendship
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="App\Entity\Person",inversedBy="myFriends", fetch="EXTRA_LAZY")
     *@ORM\JoinColumn(name="user", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $user;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="App\Entity\Person",inversedBy="friendsWithMe",fetch="EXTRA_LAZY")
     *@ORM\JoinColumn(name="friend", referencedColumnName="id")
     */
    private $friend;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_accepted", type="boolean")
     */
    private $isAccepted;

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
     * @return number
     */
    public function getUser()
    {
        return $this->user->getId();
    }

    /**
     * @param Person $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return number
     */
    public function getFriend()
    {
        return $this->friend->getId();
    }

    /**
     * @param Person $friend
     */
    public function setFriend($friend)
    {
        $this->friend = $friend;
    }

    /**
     * @return bool
     */
    public function isAccepted()
    {
        return $this->isAccepted;
    }

    /**
     * @param bool $isAccepted
     */
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;
    }


}
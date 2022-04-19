<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivitiesDisplay
 * @ORM\Entity
 * @ORM\Table(name="activitiesdisplay")
 */
class ActivitiesDisplay
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
     * @var boolean
     *
     * @ORM\Column(name="display", type="boolean")
     */
    protected $display;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *@ORM\JoinColumn(name="owner", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $owner;

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
     * @return bool
     */
    public function isDisplay()
    {
        return $this->display;
    }

    /**
     * @param bool $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }


    }
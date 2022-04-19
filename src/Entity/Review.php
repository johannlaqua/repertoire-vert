<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ORM\Table(name="review")
 */
class Review
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="value",type="integer")
   */
  private $value;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\User")
   * @ORM\JoinColumn(name="owner", referencedColumnName="id",nullable=false,onDelete="CASCADE")
   */

  private $owner;

  /**
   * @ORM\Column(type="integer")
   */
  private $entityId;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $entityType;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $comment;

  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;
  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getValue()
  {
    return $this->value;
  }

  /**
   * @param mixed $value
   */
  public function setValue($value)
  {
    $this->value = $value;
  }

  /**
   * @return mixed
   */
  public function getOwner()
  {
    return $this->owner;
  }

  /**
   * @param mixed $owner
   */
  public function setOwner($owner)
  {
    $this->owner = $owner;
  }

  public function getEntityId(): ?int
  {
    return $this->entityId;
  }

  public function setEntityId(int $entityId): self
  {
    $this->entityId = $entityId;

    return $this;
  }

  public function getEntityType(): ?string
  {
    return $this->entityType;
  }

  public function setEntityType(string $entityType): self
  {
    $this->entityType = $entityType;

    return $this;
  }

  public function getComment(): ?string
  {
    return $this->comment;
  }

  public function setComment(?string $comment): self
  {
    $this->comment = $comment;

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
}

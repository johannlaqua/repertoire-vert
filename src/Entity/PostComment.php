<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PostComment
 * @ORM\Entity
 * @ORM\Table(name="postcomment")

 */
class PostComment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="comment",type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */

    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $post;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=PostCommentLike::class, mappedBy="comment", orphanRemoval=true)
     */
    private $postCommentLikes;

    public function __construct()
    {
        $this->postCommentLikes = new ArrayCollection();
    }

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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost(?Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Collection|PostCommentLike[]
     */
    public function getPostCommentLikes(): Collection
    {
        return $this->postCommentLikes;
    }

    public function addPostCommentLike(PostCommentLike $postCommentLike): self
    {
        if (!$this->postCommentLikes->contains($postCommentLike)) {
            $this->postCommentLikes[] = $postCommentLike;
            $postCommentLike->setComment($this);
        }

        return $this;
    }

    public function removePostCommentLike(PostCommentLike $postCommentLike): self
    {
        if ($this->postCommentLikes->removeElement($postCommentLike)) {
            // set the owning side to null (unless already changed)
            if ($postCommentLike->getComment() === $this) {
                $postCommentLike->setComment(null);
            }
        }

        return $this;
    }
}
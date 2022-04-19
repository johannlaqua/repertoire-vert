<?php
namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 * @Gedmo\TranslationEntity(class="App\Entity\postTranslation")
 */
class Post
{
    function __construct() { 
      $this->createdAt = new Datetime(); 
      $this->comments = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title",type="string")
     * @Gedmo\Translatable
     * @Gedmo\Versioned
     */
    private $title;
    /**
     * @ORM\Column(name="subtitle",type="string")
     */
    private $subtitle;
    /**
     * @ORM\Column(name="body",type="text")
     */
    private $body;

    /**
     * @ORM\Column(name="views",type="integer")
     */
    private $views;
    /**
     * @ORM\Column(name="approved",type="boolean")
     */
    private $approved;

    /**
     * @ORM\Column(name="photo", type="string", length=500)
     * @Assert\File(maxSize="5000k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $creator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post",cascade={"remove"}, orphanRemoval=true)
     */
    private $likes;
 
    /**
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
 
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostComment", mappedBy="post",cascade={"remove"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     */
    private $comments;
 
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category->getId();
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator->getId();
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
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
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return Collection|PostComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(PostComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(PostComment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }
    /**
     * @param User $user
     * @return bool
     */
    public function isLikeByUser(User $user): bool
    {
        foreach ($this->likes as $like) {
            if ($like->getCreator() === $user) return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views): void
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved): void
    {
        $this->approved = $approved;
    }

}
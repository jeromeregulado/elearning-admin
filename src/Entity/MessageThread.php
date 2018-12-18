<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/17/18
 * Time: 10:41 AM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MessageThread
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\MessageThreadRepository")
 */
class MessageThread
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User as Teacher
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messageThread")
     */
    private $teacher;

    /**
     * @var Student as Parent
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="messageThread")
     */
    private $parent;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var Message
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="thread")
     */
    private $message;

    public function __construct()
    {
        $this->message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getParent(): ?Student
    {
        return $this->parent;
    }

    public function setParent(?Student $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setThread($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->contains($message)) {
            $this->message->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getThread() === $this) {
                $message->setThread(null);
            }
        }

        return $this;
    }
}
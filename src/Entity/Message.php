<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 4:39 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package App\Entity\Message
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var MessageThread
     * @ORM\ManyToOne(targetEntity="App\Entity\MessageThread", inversedBy="message")
     */
    private $thread;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="message")
     */
    private $senderTeacher;

    /**
     * @var \App\Entity\Student as Parent
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="message")
     */
    private $senderParent;

    /**
     * @var text
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=255, options={"default": "unread"})
     */
    private $status;

    /**
     * @var datetime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getThread(): ?MessageThread
    {
        return $this->thread;
    }

    public function setThread(?MessageThread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    public function getSenderTeacher(): ?User
    {
        return $this->senderTeacher;
    }

    public function setSenderTeacher(?User $senderTeacher): self
    {
        $this->senderTeacher = $senderTeacher;

        return $this;
    }

    public function getSenderParent(): ?Student
    {
        return $this->senderParent;
    }

    public function setSenderParent(?Student $senderParent): self
    {
        $this->senderParent = $senderParent;

        return $this;
    }
}

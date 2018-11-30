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
    protected $id;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="message")
     */
    protected $teacher;

    /**
     * @var \App\Entity\Student
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="message")
     */
    protected $student;

    /**
     * @var text
     * @ORM\Column(name="message", type="text")
     */
    protected $message;

    /**
     * @var datetime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

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
}

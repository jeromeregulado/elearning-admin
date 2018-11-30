<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 6:35 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Homework
 * @package App\Entity\Homework
 * @ORM\Entity(repositoryClass="App\Repository\HomeworkRepository")
 */
class Homework
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \App\Entity\Homework
     * @ORM\ManyToOne(targetEntity="App\Entity\Advisory", inversedBy="homework")
     */
    protected $advisory;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var date
     * @ORM\Column(name="submission_date", type="date")
     */
    protected $submissionDate;

    /**
     * @var datetime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTimeInterface $submissionDate): self
    {
        $this->submissionDate = $submissionDate;

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

    public function getAdvisory(): ?Advisory
    {
        return $this->advisory;
    }

    public function setAdvisory(?Advisory $advisory): self
    {
        $this->advisory = $advisory;

        return $this;
    }
}

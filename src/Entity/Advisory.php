<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/9/18
 * Time: 6:13 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Advisory
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AdvisoryRepository")
 */
class Advisory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \App\Entity\Section
     * @ORM\ManyToOne(targetEntity="App\Entity\Section", inversedBy="advisory")
     */
    protected $section;

    /**
     * @var \App\Entity\User as Teacher
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="advisory")
     */
    protected $teacher;

    /**
     * @var \App\Entity\Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="advisory")
     */
    protected $subject;

    /**
     * @var \App\Entity\Homework
     * @ORM\OneToMany(targetEntity="App\Entity\Homework", mappedBy="advisory")
     */
    protected $homework;

    public function __construct()
    {
        $this->homework = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Collection|Homework[]
     */
    public function getHomework(): Collection
    {
        return $this->homework;
    }

    public function addHomework(Homework $homework): self
    {
        if (!$this->homework->contains($homework)) {
            $this->homework[] = $homework;
            $homework->setAdvisory($this);
        }

        return $this;
    }

    public function removeHomework(Homework $homework): self
    {
        if ($this->homework->contains($homework)) {
            $this->homework->removeElement($homework);
            // set the owning side to null (unless already changed)
            if ($homework->getAdvisory() === $this) {
                $homework->setAdvisory(null);
            }
        }

        return $this;
    }
}
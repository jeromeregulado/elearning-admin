<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/9/18
 * Time: 5:47 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Section
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 */
class Section
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="level", type="string")
     */
    private $level;

    /**
     * @var \App\Entity\Student
     * @ORM\ManyToMany(targetEntity="App\Entity\Student", mappedBy="section")
     */
    private $student;

    /**
     * @var string
     * @ORM\Column(name="academic_year", type="string")
     */
    private $academicYear;

    /**
     * @var \App\Entity\Advisory
     * @ORM\OneToMany(targetEntity="App\Entity\Advisory", mappedBy="section")
     */
    private $advisory;

    public function __construct()
    {
        $this->student = new ArrayCollection();
        $this->advisory = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->name . " - " . $this->level;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getAcademicYear(): ?string
    {
        return $this->academicYear;
    }

    public function setAcademicYear(string $academicYear): self
    {
        $this->academicYear = $academicYear;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student[] = $student;
            $student->addSection($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->student->contains($student)) {
            $this->student->removeElement($student);
            $student->removeSection($this);
        }

        return $this;
    }

    /**
     * @return Collection|Advisory[]
     */
    public function getAdvisory(): Collection
    {
        return $this->advisory;
    }

    public function addAdvisory(Advisory $advisory): self
    {
        if (!$this->advisory->contains($advisory)) {
            $this->advisory[] = $advisory;
            $advisory->setSection($this);
        }

        return $this;
    }

    public function removeAdvisory(Advisory $advisory): self
    {
        if ($this->advisory->contains($advisory)) {
            $this->advisory->removeElement($advisory);
            // set the owning side to null (unless already changed)
            if ($advisory->getSection() === $this) {
                $advisory->setSection(null);
            }
        }

        return $this;
    }
}

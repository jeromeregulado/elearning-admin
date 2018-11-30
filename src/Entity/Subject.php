<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/4/18
 * Time: 6:47 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Subject
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var boolean
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @var \App\Entity\Advisory
     * @ORM\OneToMany(targetEntity="App\Entity\Advisory", mappedBy="subject")
     */
    protected $advisory;

    /**
     * @var \App\Entity\Lesson
     * @ORM\OneToMany(targetEntity="App\Entity\Lesson", mappedBy="subject")
     */
    protected $lesson;

    /**
     * @var \App\Entity\Grades
     * @ORM\OneToMany(targetEntity="App\Entity\Grades", mappedBy="subject")
     */
    protected $grades;

    public function __construct()
    {
        $this->advisory = new ArrayCollection();
        $this->lesson = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->name;
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $advisory->setSubject($this);
        }

        return $this;
    }

    public function removeAdvisory(Advisory $advisory): self
    {
        if ($this->advisory->contains($advisory)) {
            $this->advisory->removeElement($advisory);
            // set the owning side to null (unless already changed)
            if ($advisory->getSubject() === $this) {
                $advisory->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lesson[]
     */
    public function getLesson(): Collection
    {
        return $this->lesson;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lesson->contains($lesson)) {
            $this->lesson[] = $lesson;
            $lesson->setSubject($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lesson->contains($lesson)) {
            $this->lesson->removeElement($lesson);
            // set the owning side to null (unless already changed)
            if ($lesson->getSubject() === $this) {
                $lesson->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grades[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grades $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setSubject($this);
        }

        return $this;
    }

    public function removeGrade(Grades $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getSubject() === $this) {
                $grade->setSubject(null);
            }
        }

        return $this;
    }
}

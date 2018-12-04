<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/4/18
 * Time: 6:47 PM
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Subject
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Subject
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
     * @var boolean
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var \App\Entity\Lesson
     * @ORM\OneToMany(targetEntity="App\Entity\Lesson", mappedBy="subject")
     * @ApiSubresource()
     */
    private $lesson;

    /**
     * @var \App\Entity\Grades
     * @ORM\OneToMany(targetEntity="App\Entity\Grades", mappedBy="subject")
     */
    private $grades;

    /**
     * @var \App\Entity\Event
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="subject")
     */
    private $event;

    public function __construct()
    {
        $this->advisory = new ArrayCollection();
        $this->lesson = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->event = new ArrayCollection();
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

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->setSubject($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->contains($event)) {
            $this->event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getSubject() === $this) {
                $event->setSubject(null);
            }
        }

        return $this;
    }
}

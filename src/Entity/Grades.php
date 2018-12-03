<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 7:01 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Grades
 * @package App\Entity\Grades
 * @ORM\Entity(repositoryClass="App\Repository\GradesRepository")
 */
class Grades
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \App\Entity\Student
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="grades")
     */
    protected $student;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="grades")
     */
    protected $teacher;

    /**
     * @var \App\Entity\TaskType
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskType", inversedBy="grades")
     */
    protected $task;

    /**
     * @var \App\Entity\Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="grades")
     */
    protected $subject;

    /**
     * @var integer
     * @ORM\Column(name="grade", type="integer")
     */
    protected $grade;

    /**
     * @var date
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function __toString()
    {
        return (string) $this->grade;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getTask(): ?TaskType
    {
        return $this->task;
    }

    public function setTask(?TaskType $task): self
    {
        $this->task = $task;

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

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }
}

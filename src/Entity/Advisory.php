<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/9/18
 * Time: 6:13 PM
 */

namespace App\Entity;

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
    private $id;

    /**
     * @var \App\Entity\Section
     * @ORM\ManyToOne(targetEntity="App\Entity\Section", inversedBy="advisory")
     */
    private $section;

    /**
     * @var \App\Entity\User as Teacher
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="advisory")
     */
    private $teacher;

    /**
     * @var \App\Entity\Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="advisory")
     */
    private $subject;

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
}
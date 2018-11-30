<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 5:01 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Activity
 * @package App\Entity\Activity
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 * @Vich\Uploadable()
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \App\Entity\Student
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="activity")
     */
    protected $student;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="activity")
     */
    protected $teacher;

    /**
     * @var date
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * @var string
     * @ORM\Column(name="file_name", type="string")
     */
    protected $fileName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="lessons", fileNameProperty="fileName")
     */
    protected $file;

    /**
     * @var datetime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
}

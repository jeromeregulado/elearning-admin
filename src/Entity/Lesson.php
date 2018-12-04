<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 3:49 PM
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Lesson
 * @package App\Entity\Lesson
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 * @Vich\Uploadable()
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \App\Entity\Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="lesson")
     */
    private $subject;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="lesson")
     */
    private $teacher;

    /**
     * @var date
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="file_name", type="string")
     * @ApiProperty(iri="http://schema.org/fileName")
     */
    private $fileName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="lessons", fileNameProperty="fileName")
     */
    private $file;

    /**
     * @var datetime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function __toString()
    {
        return (string) $this->fileName;
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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

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

    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if (null !== $file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }
}

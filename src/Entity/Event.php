<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/25/18
 * Time: 3:15 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var date
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var date
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var text
     * @ORM\Column(name="remarks", type="text", nullable=true)
     */
    private $remarks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
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

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}

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
     * @var \App\Entity\Advisory
     * @ORM\OneToMany(targetEntity="App\Entity\Advisory", mappedBy="subject")
     */
    private $advisory;

    public function __construct()
    {
        $this->advisory = new ArrayCollection();
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
}

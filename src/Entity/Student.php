<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Context;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ORM\Table(name="user_student")
 */
class Student implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $uuid;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string Plain password
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string")
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="middle_name", type="string", nullable=true)
     */
    private $middleName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string")
     */
    private $lastName;

    /**
     * @var bool
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var datetime
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var longtext
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="guardian", type="string", nullable=true)
     */
    private $guardian;

    /**
     * @var string
     * @ORM\Column(name="guardian_contact", type="string", nullable=true)
     */
    private $guardianContact;

    /**
     * @var \App\Entity\Attendance
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="student")
     */
    private $attendance;

    /**
     * @var \App\Entity\Section
     * @ORM\ManyToMany(targetEntity="App\Entity\Section", inversedBy="student")
     */
    private $section;

    public function __construct()
    {
        $this->attendance = new ArrayCollection();
        $this->section = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) "$this->id - $this->firstName $this->lastName";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_STUDENT
        $roles[] = 'ROLE_STUDENT';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendance(): Collection
    {
        return $this->attendance;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendance->contains($attendance)) {
            $this->attendance[] = $attendance;
            $attendance->setStudent($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendance->contains($attendance)) {
            $this->attendance->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getStudent() === $this) {
                $attendance->setStudent(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGuardian(): ?string
    {
        return $this->guardian;
    }

    public function setGuardian(?string $guardian): self
    {
        $this->guardian = $guardian;

        return $this;
    }

    public function getGuardianContact(): ?string
    {
        return $this->guardianContact;
    }

    public function setGuardianContact(?string $guardianContact): self
    {
        $this->guardianContact = $guardianContact;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Section $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->section->contains($section)) {
            $this->section->removeElement($section);
        }

        return $this;
    }
}

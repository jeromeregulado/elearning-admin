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
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $uuid;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string Plain password
     */
    protected $plainPassword;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="middle_name", type="string", nullable=true)
     */
    protected $middleName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @var bool
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @var datetime
     * @ORM\Column(name="birthday", type="date")
     */
    protected $birthday;

    /**
     * @var longtext
     * @ORM\Column(name="address", type="text")
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="guardian", type="string", nullable=true)
     */
    protected $guardian;

    /**
     * @var string
     * @ORM\Column(name="guardian_contact", type="string", nullable=true)
     */
    protected $guardianContact;

    /**
     * @var \App\Entity\Attendance
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="student")
     */
    protected $attendance;

    /**
     * @var \App\Entity\Section
     * @ORM\ManyToOne(targetEntity="App\Entity\Section", inversedBy="student")
     */
    protected $section;

    /**
     * @var \App\Entity\Message
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="student")
     */
    protected $message;

    /**
     * @var \App\Entity\Activity
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="student")
     */
    protected $activity;

    /**
     * @var \App\Entity\Grades
     * @ORM\OneToMany(targetEntity="App\Entity\Grades", mappedBy="student")
     */
    protected $grades;

    public function __construct()
    {
        $this->attendance = new ArrayCollection();
        $this->message = new ArrayCollection();
        $this->activity = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->uuid . " - " .$this->firstName . " " . $this->lastName;
    }

    public function getFullName()
    {
        return (string) $this->lastName . ", " . $this->firstName;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_STUDENT';

        return array_unique($roles);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return (string) $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return (string) $this->uuid;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

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

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setStudent($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->contains($message)) {
            $this->message->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getStudent() === $this) {
                $message->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivity(): Collection
    {
        return $this->activity;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activity->contains($activity)) {
            $this->activity[] = $activity;
            $activity->setStudent($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activity->contains($activity)) {
            $this->activity->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getStudent() === $this) {
                $activity->setStudent(null);
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
            $grade->setStudent($this);
        }

        return $this;
    }

    public function removeGrade(Grades $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(name="mobile_number", type="string", nullable=true)
     */
    protected $mobileNumber;

    /**
     * @var text
     * @ORM\Column(name="address", type="text")
     */
    protected $address;

    /**
     * @var \App\Entity\Attendance
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="teacher")
     */
    protected $attendance;

    /**
     * @var \App\Entity\Advisory
     * @ORM\OneToMany(targetEntity="App\Entity\Advisory", mappedBy="teacher")
     */
    protected $advisory;

    /**
     * @var \App\Entity\Lesson
     * @ORM\OneToMany(targetEntity="App\Entity\Lesson", mappedBy="teacher")
     */
    protected $lesson;

    /**
     * @var \App\Entity\Message
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="teacher")
     */
    protected $message;

    /**
     * @var \App\Entity\Activity
     * @ORM\OneToMany(targetEntity="App\Entity\Activity", mappedBy="teacher")
     */
    protected $activity;

    /**
     * @var \App\Entity\Grades
     * @ORM\OneToMany(targetEntity="App\Entity\Grades", mappedBy="teacher")
     */
    protected $grades;

    public function __construct()
    {
        $this->attendance = new ArrayCollection();
        $this->advisory = new ArrayCollection();
        $this->lesson = new ArrayCollection();
        $this->message = new ArrayCollection();
        $this->activity = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) "$this->uuid - $this->firstName $this->lastName";
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
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_TEACHER';

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

    public function getPlainPassword(): string
    {
        return (string) $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): string
    {
        $this->plainPassword = $plainPassword;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber(?string $mobileNumber): self
    {
        $this->mobileNumber = $mobileNumber;

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
            $attendance->setTeacher($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendance->contains($attendance)) {
            $this->attendance->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getTeacher() === $this) {
                $attendance->setTeacher(null);
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
            $advisory->setTeacher($this);
        }

        return $this;
    }

    public function removeAdvisory(Advisory $advisory): self
    {
        if ($this->advisory->contains($advisory)) {
            $this->advisory->removeElement($advisory);
            // set the owning side to null (unless already changed)
            if ($advisory->getTeacher() === $this) {
                $advisory->setTeacher(null);
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
            $lesson->setTeacher($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lesson->contains($lesson)) {
            $this->lesson->removeElement($lesson);
            // set the owning side to null (unless already changed)
            if ($lesson->getTeacher() === $this) {
                $lesson->setTeacher(null);
            }
        }

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
            $message->setTeacher($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->contains($message)) {
            $this->message->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getTeacher() === $this) {
                $message->setTeacher(null);
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
            $activity->setTeacher($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activity->contains($activity)) {
            $this->activity->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getTeacher() === $this) {
                $activity->setTeacher(null);
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

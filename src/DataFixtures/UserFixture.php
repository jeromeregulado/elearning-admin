<?php

namespace App\DataFixtures;

use App\Entity\User as Teacher;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Teacher();
        $user->setFirstName('admin')
            ->setLastName('admin')
            ->setUuid('admin')
            ->setRoles(['ROLE_ADMIN', 'ROLE_TEACHER', 'ROLE_USER'])
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setIsActive(1)
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);
        $manager->flush();

        $user = new Teacher();
        $user->setFirstName('Teacher 1')
            ->setLastName('Teacher')
            ->setUuid('emp1')
            ->setRoles(['ROLE_TEACHER'])
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setIsActive(1)
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);
        $manager->flush();

        $user = new Student();
        $user->setFirstName('Student 1')
            ->setLastName('Student')
            ->setUuid('stud1')
            ->setRoles(['ROLE_STUDENT'])
            ->setBirthday(\DateTime::createFromFormat("Y-m-d", "1996-11-07"))
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setIsActive(1)
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);
        $manager->flush();
    }
}

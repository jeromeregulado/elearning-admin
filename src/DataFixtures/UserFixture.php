<?php

namespace App\DataFixtures;

use App\Entity\Section;
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
        $user->setFirstName('Walter')
            ->setLastName('White')
            ->setUuid(date('Y') . rand(0,500000))
            ->setRoles(['ROLE_TEACHER'])
            ->setIsActive(1)
            ->setAddress('Address here')
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);
        $manager->flush();

        $user = new Student();
        $user->setFirstName('Jessie')
            ->setLastName('Pinkman')
            ->setUuid(date('Y') . rand(0,500000))
            ->setRoles(['ROLE_STUDENT'])
            ->setBirthday(\DateTime::createFromFormat("Y-m-d", "1996-11-07"))
            ->setIsActive(1)
            ->setAddress('Address here')
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);
        $manager->flush();

        $section = new Section();
        $section->setName('Class 1')
            ->setLevel('Kindergarten')
            ->setAcademicYear('2018-2019');
        $manager->persist($section);
        $manager->flush();

        $section = new Section();
        $section->setName('Class 2')
            ->setLevel('Preschool')
            ->setAcademicYear('2018-2019');
        $manager->persist($section);
        $manager->flush();
    }
}

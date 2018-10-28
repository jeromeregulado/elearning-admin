<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        $user = new User();

        $user->setFirstName('admin')
            ->setLastName('elearner')
            ->setUuid('admin')
            ->setRoles(['ROLE_ADMIN', 'ROLE_TEACHER', 'ROLE_USER'])
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setPassword($this->passwordEncoder->encodePassword($user, '123456'));

        $manager->persist($user);
        $manager->flush();
    }
}

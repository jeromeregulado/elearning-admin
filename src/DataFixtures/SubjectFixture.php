<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/4/18
 * Time: 7:00 PM
 */

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $subject = new Subject();
        $subject->setName("Mathematics")
            ->setIsActive(1);
        $manager->persist($subject);
        $manager->flush();

        $subject = new Subject();
        $subject->setName("Science")
            ->setIsActive(1);
        $manager->persist($subject);
        $manager->flush();

        $subject = new Subject();
        $subject->setName("Arts")
            ->setIsActive(1);
        $manager->persist($subject);
        $manager->flush();

        $subject = new Subject();
        $subject->setName("English")
            ->setIsActive(1);
        $manager->persist($subject);
        $manager->flush();
    }
}
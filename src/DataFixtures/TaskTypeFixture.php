<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/4/18
 * Time: 7:21 PM
 */

namespace App\DataFixtures;

use App\Entity\TaskType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskTypeFixture extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $task = new TaskType();
        $task->setName("Homework")
            ->setIsActive(1);
        $manager->persist($task);
        $manager->flush();

        $task = new TaskType();
        $task->setName("Activity")
            ->setIsActive(1);
        $manager->persist($task);
        $manager->flush();

        $task = new TaskType();
        $task->setName("Quiz")
            ->setIsActive(1);
        $manager->persist($task);
        $manager->flush();

        $task = new TaskType();
        $task->setName("Exam")
            ->setIsActive(1);
        $manager->persist($task);
        $manager->flush();
    }
}
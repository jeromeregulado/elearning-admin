<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/9/18
 * Time: 4:27 PM
 */

namespace App\Controller\EasyAdmin;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Student;

class AttendanceController extends AdminController
{
    /**
     * Allows applications to modify the entity associated with the item being
     * created before persisting it.
     *
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $teacher = $this->getUser();

        $entity
            ->setTeacher($teacher);
        return parent::prePersistEntity($entity);
    }

    /**
     * Allows applications to modify the entity associated with the item being
     * edited before persisting it.
     *
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        return parent::preUpdateEntity($entity);
    }

    /**
     * Creates the form builder of the form used to create or edit the given entity.
     *
     * @param object $entity
     * @param string $view The name of the view where this form is used ('new' or 'edit')
     *
     * @return FormBuilder
     */
    protected function createAttendanceEntityFormBuilder($entity, $view)
    {
        $teacher = $this->getUser();
        $builder = parent::createEntityFormBuilder($entity, $view);

        $builder->remove('teacher');

        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'P - Present' => 'present',
                    'A - Absent' => 'absent',
                    'E - Excuse' => 'excuse',
                    'O - Others' => 'others'
                ],
                'required' => true,
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ])
            ->add('remarks', TextareaType::class, [
                'required' => false
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'query_builder' => function (EntityRepository $repository) use ($teacher) {
                    return $repository->createQueryBuilder('s')
                        ->where('s.teacher = :teacher')
                        ->setParameter('teacher', $teacher);
                },
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'years' => range(date('Y'), date('Y')),
                'months' => range(1, 12),
                'days' => range(1, 31),
            ])
        ;
        return $builder;
    }

}
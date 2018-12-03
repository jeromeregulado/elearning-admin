<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/3/18
 * Time: 9:47 AM
 */

namespace App\Controller\EasyAdmin;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ActivityController extends AdminController
{
    /**
     * Allows applications to modify the entity associated with the item being
     * created before persisting it.
     *
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $entity
            ->setTeacher($this->getUser());
        return parent::prePersistEntity($entity);
    }

    /**
     * Creates Query Builder instance for all the records.
     *
     * @param string $entityClass
     * @param string $sortDirection
     * @param string|null $sortField
     * @param string|null $dqlFilter
     *
     * @return \Doctrine\ORM\QueryBuilder The Query Builder instance
     */
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        $user = $this->getUser();
        $qb = parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        if ($user->getUserName() == 'admin') return $qb;

        $qb->where('entity.teacher = :teacher')
            ->setParameter('teacher', $user)
            ->addOrderBy('entity.id', 'DESC')
        ;

        return $qb;
    }

    /**
     * Creates the form builder of the form used to create or edit the given entity.
     *
     * @param object $entity
     * @param string $view The name of the view where this form is used ('new' or 'edit')
     *
     * @return FormBuilder
     */
    protected function createActivityEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);
        $builder
            ->remove('updatedAt')
            ->remove('date')
            ->remove('fileName')
            ->remove('teacher')
        ;

        $builder
            ->add('file', VichImageType::class, [
                'label' => 'Scanned activity',
                'required' => true,
                'delete_label' => 'Delete (?)',
                'allow_delete' => true
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('s')
                        ->where('s.teacher = :teacher')
                        ->setParameter('teacher', $this->getUser());
                },
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ])
        ;

        return $builder;
    }
}

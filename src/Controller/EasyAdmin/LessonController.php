<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/3/18
 * Time: 8:53 AM
 */

namespace App\Controller\EasyAdmin;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Subject;

class LessonController extends AdminController
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
            ->setTeacher($this->getUser())
        ;
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
    protected function createLessonEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);
        $builder
            ->remove('updatedAt')
            ->remove('fileName')
            ->remove('teacher')
            ->remove('date')
        ;

        $builder
            ->add('file', VichFileType::class, [
                'label' => 'Handouts (doc, docx, pdf)',
                'required' => true,
                'delete_label' => 'Delete (?)',
                'allow_delete' => true
            ])
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'required' => true,
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ])
        ;

        return $builder;
    }
}

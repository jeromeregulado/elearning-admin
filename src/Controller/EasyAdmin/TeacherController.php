<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 10/28/18
 * Time: 4:00 PM
 */

namespace App\Controller\EasyAdmin;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;
use AlterPHP\EasyAdminExtensionBundle\Form\Type\EasyAdminEmbeddedListType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TeacherController extends AdminController
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Allows applications to modify the entity associated with the item being
     * created before persisting it.
     *
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $entity
            ->setUuid(date('Y') . rand(0,500000))
            ->setRoles(['ROLE_TEACHER'])
            ->setIsActive(1)
            ->setPassword($this->encoder->encodePassword($entity, '123456'))
        ;

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
        if (!empty($entity->getPlainPassword())) {
            $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPlainPassword()));
        }

        return parent::preUpdateEntity($entity);
    }

    /**
     * Creates Query Builder instance for all the records.
     *
     * @param string $entityClass
     * @param string $sortDirection
     * @param string|null $sortField
     * @param string|null $dqlFilter
     *
     * @return QueryBuilder The Query Builder instance
     */
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        $qb = parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        $qb->where('entity.roles LIKE :roles')
            ->andWhere('entity.firstName != \'admin\'')
            ->setParameter('roles', '%"ROLE_TEACHER"%')
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
    protected function createTeacherEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $builder
            ->remove('attendance')
            ->remove('isActive')
            ->remove('uuid')
            ->remove('message')
            ->remove('activity')
            ->remove('grades')
            ->remove('event')
        ;

        $builder->add('lesson', EasyAdminEmbeddedListType::class);
        $builder->add('student', EasyAdminEmbeddedListType::class);

        if ($this->request->get('action') == 'edit') {
            $builder
                ->remove('lesson')
                ->remove('student');
        }

        return $builder;
    }


}

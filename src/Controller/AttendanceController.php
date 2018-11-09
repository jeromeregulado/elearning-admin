<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 11/9/18
 * Time: 4:27 PM
 */

namespace App\Controller;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;

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
        $builder = parent::createEntityFormBuilder($entity, $view);
        return $builder;
    }

}
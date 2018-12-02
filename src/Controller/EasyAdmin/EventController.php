<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/1/18
 * Time: 8:48 PM
 */

namespace App\Controller\EasyAdmin;

use AlterPHP\EasyAdminExtensionBundle\Controller\AdminController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EventController extends AdminController
{
    /**
     * Creates the form builder of the form used to create or edit the given entity.
     *
     * @param object $entity
     * @param string $view The name of the view where this form is used ('new' or 'edit')
     *
     * @return FormBuilder
     */
    protected function createEventEntityFormBuilder($entity, $view)
    {
        $user = $this->getUser();

        $adminChoices = [
            'HOLIDAY' => 'HOLIDAY',
            'SCHOOL EVENT' => 'SCHOOL_EVENT',
            'EXAM' => 'EXAM',
        ];
        $teacherChoices = [
            'QUIZ' => 'QUIZ',
            'HOMEWORK' => 'HOMEWORK',
            'ACTIVITY' => 'ACTIVITY'
        ];
        $builder = parent::createEntityFormBuilder($entity, $view);

        $builder
            ->add('dateStart', DateType::class, [
                'label' => 'Start',
                'years' => range(date('Y'), date('Y') + 1),
                'months' => range(1, 12),
                'days' => range(1, 31),
            ])
            ->add('dateEnd', DateType::class, [
                'label' => 'End',
                'years' => range(date('Y'), date('Y') + 1),
                'months' => range(1, 12),
                'days' => range(1, 31),
                'required' => false
            ])
        ;

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $builder->add('type', ChoiceType::class, [
                'choices' => $adminChoices,
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ]);
        } else {
            $builder->add('type', ChoiceType::class, [
                'choices' => $teacherChoices,
                'attr' => [
                    'data-widget' => 'select2'
                ]
            ]);
        }

        return $builder;
    }
}

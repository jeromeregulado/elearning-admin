<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/14/18
 * Time: 11:13 AM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route(
     *     name="teacher_update_password",
     *     path="/admin/teacher/update_password"
     * )
     */
    public function updatePasswordAction()
    {
        return $this->redirectToRoute('easyadmin', [
            'action' => 'edit',
            'id' => $this->getUser()->getId(),
            'entity' => 'Teacher'
        ]);
    }
}

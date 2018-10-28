<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 10/28/18
 * Time: 12:59 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(): Response
    {
        return new RedirectResponse($this->generateUrl('user_login'));
    }

    /**
     * @Route("/login", name="user_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') ||
            $this->get('security.authorization_checker')->isGranted('ROLE_TEACHER')) {
            return new RedirectResponse($this->generateUrl('easyadmin'));
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}
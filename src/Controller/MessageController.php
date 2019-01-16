<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/14/18
 * Time: 2:41 PM
 */

namespace App\Controller;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends Controller
{
    /**
     * @Route(
     *     name="message_index",
     *     path="/admin/messages/{id}"
     * )
     */
    public function indexAction($id)
    {
        $senderList = $this->getDoctrine()->getRepository('App:Message')->getSenderList($id);
        $data = [];

        if (!empty($senderList)) {
            $message = $this->getDoctrine()->getRepository('App:Message')->getMessages($senderList[0]['thread']);

            $data['sender'] = $senderList;
            $data['message'] = $message;
        }
        return $this->render('message/base.html.twig', ['data' => $data]);
    }

    /**
     * @param $id
     * @param $threadId
     * @Route(
     *     name="ajax_message",
     *     path="/admin/messages/{id}/{threadId}",
     *     methods={"GET"}
     * )
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getMessages($id, $threadId)
    {
        $message = $this->getDoctrine()->getRepository('App:Message')->getMessages($threadId);

        return $this->render('message/messages.html.twig', ['data' => ['message' => $message]]);
    }

    /**
     * @param Request $request
     * @Route(
     *     name="ajax_message_send",
     *     path="/admin/messages/{id}/{threadId}",
     *     methods={"POST"}
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function sendMessage(Request $request)
    {
        $messageRepository = $this->getDoctrine()->getRepository('App:Message');
        $sentMessage = $request->request->get('message');

        $messageData = (new Message())
            ->setCreatedAt(new \DateTime())
            ->setMessage($sentMessage)
            ->setStatus('read')
            ->setThread($this->getDoctrine()->getRepository('App:MessageThread')->findOneById($request->get('threadId')))
            ->setSenderTeacher($this->getDoctrine()->getRepository('App:User')->findOneById($request->get('id')))
        ;
        $messageRepository->save($messageData);

        $message = $this->getDoctrine()->getRepository('App:Message')->getMessages($request->get('threadId'));
        return $this->render('message/messages.html.twig', ['data' => ['message' => $message]]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route(
     *     name="redirect_message",
     *     path="/admin/messages"
     * )
     */
    public function redirectMessage()
    {
        return $this->redirectToRoute('message_index', ['id' => $this->getUser()->getid()]);
    }
}

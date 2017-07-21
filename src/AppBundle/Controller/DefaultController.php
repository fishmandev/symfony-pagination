<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/users/{page}", name="users")
     * @param int $page
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getUserListAction($page = 1)
    {
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $limit = 5;
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->getUserList($page, $limit);
        $response->setData($users);

        return $response;
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/connexion", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $security = $this->get('security.token_storage');

        $token = $security->getToken();

        $user = $token->getUser();
        $serializer = $this->get('jms_serializer');
        $response = new Response($serializer->serialize($user,'json'));
        $response->headers->set('Content-Type','application/json');
        return $response;
    }
}

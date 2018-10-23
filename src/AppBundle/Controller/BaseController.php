<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;




class BaseController extends Controller
{

    
    public function renderJson($array = []){
        $serialiser = $this->container->get('jms_serializer');
        $response = new Response();
        $response->headers->set('Content-Type','application/json');
        $response->headers->set('Access-Control-Expose-Headers', 'Access-Control-*, Origin, X-Requested-With, Content-Type, Accept, Authorization');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        $response->headers->set('Access-Control-Allow-Methods', 'HEAD, GET, POST, OPTIONS, PUT, PATCH, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Access-Control-*, Origin, X-Requested-With, Content-Type, Accept, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', true);
        $response->setContent($serialiser->serialize($array,'json'));
        return $response;
    }

/*
    public function sendMailConfirmation($subject, $to, $user){
        $message = (new \Swift_Message($subject))
            ->setFrom('no-reply@leboncoin.mg')
            ->setTo($to)
            ->setBody(
                $this->renderView('emails/registration.html.twig',['user'=>$user]),
                'text/html'
            );

        $this->container->get('mailer')->send($message);
    }
*/
/*
    public function getToken($length = 32){
        if (function_exists('openssl_random_pseudo_bytes'))
        {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
            {
                // throw exception that unable to create random token
            }

            return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
        }

        return ;
    }
    */

}
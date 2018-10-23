<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Annonces;

class AdminValidationController extends Controller
{

     /**
     * @Rest\View()
     * @Rest\Put("/admin/validerAnnonces/{id_annonce}")
    */

    public function activationAnnonceAction($id_annonce){

    	$em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonces::class)->find($id_annonce);
        
        $isPublishDate = new \DateTime;

        $annonce->setIspublishDate($isPublishDate);

        $annonce->setIspublish(true);
        $em->persist($annonce);
        $em->flush();
        return new JsonResponse(['message'=>'Publication Activé'], Response::HTTP_CREATED);
        
    }
 }
    


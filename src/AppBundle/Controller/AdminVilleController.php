<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Ville;

class AdminVilleController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/admin/listeVille/{id_ville}")
     */
   public function getVilleAction($id_ville){
        $ville = $this->getDoctrine()->getRepository(Ville::class)->find($id_ville);
        if(!$ville){
            return new JsonRespons(['message'=>'Cette annonce n\'est pas enregister'], Response::HTTT_NOT_FOUND);
        }
        return $ville;
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_CREATED)
    * @Rest\Post("/admin/ajoutVille")
    */
    public function postVilleAction(Request $request)
    {
            
        $ville = new Ville();
        //$form = $this->createForm(villeType::class, $ville);

        //$form->submit($request->request->all());
        //if($form->isValid()){
        $ville->setCodePostal($request->get('codePostal'));
        $ville->setLibelleVille($request->get('libelleVille'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($ville);
        $em->flush();
        return new JsonResponse(['message'=>'Ajout avec succès'], Response::HTTP_CREATED);
                
          /*  }
            else{
                return new JsonResponse(['message'=>'Vous n\'avez pas de compte'], Response::HTTP_NOT_FOUND);
            }*/
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/admin/supprimVille/{id_ville}")
    */

   public function removeVilleAction($id_ville){

        $em = $this->getDoctrine()->getManager();
        $ville = $em->getRepository(Ville::class)->find($id_ville);  
        $em->remove($ville);
        $em->flush();
        return new JsonResponse(['message'=>'Suppression avec succès'], Response::HTTP_CREATED);
    }

     /**
     * @Rest\View()
     * @Rest\Put("/admin/modifierVille/{id_ville}")
    */

    public function updateVilleAction(Request $request, $id_ville){

        
       	$em = $this->getDoctrine()->getManager();
        $ville = $em->getRepository(Ville::class)->find($id_ville);
		$ville->setCodePostal($request->get('codePostal'));
        $ville->setLibelleVille($request->get('libelleVille'));
        
        $em->persist($ville);
        $em->flush();

        return new JsonResponse(['message'=>'Modification avec succès'], Response::HTTP_CREATED);
        
    }
 }
    


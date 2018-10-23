<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\AnnoncesType;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\TypeAnnonce;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityManagerInterface;


class CategorieController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/categorie")
     */
   public function getCategorieAction(EntityManagerInterface $entityManager){

   	/*$query = $entityManager->createQuery('SELECT c
    FROM AppBundle:Categorie c
    ORDER BY c.libelleTypeCategorie ASC');
	$categorie = $query->getResult();*/
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        if(empty ($categorie)){
            return new JsonRespons(['message'=>'Categorie non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $categorie;
    }


    /**
     * @Rest\View()
     * @Rest\Get("/vehicule")
     */
   public function getVehiculesAction(){
        $vehicules = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Véhicules"));
        if(empty ($vehicules)){
            return new JsonRespons(['message'=>'Véhicules non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $vehicules;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/modeBeaute")
     */
   public function getMdeBeauteAction(){
        $modeBeaute = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Mode & Beauté"));
        if(empty ($modeBeaute)){
            return new JsonRespons(['message'=>'Mode & Beauté non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $modeBeaute;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/maison")
     */
   public function getMaisonAction(){
        $maison = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Maison"));
        if(empty ($maison)){
            return new JsonRespons(['message'=>'Maison non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $maison;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/travailEmploi")
     */
   public function getTravailEmploiAction(){
        $travailEmploi = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Travail & Emploi"));
        if(empty ($travailEmploi)){
            return new JsonRespons(['message'=>'Travail et emploi non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $travailEmploi;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/agriculture")
     */
   public function getAgricultureAction(){
        $agriculture = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Agriculture"));
        if(empty ($agriculture)){
            return new JsonRespons(['message'=>'Agriculture non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $agriculture;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/multimedia")
     */
   public function getMultimediaAction(){
        $multimedia = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Multimédia"));
        if(empty ($multimedia)){
            return new JsonRespons(['message'=>'Multimedia non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $multimedia;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/immobilier")
     */
   public function getImmobilierAction(){
        $immobilier = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Immobilier"));
        if(empty ($immobilier)){
            return new JsonRespons(['message'=>'Immobilier non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $immobilier;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/materielDivers")
     */
   public function getMaterielDiversAction(){
        $materielDivers = $this->getDoctrine()->getRepository(Categorie::class)->findBy(array("groupeCategorie"=>"Matériel divers"));
        if(empty ($materielDivers)){
            return new JsonRespons(['message'=>'Materiel et Divers non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $materielDivers;
    }




















    /**
     * @Rest\View()
     * @Rest\Get("/typeAnnonce")
     */
   public function getTypeAnnonceAction(){
        $typeAnnonce = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findAll();
        if(empty ($typeAnnonce)){
            return new JsonRespons(['message'=>'Type d\'annonce non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $typeAnnonce;
    }

}
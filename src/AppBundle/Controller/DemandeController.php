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
use AppBundle\Entity\Annonces;
use AppBundle\Entity\TypeAnnonce;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityManagerInterface;


class DemandeController extends Controller
{

	/**
     * @Rest\View()
     * @Rest\Get("/demande")
     */
   public function getDemandeAction(){
   		//$libelleTypeAnnonce = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findOneBy(array("libelleTypeAnnonce"=>"Demandes"));
        $demande = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>2, "isPublish"=>1));
        if(empty ($demande)){
            return new JsonResponse(['message'=>'Demandes non trouvés']);
        }
        return $demande;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/derniereDemande")
     */
   public function getDerniereDemandeAction(EntityManagerInterface $entityManager){
        
    //$now = date("Y-m-d");
    $now = new \DateTime;
    $dateav = strtotime('-2 weeks 1 days');
    
    $dateavant = date("Y-m-d", $dateav);

    $qb = $entityManager->createQueryBuilder();
    $derniereDemande = $qb->select(array('a'))
    ->from('AppBundle:Annonces', 'a')
    ->where('a.isPublishDate >= :dateavant')
    ->andWhere('a.isPublishDate <= :now')
    ->andWhere('a.typeAnnonce = :demande')
    ->andWhere('a.isPublish = :activer')
    ->setParameter('dateavant', $dateavant)
    ->setParameter('now', $now)
    ->setParameter('demande', 2)
    ->setParameter('activer', 1)
    ->orderBy('a.isPublishDate', 'ASC')
    ->getQuery()
    ->getResult();
        if(empty ($derniereDemande)){
            return new JsonResponse(['message'=>'Derniere Demandes non trouvés']);
        }
    return $derniereDemande;
    }


    /**
     * @Rest\View()
     * @Rest\Get("/demandePart")
     */
   public function getDemandePartAction(){
   		//$libelleTypeAnnonce = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findOneBy(array("libelleTypeAnnonce"=>"Demandes"));
        $demande = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>2, "typeUtilisateur"=>1, "isPublish"=>1));
        if(empty ($demande)){
            return new JsonResponse(['message'=>'Demandes particulier non trouvés']);
        }
        return $demande;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/demandePro")
     */
   public function getDemandeProAction(){
   		//$libelleTypeAnnonce = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findOneBy(array("libelleTypeAnnonce"=>"Demandes"));
        $demande = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>2, "typeUtilisateur"=>2, "isPublish"=>1));
        if(empty ($demande)){
            return new JsonResponse(['message'=>'Demandes professionnel non trouvés']);
        }
        return $demande;
    }

}
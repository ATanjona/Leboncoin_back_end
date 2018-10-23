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


class OffreController extends Controller
{

	/**
     * @Rest\View()
     * @Rest\Get("/offre")
     */
   public function getOffreAction(){
        $offre = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>1, "isPublish"=>1));
        if(empty ($offre)){
            return new JsonResponse(['message'=>'Offres non trouvés']);
        }
        return $offre;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/derniereOffre")
     */
   public function getDerniereOffreAction(EntityManagerInterface $entityManager){
        
    //$now = date("Y-m-d");
    $now = new \DateTime;
    $dateav = strtotime('-2 weeks 1 days');
    
    $dateavant = date("Y-m-d", $dateav);

    $qb = $entityManager->createQueryBuilder();
    $derniereOffre = $qb->select(array('a'))
    ->from('AppBundle:Annonces', 'a')
    ->where('a.isPublishDate >= :dateavant')
    ->andWhere('a.isPublishDate <= :now')
    ->andWhere('a.typeAnnonce = :offre')
    ->andWhere('a.isPublish = :activer')
    ->setParameter('dateavant', $dateavant)
    ->setParameter('now', $now)
    ->setParameter('offre', 1)
    ->setParameter('activer', 1)
    ->orderBy('a.isPublishDate', 'ASC')
    ->getQuery()
    ->getResult();
        if(empty ($derniereOffre)){
            return new JsonResponse(['message'=>'Derniere Offre non trouvés']);
        }
    return $derniereOffre;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/offrePart")
     */
   public function getOffrePartAction(){
        $offre = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>1, "typeUtilisateur"=>1, "isPublish"=>1));
        if(empty ($offre)){
            return new JsonResponse(['message'=>'Offres particulier non trouvés']);
        }
        return $offre;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/offrePro")
     */
   public function getOffreProAction(){
        $offre = $this->getDoctrine()->getRepository(Annonces::class)->findBy(array("typeAnnonce"=>1, "typeUtilisateur"=>2, "isPublish"=>1));
        if(empty ($offre)){
            return new JsonResponse(['message'=>'Offres professionnel non trouvés']);
        }
        return $offre;
    }

}
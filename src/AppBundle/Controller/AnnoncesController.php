<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use AppBundle\Form\AnnoncesType;
use AppBundle\Entity\Annonces;
use AppBundle\Controller\UserController;
use AppBundle\Entity\User;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\TypeAnnonce;
use AppBundle\Entity\TypeUtilisateur;
use AppBundle\Entity\Ville;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AnnoncesController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/annonce/liste")
     */
   public function getAnnonceAction(){
        $annonce = $this->getDoctrine()->getRepository(Annonces::class)->findAll();
        if(empty ($annonce)){
            return new JsonRespons(['message'=>'Annonces non trouvés'], Response::HTTT_NOT_FOUND);
        }
        return $annonce;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/annonce/liste/{id_annonce}")
     */
   public function selectAnnonceAction($id_annonce){
        $annonce = $this->getDoctrine()->getRepository(Annonces::class)->find($id_annonce);
        if(!$annonce){
            return new JsonRespons(['message'=>'Cette annonce n\'est pas enregister'], Response::HTTT_NOT_FOUND);
        }
        return $annonce;
    }

    /**
     * @param Request $request
     * @Route("/upload/image")
     */
    public function addAnnonceAction(Request $request){
        $annonce = new Annonces();
        $em = $this->getDoctrine()->getManager();
        if($request->getMethod() == "POST"){
            dump($request->files->get('flyerFile'));
            $annonce->setFlyerFile($request->files->get('flyerFile'));
            $annonce->upload();
            $em->persist($annonce);
            $em->flush();
        }
        return $this->render('upload/test.html.twig',[
        ]);
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/uploadImage")
     */
        public function uploadImageAction(Request $request){
        $annonce = new Annonces();
        $em = $this->getDoctrine()->getManager();
        $annonce->setFlyerFile($request->files->get('flyerFile'));
        $annonce->upload();
        $em->persist($annonce);
        $em->flush();
        return new JsonResponse(['message'=>'Ajout avec succès'], response::HTTP_CREATED);

    }

    /**
    * @Rest\View(statusCode=Response::HTTP_CREATED)
    * @Rest\Post("/deposer/annonce")
    */
    public function postAnnonceAction(Request $request)
    {

        $annonces = new Annonces();
        //$form = $this->createForm(AnnoncesType::class, $annonces);

        //$form->submit($request->request->all());
        //if($form->isValid()){
        $em = $this->getDoctrine()->getManager();
        //$user = $this->getUser();

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['apiKey'=>$request->headers->get('X-AUTH-TOKEN')]);

        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(array("libelleTypeCategorie"=>$request->get('libelleTypeCategorie')));
        $typeAnnonc = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findOneBy(array("libelleTypeAnnonce"=>$request->get('libelleTypeAnnonce')));

        //$typeUtilisa = $this->getDoctrine()->getRepository(TypeUtilisateur::class)->findOneBy(array("libelleTypeUtilisa"=>$request->get('libelleTypeUtilisa')));


        $ville = $this->getDoctrine()->getRepository(Ville::class)->findOneBy(array("codePostal"=>$request->get('codePostal')));

        //nom
        //$ville = $this->getDoctrine()->getRepository(Ville::class)->findOneBy(array("codePostal"=>$request->get('codePostal')));
        
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate');
        $date_start = \DateTime::createFromFormat('Y-m-d', $startDate);
        $date_end = \DateTime::createFromFormat('Y-m-d', $endDate);

        $annonces->setUser($user);
        $annonces->setCategorie($categorie);
        $annonces->setTypeUtilisateur($user->getTypeUtilisateur());
        $annonces->setTypeAnnonce($typeAnnonc);
        $annonces->setTitre($request->get('titre'));
        $annonces->setText($request->get('text'));
        $annonces->setPrix($request->get('prix'));
        //$annonces->setFlyerFile($request->files->get('flyerFile'));
        //$annonces->upload();
        //dump($request->files->get('flyerFile'));
        $annonces->setFlyer($request->get('flyer'));
        $annonces->setVille($ville);
        $annonces->setAdresse($request->get('adresse'));
        $annonces->setEmailAnnonce($request->get('emailAnnonce'));
        $annonces->setTelAnnonce($request->get('telAnnonce'));
        //$annonces->setEmail($users[0]['email']);
        //$annonces->setNumberPhone($request->get('numTel'));
        $annonces->setStartDate($date_start);
        if ($endDate)$annonces->setEndDate($date_end);
        else $annonces->setEndDate(null);
        $annonces->setIspublishDate(null);
        $annonces->setIspublish(false);
        $em->persist($annonces);
        $em->flush();

        return new JsonResponse(['message'=>'Ajout avec succès'], response::HTTP_CREATED);
        //return $this->renderJson(['message' => 'Ajout avec succès'],Response::HTTP_OK);
          /*  }
            else{
                return new JsonResponse(['message'=>'Vous n\'avez pas de compte'], Response::HTTP_NOT_FOUND);
            }*/
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/annonce/supprimer/{id_annonce}")
    */

   public function removeAnnonceAction($id_annonce){

        $user = $this->getUser();

        $users = $this->get('database_connection')->fetchAll('SELECT * FROM user where id = '.$this->getUser()->getId());

        $user->setPassword($users[0]['password']);

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonces::class)->find($id_annonce);

        $em->remove($annonce);
        $em->flush();
        return new JsonResponse(['message'=>'Suppression avec succès'], Response::HTTP_CREATED);
    }

     /**
     * @Rest\View()
     * @Rest\Put("/annonce/modifier/{id_annonce}")
    */

    public function updateAnnonceAction(Request $request, $id_annonce){

        $user = $this->getUser();

        $users = $this->get('database_connection')->fetchAll('SELECT * FROM user where id = '.$this->getUser()->getId());

        $user->setPassword($users[0]['password']);

        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository(Annonces::class)->find($id_annonce);


        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(array("libelleTypeCategorie"=>$request->get('libelleTypeCategorie')));
        $typeAnnonc = $this->getDoctrine()->getRepository(TypeAnnonce::class)->findOneBy(array("libelleTypeAnnonce"=>$request->get('libelleTypeAnnonce')));
        $typeUtilisa = $this->getDoctrine()->getRepository(TypeUtilisateur::class)->findOneBy(array("libelleTypeUtilisa"=>$request->get('libelleTypeUtilisa')));
        $ville = $this->getDoctrine()->getRepository(Ville::class)->findOneBy(array("codePostal"=>$request->get('codePostal')));


        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $date_start = \DateTime::createFromFormat('Y-m-d', $startDate);
        $date_end = \DateTime::createFromFormat('Y-m-d', $endDate);


        $annonces->setCategorie($categorie);
        $annonces->setTypeUtilisateur($typeUtilisa);
        $annonces->setTypeAnnonce($typeAnnonc);
        $annonces->setTitre($request->get('titre'));
        $annonces->setText($request->get('text'));
        $annonces->setPrix($request->get('prix'));
        $annonces->setFlyer($request->get('flyer'));
        $annonces->setVille($ville);
        $annonces->setAdresse($request->get('adresse'));
        $annonces->setStartDate($date_start);
        if ($endDate)$annonces->setEndDate($date_end);
        else $annonces->setEndDate(null);

        $em->persist($annonces);
        $em->flush();

        return new JsonResponse(['message'=>'Modification avec succès'], Response::HTTP_CREATED);

    }
    
 }
    


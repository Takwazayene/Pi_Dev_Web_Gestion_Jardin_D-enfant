<?php

namespace RestoBundle\Controller;

use RestoBundle\Entity\abonneresto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use RestoBundle\Form\abonnerestoType;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Abonneresto controller.
 *
 */
class abonnerestoController extends Controller
{
    /**
     * Lists all abonneresto entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $abonnerestos = $em->getRepository('RestoBundle:abonneresto')->findAll();

        if ($request->isMethod("POST")) {
            $nom = $request->get("nom"); //1
            $typeAbo = $request->get("typeAbo"); //2
            $typePension = $request->get("typePension");//3
            $etat = $request->get("etat");//4

            if (empty($nom) and empty($typeAbo) and empty($typePension) and !empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array( 'etat' => $etat));
            }

            if (!empty($nom) and !empty($typeAbo) and !empty($typePension) and !empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'typeAbo' => $typeAbo, 'typePension' => $typePension, 'etat' => $etat));
            }
            if (!empty($nom) and !empty($typeAbo) and !empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'typeAbo' => $typeAbo, 'typePension' => $typePension));
            }
            if (!empty($nom) and !empty($typeAbo) and empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'typeAbo' => $typeAbo));
            }
            if (!empty($nom) and empty($typeAbo) and !empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'typePension' => $typePension));
            }
//
            if (!empty($nom) and empty($typeAbo) and empty($typePension) and !empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'etat' => $etat));
            }

            if (empty($nom) and !empty($typeAbo) and empty($typePension) and !empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('typeAbo' => $typeAbo, 'etat' => $etat));
            }
            if (empty($nom) and empty($typeAbo) and !empty($typePension) and !empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('typePension' => $typePension, 'etat' => $etat));
            }

            if (empty($nom) and !empty($typeAbo) and !empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('typeAbo' => $typeAbo, 'typePension' => $typePension));
            }

           //
            if (!empty($nom) and !empty($typeAbo) and empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('typeAbo' => $typeAbo, 'nom' => $nom));
            }
            if (!empty($nom) and empty($typeAbo) and !empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('nom' => $nom, 'typePension' => $typePension));
            }
            if (empty($nom) and empty($typeAbo) and !empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array( 'typePension' => $typePension));
            }
            if (empty($nom) and !empty($typeAbo) and empty($typePension) and empty($etat) ) { //non vide
                $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('typeAbo' => $typeAbo));
            }











        }



        return $this->render('abonneresto/index.html.twig', array(
            'abonnerestos' => $abonnerestos,
        ));
    }

    /**
     * Creates a new abonneresto entity.
     *
     */
    public function newAction(Request $request)
    {
        $abonneresto = new Abonneresto();
        $form = $this->createForm('RestoBundle\Form\abonnerestoType', $abonneresto);
        $form->handleRequest($request);
        $person = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        var_dump($abonneresto->getNom());
        var_dump($abonneresto->getTypeAbo());

       // var_dump($person->getId());

        $reservation = $em->getRepository("RestoBundle:abonneresto")->findBy(array('idAb' =>$person->getId(),'nom'=>$abonneresto->getNom()));

        if ($form->isSubmitted() && $form->isValid()) {




            if (!empty($reservation)  ) {

                $this->addFlash('notice', 'votre abonnement annuel n est pas encore terminée !');
                $person=$this->getUser();
                $tab=$em->getRepository(abonneresto::class)->findMyReservations($person->getId());
                //return $this->render('@Resto/abonneresto/showMyReservations.html.twig',array('abonneresto'=>$tab));

                return $this->redirectToRoute('show_reservations', array('id' => $abonneresto->getId()));


            }

                $abonneresto->setIdAb($person->getId());
                $abonneresto->setDateAbo(new \DateTime('now'));
            $em->persist($abonneresto);

            $em->flush();

                return $this->redirectToRoute('show_reservations', array('id' => $abonneresto->getId()));
            }

            return $this->render('abonneresto/new.html.twig', array(
                'abonneresto' => $abonneresto,
                'form' => $form->createView(),
            ));

    }

    /**
     * Finds and displays a abonneresto entity.
     *
     */
    public function showAction(abonneresto $abonneresto)
    {
        $deleteForm = $this->createDeleteForm($abonneresto);

        return $this->render('abonneresto/show.html.twig', array(
            'abonneresto' => $abonneresto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing abonneresto entity.
     *
     */
    public function editAction(Request $request, abonneresto $abonneresto)
    {
        $deleteForm = $this->createDeleteForm($abonneresto);
        $editForm = $this->createForm('RestoBundle\Form\abonnerestoType', $abonneresto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonneresto_edit', array('id' => $abonneresto->getId()));
        }

        return $this->render('abonneresto/edit.html.twig', array(
            'abonneresto' => $abonneresto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a abonneresto entity.
     *
     */
    public function deleteAction(Request $request, abonneresto $abonneresto)
    {
        $form = $this->createDeleteForm($abonneresto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abonneresto);
            $em->flush();
        }

        return $this->redirectToRoute('show_reservations');
    }

    /**
     * Creates a form to delete a abonneresto entity.
     *
     * @param abonneresto $abonneresto The abonneresto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(abonneresto $abonneresto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abonneresto_delete', array('id' => $abonneresto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    //Affichage de mes réservations (Client):
    public function showMyReservationsAction()
    {

        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $person=$this->getUser();
        $tab=$em->getRepository(abonneresto::class)->findMyReservations($person->getId());
        return $this->render('@Resto/abonneresto/showMyReservations.html.twig',array('abonneresto'=>$tab));
    }

    public function platAction()
    {
        return $this->render('@Resto/abonneresto/plat.html.twig');
    }

    public function  AjouterMobileAction(Request $request){

        $EM = $this->getDoctrine()->getManager();//instancier la bd

        $abonneresto = new abonneresto();
        $abonneresto->setNom($request->get('nom'));
        $abonneresto->setTypeAbo($request->get('typeAbo'));
        $abonneresto->setTypePension($request->get('typePension'));
        $abonneresto->setEtat(0);
        $abonneresto->setAbsence(0);
        $abonneresto->setIdAb(1);
        $abonneresto->setDateAbo(new \DateTime('now'));

        $EM->persist($abonneresto);//initialiser l'objet dans la memoire
        $EM->flush();//executer la requête
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($abonneresto);
        return new JsonResponse($formatted);



    }

    public function AfficherMobileAction()
    {
        $EM =$this->getDoctrine()->getManager();
        $abonnerestos = $EM->getRepository('RestoBundle:abonneresto')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($abonnerestos);
        return new JsonResponse($formatted);
    }

    public function RechercheMobileAction($nom)
    {
        $EM =$this->getDoctrine()->getManager();

        $abonnerestos = $EM->getRepository('RestoBundle:abonneresto') ->findBy(array("nom"=>$nom));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($abonnerestos);
        return new JsonResponse($formatted);
    }


}

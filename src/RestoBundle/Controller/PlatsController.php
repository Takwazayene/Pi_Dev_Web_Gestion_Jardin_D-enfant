<?php

namespace RestoBundle\Controller;

use RestoBundle\Entity\Plat;
use RestoBundle\Entity\Plats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Plat controller.
 *
 */
class PlatsController extends Controller
{
    /**
     * Lists all plat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('RestoBundle:Plats')->findAll();

        return $this->render('plats/index.html.twig', array(
            'plats' => $plats,
        ));
    }


    public function indexAdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('RestoBundle:Plats')->findAll();

        return $this->render('plats/indexAdmin.html.twig', array(
            'plats' => $plats,
        ));
    }

    /**
     * Creates a new plat entity.
     *
     */
    public function newAction(Request $request)
    {
        $plat = new Plats();
        $form = $this->createForm('RestoBundle\Form\PlatsType', $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('plats_show', array('id' => $plat->getId()));
        }

        return $this->render('plats/new.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plat entity.
     *
     */
    public function showAction(Plats $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('plats/show.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plat entity.
     *
     */
    public function editAction(Request $request, Plats $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);
        $editForm = $this->createForm('RestoBundle\Form\PlatsType', $plat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plats_edit', array('id' => $plat->getId()));
        }

        return $this->render('plats/edit.html.twig', array(
            'plat' => $plat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plat entity.
     *
     */
    public function deleteAction(Request $request, Plats $plat)
    {
        $form = $this->createDeleteForm($plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plat);
            $em->flush();
        }

        return $this->redirectToRoute('plats_index');
    }

    /**
     * Creates a form to delete a plat entity.
     *
     * @param Plats $plat The plat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plats $plat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plats_delete', array('id' => $plat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function updaterateAction(Request $request)
    {
        $plat = new Plats();
        $rate=$request->get('ratee');
        $note=$request->get('note');
        $idP=$request->get('idP');
        $idPlat=$request->get('aa');
        $plat->setNom("couscous") ;
        $plat->setPlat(5);
       // $plat->setPlat($idPlat);
        $plat->setNbrrat(2);
        $plat->setRat(2);

       // $plat->setRat($rate);
            $em = $this->getDoctrine()->getManager();
        $plats = $em->getRepository('RestoBundle:Plats')->find(3);
        $plats->setNote(4);
      $em->persist($plats);
        $em->persist($plat);
            $em->flush();

        return $this->redirectToRoute('plats_rating');




       /* $rat = new Plat();
        $em = $this->getDoctrine()->getManager();
        $rat->setRat(1);
        $rat->setNbrrat(1);
        $rat->setNbrrat(2);
        $rat->setNom("couscous") ;
        $rate = $request->get('rate');

        $idmatch = $request->get('a');

       // $matchee = $em->getRepository('RestoBundle:Plats')->find($idmatch);

        $rat->setRat($rate);
        $rat->setPlat($idmatch);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rat);
        $em->flush();

        return $this->redirectToRoute('plats_rating');*/
    }



    public function AfficherMobileAction()
    {
        $EM =$this->getDoctrine()->getManager();
        $plats = $EM->getRepository('RestoBundle:Plats')->findAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($plats);
        return new JsonResponse($formatted);
    }


    public function  RateMobileAction(Request $request){

        $em = $this->getDoctrine()->getManager();//instancier la bd

        $id =$request->get('id');
        $note=$request->get('note');
        $plats= $em->getRepository("RestoBundle:Plats")->find($id);
        $noteInit= $plats->getnote();
        $somme =( $noteInit + $note) /2  ;
        $plats->setNote($somme);

        $em->persist($plats);//initialiser l'objet dans la memoire
        $em->flush();//executer la requête
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($plats);
        return new JsonResponse($formatted);



    }
}

<?php

namespace RestoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cartefidelite controller.
 *
 */
class cartefideliteController extends Controller
{
    /**
     * Lists all cartefidelite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $person = $this->getUser();
       $idAb=$person->getId();
      //  $idAb=4;
     //   $cartefidelites = $em->getRepository('RestoBundle:cartefidelite')->findBy('idAb' => $idAb);

$cartefidelites = $em->getRepository('RestoBundle:cartefidelite')->verifierExiste($idAb);

        return $this->render('cartefidelite/index.html.twig', array(
            'cartefidelites' => $cartefidelites,
        ));
    }

    public function indexAdminAction()
    {
        $em = $this->getDoctrine()->getManager();


        $cartefidelites = $em->getRepository('RestoBundle:cartefidelite')->findAll();

        return $this->render('cartefidelite/indexAdmin.html.twig', array(
            'cartefidelites' => $cartefidelites,
        ));
    }



    /**
     * Creates a new cartefidelite entity.
     *
     */
    public function newAction(Request $request)
    {
        $cartefidelite = new Cartefidelite();
        $form = $this->createForm('RestoBundle\Form\cartefideliteType', $cartefidelite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartefidelite);
            $em->flush();

            return $this->redirectToRoute('cartefidelite_show', array('idC' => $cartefidelite->getIdc()));
        }

        return $this->render('cartefidelite/new.html.twig', array(
            'cartefidelite' => $cartefidelite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cartefidelite entity.
     *
     */
    public function showAction(cartefidelite $cartefidelite)
    {
        $deleteForm = $this->createDeleteForm($cartefidelite);

        return $this->render('cartefidelite/show.html.twig', array(
            'cartefidelite' => $cartefidelite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cartefidelite entity.
     *
     */
    public function editAction(Request $request, cartefidelite $cartefidelite)
    {
        $deleteForm = $this->createDeleteForm($cartefidelite);
        $editForm = $this->createForm('RestoBundle\Form\cartefideliteType', $cartefidelite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cartefidelite_edit', array('idC' => $cartefidelite->getIdc()));
        }

        return $this->render('cartefidelite/edit.html.twig', array(
            'cartefidelite' => $cartefidelite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cartefidelite entity.
     *
     */
    public function deleteAction(Request $request, cartefidelite $cartefidelite)
    {
        $form = $this->createDeleteForm($cartefidelite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cartefidelite);
            $em->flush();
        }

        return $this->redirectToRoute('cartefidelite_index');
    }

    public function transformerAction(Request $request)
    {
        $person = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $idC = $request->get('idC');

        $cartefidelite= $em->getRepository("RestoBundle:cartefidelite")->find(4);

        $nbpoint=$cartefidelite->getNbpoint();
        $benefice=$cartefidelite->getBenefice();
        $nvbenefice=$benefice+$nbpoint/10;
        $cartefidelite->setBenefice($nvbenefice);
        $cartefidelite->setNbpoint(0) ;
        $em->flush();


        return $this->redirectToRoute('cartefidelite_index');



    }
    /**
     * Creates a form to delete a cartefidelite entity.
     *
     * @param cartefidelite $cartefidelite The cartefidelite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(cartefidelite $cartefidelite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cartefidelite_delete', array('idC' => $cartefidelite->getIdc())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function showListeAboAdminAction(Request $request)
    {
        $idC = $request->get('idC');

        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em = $this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $abonnerestos = $em->getRepository("RestoBundle:abonneresto")->findBy(array('idAb' =>$idC,'etat'=>1));

        return $this->render('abonneresto/index.html.twig', array(
            'abonnerestos' => $abonnerestos,
        ));    }

}

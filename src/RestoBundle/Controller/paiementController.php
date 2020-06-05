<?php

namespace RestoBundle\Controller;

use RestoBundle\Entity\paiement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use RestoBundle\Entity\cartefidelite;

use RestoBundle\Entity\abonneresto;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Paiement controller.
 *
 */
class paiementController extends Controller
{
    /**
     * Lists all paiement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paiements = $em->getRepository('RestoBundle:paiement')->findAll();

        return $this->render('paiement/index.html.twig', array(
            'paiements' => $paiements,
        ));
    }



    public function indexAdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paiements = $em->getRepository('RestoBundle:paiement')->findAll();

        $total=0;
        foreach ($paiements as $p) {
            $montant = $p->getTotal();
            $total = $total + $montant;
        }
        return $this->render('paiement/indexAdmin.html.twig', array(
            'paiements' => $paiements,
            'total'=>$total,
        ));
    }



    /**
     * Creates a new paiement entity.
     *
     */
    public function newAction(Request $request)
    {
        $idAb = $request->get('id');
        $typeAbo = $request->get('typeAbo');
        $typePension= $request->get('typePension');
        $etat=$request->get('etat');
        if($etat==1)
        {

            $this->addFlash(
                'notice',
                'Vous avez déjà payer cette reservation!'
            );

            ?><script>alert('Out of stock ';</script><?php
            return $this->redirectToRoute('paiement_index');



        }

        $paiement = new Paiement();
        $total=88;
        if ($typeAbo=="annuel")
        {
            if ($typePension=="complete")
            {
                $total=3400;
                $paiement->setTotal($total);
            }
            elseif ($typePension=="Demi p1")
            {
                $total=2000;
                $paiement->setTotal($total);

            }
            elseif ($typePension=="Demi p2")
            {
                $total=1500;
                $paiement->setTotal($total);

            }

        }
        elseif ($typeAbo=="mensuel")
        {
            if ($typePension=="complete")
            {
                $total=430;
                $paiement->setTotal($total);

            }
            elseif ($typePension=="Demi p1")
            {
                $total=275;
                $paiement->setTotal($total);

            }
            elseif ($typePension=="Demi p2")
            {
                $total=220;
                $paiement->setTotal($total);

            }


        }
        elseif ($typeAbo=="hebdomadaire")
        {
            if ($typePension=="complete")
            {
                $total=125;
                $paiement->setTotal($total);

            }
            elseif ($typePension=="Demi p1")
            {
                $total=80;
                $paiement->setTotal($total);

            }
            elseif ($typePension=="Demi p2")
            {
                $total=64;
                $paiement->setTotal($total);

            }


        }



        $form = $this->createForm('RestoBundle\Form\paiementType', $paiement,array('total'=>$total));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paiement->setDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();

            $abonneresto= $em->getRepository("RestoBundle:abonneresto")->find($idAb);
            $abonneresto->setEtat(1);


            $person = $this->getUser();
            $emm = $this->getDoctrine()->getManager();

            $cartefidelite= $emm->getRepository("RestoBundle:cartefidelite")->find($person->getId());
           $credit= $cartefidelite->getCredit();
           $nbpoint=$cartefidelite->getNbpoint();
            $nvcredit=$credit+$total;
            $nvnbpoint=$nbpoint+$total/5;



            $cartefidelite->setNbpoint($nvnbpoint);
            $cartefidelite->setCredit($nvcredit);

            $em->persist($paiement);
            $em->flush();

       //     return $this->redirectToRoute('paiement_show', array('id' => $paiement->getId()));
            return $this->redirectToRoute('paiement_index');

        }

        return $this->render('paiement/new.html.twig', array(
            'paiement' => $paiement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paiement entity.
     *
     */
    public function showAction(paiement $paiement)
    {
        $deleteForm = $this->createDeleteForm($paiement);

        return $this->render('paiement/show.html.twig', array(
            'paiement' => $paiement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paiement entity.
     *
     */
    public function editAction(Request $request, paiement $paiement)
    {
        $deleteForm = $this->createDeleteForm($paiement);
        $editForm = $this->createForm('RestoBundle\Form\paiementType', $paiement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paiement_edit', array('id' => $paiement->getId()));
        }

        return $this->render('paiement/edit.html.twig', array(
            'paiement' => $paiement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paiement entity.
     *
     */
    public function deleteAction(Request $request, paiement $paiement)
    {
        $form = $this->createDeleteForm($paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paiement);
            $em->flush();
        }

        return $this->redirectToRoute('paiement_index');
    }

    /**
     * Creates a form to delete a paiement entity.
     *
     * @param paiement $paiement The paiement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(paiement $paiement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paiement_delete', array('id' => $paiement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function sendNotificationAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world!');
        $notif->setMessage('This a notification.');
        $notif->setLink('https://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject', 'Some random text', 'https://google.fr/');

        // you can add a notification to a list of entities
        // the third parameter `$flush` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);


    }



    public function  AjouterMobileAction(Request $request){

        $EM = $this->getDoctrine()->getManager();//instancier la bd

        $paiement = new paiement();
        $paiement->setIdC($request->get('idC'));
        $paiement->setType($request->get('type'));
        $paiement->setTotal($request->get('total'));
        $paiement->setDate(new \DateTime('now'));

        $EM->persist($paiement);//initialiser l'objet dans la memoire
        $EM->flush();//executer la requête
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($paiement);
        return new JsonResponse($formatted);



    }

    public function AfficherMobileAction()
    {
        $EM =$this->getDoctrine()->getManager();
        $paiements = $EM->getRepository('RestoBundle:paiement')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($paiements);
        return new JsonResponse($formatted);
    }


}

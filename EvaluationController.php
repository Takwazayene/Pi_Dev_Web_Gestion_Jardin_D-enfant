<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\TabReclamation;
use ReclamationBundle\Entity\Evaluation;
use ReclamationBundle\Form\EvaluationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EvaluationController extends Controller
{
    public function affichageAction()
    {
        // return $this->render('@Club/Default/read.html.twig');
        //Fetching Objects (Clubs) from the Database
        $Evaluations=$this->getDoctrine()->getManager()->getRepository(Evaluation::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@Reclamation/Evaluation/affichage.html.twig', array('Evaluations'=>$Evaluations ));

    }
    public function affichage1Action()
    {
        // return $this->render('@Club/Default/read.html.twig');
        //Fetching Objects (Clubs) from the Database
        $Evaluations=$this->getDoctrine()->getManager()->getRepository(Evaluation::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@Reclamation/Evaluation/affichage1.html.twig', array('Evaluations'=>$Evaluations ));

    }
    public function ajoutAction(Request $request)
    {
        $Evaluation = new Evaluation();
        $test = "ajout";
        $form = $this->createForm(EvaluationType::class,$Evaluation);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject("test")
                ->setFrom('ichrak.salhi@esprit.tn', 'ichrak salhi')
                ->setTo('ichrak.salhi@esprit.tn')
                ->setBody("Merci pour votre demande");
            $this->get('mailer')->send($message);

            $em = $this->getDoctrine()->getManager();
            $em->persist($Evaluation);
            $em->flush();

            return $this->redirectToRoute('affichage1');
        }

        return $this->render('@Reclamation/Evaluation/ajout.html.twig', array('form' => $form->createView(), 'test' => $test));
    }

    public function modifierAction( Request $request,$id)
    {
        $Evaluation= new Evaluation();
        $em=$this->getDoctrine()->getManager();
        $Evaluation=$em->getRepository(TabReclamation::class)->find($id);
        $form=$this->createForm(EvaluationType::class,$Evaluation);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('affichage1');
        }

        return $this->render('@Reclamation/Evaluation/modifier.html.twig', array('form' => $form->createView()));
    }
    public function supprimerAction($id)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $Evaluation= $em->getRepository(Evaluation::class)->find($id);
        //remove from the ORM
        $em->remove($Evaluation);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("affichage");
    }

}
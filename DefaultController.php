<?php

namespace ReclamationBundle\Controller;


use ReclamationBundle\Entity\TabReclamation;
use ReclamationBundle\Form\TabReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


use ReclamationBundle\ReclamationBundle;
use ReclamationBundle\Repository\TabReclamationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;




class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ReclamationBundle:Default:index.html.twig');
    }
    public function readAction()
    {
        // return $this->render('@Club/Default/read.html.twig');
        //Fetching Objects (Clubs) from the Database
        $TabReclamations=$this->getDoctrine()->getManager()->getRepository(TabReclamation::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@Reclamation/Default/read.html.twig', array('TabReclamations'=>$TabReclamations ));

    }
    public function read1Action(Request $request)
    {
        // return $this->render('@Club/Default/read.html.twig');
        //Fetching Objects (Clubs) from the Database
        //$TabReclamations=$this->getDoctrine()->getManager()->getRepository(TabReclamation::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM ReclamationBundle:TabReclamation a";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');

        $TabReclamations = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
            //$request->query->getInt('page',1),
           // $request->query->getInt('limit',5)
        );
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@Reclamation/Default/read1.html.twig', array('TabReclamations'=>$TabReclamations ));

    }
    public function createAction(Request $request)
    {
        $TabReclamation = new TabReclamation();
        $test = "ajout";
        $form = $this->createForm(TabReclamationType::class,$TabReclamation);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($TabReclamation);
            $em->flush();
            return $this->redirectToRoute('read1');
        }
        return $this->render('@Reclamation/Default/create.html.twig', array('form' => $form->createView(), 'test' => $test));
    }
    public function updateAction( Request $request,$id)
    {
        $TabReclamation= new TabReclamation();
        $em=$this->getDoctrine()->getManager();
        $TabReclamation=$em->getRepository(TabReclamation::class)->find($id);
        $form=$this->createForm(TabReclamationType::class,$TabReclamation);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('read1');
        }

        return $this->render('@Reclamation/Default/update.html.twig', array('form' => $form->createView()));
    }
    public function deleteAction($id)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $TabReclamation= $em->getRepository(TabReclamation::class)->find($id);
        //remove from the ORM
        $em->remove($TabReclamation);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("read");
    }
    public function trierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nomDemande=$em->getRepository(TabReclamation::class)->trierEff();
        return $this->render('@Reclamation/Default/read.html.twig', array('TabReclamations' => $nomDemande));
    }
    public function trier1Action()
    {
        $em = $this->getDoctrine()->getManager();
        $nomDemande=$em->getRepository(TabReclamation::class)->trierEff();
        return $this->render('@Reclamation/Default/read1.html.twig', array('TabReclamations' => $nomDemande));
    }
   /* public function rechercherAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Tabreclamations=$em->getRepository('ReclamationBundle:TabReclamation')->findAll();
        if ($request->isMethod('POST')){
            $numTelDemande=$request->get('numTelDemande');
            $Tabreclamations=$em->getRepository('ReclamationBundle:TabReclamation')
                ->findBy(array("numTelDemande"=>$numTelDemande));
        };
        return $this->render('@Reclamation/Default/read.html.twig',array(
            'Tabreclamations'=>$Tabreclamations));

    }
*/
    function approvedAction($id){
        $em=$this->getDoctrine()->getManager();
        $am=$this->getDoctrine()->getRepository(TabReclamation::class);
        $rec=$this->getDoctrine()->getRepository(TabReclamation::class)->find($id);
        if($rec->getPrenomDemande()=="Non Approuvée")
        {
            $am->approuver($id,"Approuvée");
        }
        else
        {
            $am->approuver($id,"Non Approuvée");
        }
        return $this->redirectToRoute('read');
    }


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository(Publicites::class)->findEntitiesByString($requestString);
        if(!$entities) {
            $result['entities']['error'] = "aucun resultat trouvé";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }

    public function pdfAction(Request $request )
    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $TabReclamation = $em->getRepository("ReclamationBundle:TabReclamation")
            ->find($id);
        $em = $this->getDoctrine()->getManager();
        $Evaluation = $em->getRepository("ReclamationBundle:Evaluation")
            ->find($id);

        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('@Reclamation/Default/pdf.html.twig',
            array("TabReclamation"=>$TabReclamation,
                "Evaluation"=>$Evaluation))
        ;

        $filename = 'paiementEspece';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"',
            )
        );
    }


}

<?php

namespace DorsafBundle\Controller;

use DorsafBundle\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * Club controller.
 *
 * @Route("club")
 */
class ClubController extends Controller
{


    /**
     * Lists all club entities.
     *
     * @Route("/participate/{id}", name="club_participate")
     * @Method("GET")
     */
    public function participateAction($id){
        $club=$this->getDoctrine()->getManager()->getRepository(Club::class)->find($id);
        $club->setEffectif($club->getEffectif()+1);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('showclb',
            array('club' => $club,'id'=>$id,
                'msg'=>"vous avez participer à ce club",));


    }




    /**
     * Lists all club entities.
     *
     * @Route("/", name="club_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('DorsafBundle:Club')->findAll();
        if($request->isMethod("post"))
        {

            $clubs=$em->getRepository(Club::class)->searchClubs($request->get('search'));
        }


        $qb=$em->createQueryBuilder('a')->select("a")->from("DorsafBundle:Club","a");
        if($request->query->getAlnum("filter")){
            $qb=$qb
                ->where('a.nomClub like :filter ')
                ->setParameter('filter', '%' . $request->query->getAlnum('filter') . '%');
        }







        $remarques = $qb->getQuery();




        $paginator  = $this->get('knp_paginator');


        $clubs = $paginator->paginate(
            $clubs,
            $request->query->get('page',1) /*page number*/,
            $request->query->get('limit',2) /*limit per page*/
        );




        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }




    /**
     * Lists all club entities.
     *
     * @Route("/ind", name="club_ind")
     * @Method("GET")
     */
    public function indAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('DorsafBundle:Club')->findAll();
        if($request->isMethod("post"))
        {

            $clubs=$em->getRepository(Club::class)->searchClubs($request->get('search'));
        }


        $qb=$em->createQueryBuilder('a')->select("a")->from("DorsafBundle:Club","a");
        if($request->query->getAlnum("filter")){
            $qb=$qb
                ->where('a.nomClub like :filter ')
                ->setParameter('filter', '%' . $request->query->getAlnum('filter') . '%');
        }







        $remarques = $qb->getQuery();




        $paginator  = $this->get('knp_paginator');


        $clubs = $paginator->paginate(
            $clubs,
            $request->query->get('page',1) /*page number*/,
            $request->query->get('limit',2) /*limit per page*/
        );




        return $this->render('club/ListClub.html.twig', array(
            'clubs' => $clubs,
        ));
    }

    /**
     * Creates a new club entity.
     *
     * @Route("/new", name="club_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $club = new Club();
        $form = $this->createForm('DorsafBundle\Form\ClubType', $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('club_show', array('id' => $club->getId()));
        }

        return $this->render('club/new.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new club entity.
     *
     * @Route("/Ajout", name="club_Ajout")

     */
    public function AjoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $club = new Club();
        $club->setNomClub($request->get('NomClub')) ;
        $club->setActiviteClub($request->get('ActiviteClub'));
        $club->setEffectif($request->get('Effectif'));
        $em->persist($club);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($club);
        return new JsonResponse($formatted);
        }


    /**
     * Finds and displays a club entity.
     *
     * @Route("/{id}", name="club_show")
     * @Method("GET")
     */
    public function showAction(Club $club,Request $request)
    {
        $deleteForm = $this->createDeleteForm($club);
        $msg=$request->get('msg');
        return $this->render('club/show.html.twig', array(
            'club' => $club,"msg"=>$msg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a club entity.
     *
     * @Route("clb/{id}", name="showclb")
     * @Method("GET")
     */
    public function showClubAction(Club $club,Request $request)
    {
        $deleteForm = $this->createDeleteForm($club);
        $msg=$request->get('msg');
        return $this->render('club/showClub.html.twig', array(
            'club' => $club,"msg"=>$msg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function allAction()
    {
        $clubs = $this->getDoctrine()->getManager()
            ->getRepository('DorsafBundle:Club')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($clubs);
        return new JsonResponse($formatted);
    }



    /**
     * Displays a form to edit an existing club entity.
     *
     * @Route("/{id}/edit", name="club_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $editForm = $this->createForm('DorsafBundle\Form\ClubType', $club);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('club_edit', array('id' => $club->getId()));
        }

        return $this->render('club/edit.html.twig', array(
            'club' => $club,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }
    public function modifAction(Request $request, Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $editForm = $this->createForm('DorsafBundle\Form\ClubType', $club);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($this);
            return new JsonResponse($formatted);
            return $this->redirectToRoute('club_edit', array('id' => $club->getId()));
        }

        return $this->render('club/edit.html.twig', array(
            'club' => $club,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a club entity.
     *
     * @Route("/{id}", name="club_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Club $club)
    {
        $form = $this->createDeleteForm($club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($club);
            $em->flush();
        }

        return $this->redirectToRoute('club_index');
    }
    public function findAction($id)
    {
        $clubs = $this->getDoctrine()->getManager()
            ->getRepository('DorsafBundle:Club')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($clubs);
        return new JsonResponse($formatted);
    }

    /**
     * Creates a form to delete a club entity.
     *
     * @param Club $club The club entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Club $club)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('club_delete', array('id' => $club->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




    public function participerAction($id){
        $club=$this->getDoctrine()->getManager()->getRepository(Club::class)->find($id);
        $club->setEffectif($club->getEffectif()+1);
        $this->getDoctrine()->getManager()->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($club);
        return new JsonResponse($formatted);
        return $this->redirectToRoute('club_show',
            array('club' => $club,'id'=>$id,
                'msg'=>"vous avez participer à ce club",));


    }

}

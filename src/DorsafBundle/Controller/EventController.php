<?php

namespace DorsafBundle\Controller;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AppBundle\Entity\User;
use DorsafBundle\Entity\Event;
use DorsafBundle\Models\MapModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Event controller.
 *
 * @Route("event")
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/", name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('DorsafBundle:Event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Lists all event entities for client.
     *
     * @Route("/evelist", name="event_list")
     * @Method("GET")
     */
    public function evelistAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('DorsafBundle:Event')->findAll();
        return $this->render('event/ListEvent.html.twig', array(
            'events' => $events,
        ));
    }




    /**
     * calendrier
     *
     * @Route("/calendrier",name="event_calendrier")
     * @Method("GET")
     */
    public function AfficherCalendrier()
    {


        return $this->render('event/calendrier.html.twig', array(''));
    }



    /**
     * Creates a new event entity.
     *
     * @Route("/new", name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $event = new Event('', New \DateTime('now'));
        $form = $this->createForm('DorsafBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setDatedebutEvent($event->getDateEvent());
            $event->setDatefinEvent($event->getDateEvent());
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(Event $event,Request $request)
    {
        $deleteForm = $this->createDeleteForm($event);
        $msg=$request->get('msg');
        return $this->render('event/show.html.twig', array(
            'event' => $event,"msg"=>$msg,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a event entity for client.
     *
     * @Route("/event/{id}", name="eve_show")
     * @Method("GET")
     */
    public function showeventAction(Event $event,Request $request)
    {
        $deleteForm = $this->createDeleteForm($event);
        $msg=$request->get('msg');
        return $this->render('event/ShowEvent.html.twig', array(
            'event' => $event,"msg"=>$msg,

        ));
    }



    /**
     * participate to an event
     *
     * @Route("/participate/{id}", name="event_participate")
     * @Method({"GET", "POST"})
     */
    public function participateAction($id){

        $event=$this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);
        $event->setNbrPlaceDispo($event->getNbrPlaceDispo()-1);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('eve_show',
            array('event' => $event,'id'=>$id,
                'msg'=>"vous avez participer à l'evenement",));

    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('DorsafBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     * @Route("/delete/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();


        return $this->redirectToRoute('event_index');
    }


    /**
     * @Route("/map/", name="event_map")
     * @Method("GET")
     */
    public function mapAction(Request $request)
    {

        $id=1;
        return $this->render('event/Map.html.twig',array('id'=>$id));
    }

    /**
     * @Route("/adminmap/", name="admin_map")
     * @Method("GET")
     */
    public function adminmapAction(Request $request)
    {

        $id=1;
        return $this->render('event/Mapadmin.html.twig',array('id'=>$id));
    }

    /**
     * @Route(
     *      "/markers/",
     *      name="getMap"
     * )
     * @Method("GET")
     */
    public function mapJson()
    {
        $liste_trajets= array();
        $liste_trajets=$this->getDoctrine()->getManager()->getRepository(Event::class)->findAll();
        $finallist=array();
        foreach ($liste_trajets as $ls)
        {
            $json = file_get_contents('https://geocoder.ls.hereapi.com/6.2/geocode.json?searchtext='.$ls->getAdresse().'&gen=9&apiKey=CxxCHigH6e2itFdUuYEJdiNCKYOFT2wwtIF2QxxIjiw');
            $obj = json_decode($json);
            $map = new MapModel();
            $map->setLatitude($obj->Response->View[0]->Result[0]->Location->DisplayPosition->Latitude);
            $map->setLongitude($obj->Response->View[0]->Result[0]->Location->DisplayPosition->Longitude);
            $map->setAdresse($ls->getAdresse());
            $map->setNom($ls->getNomEvent());
            $map->setDateEvent($ls->getDateEvent()->format('d-m-Y'));
            array_push($finallist, $map);

        }


        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);

        $dataJson = $serializer->normalize($finallist);

        return new JsonResponse($dataJson);
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function alAction()
    {
        $clubs = $this->getDoctrine()->getManager()
            ->getRepository('DorsafBundle:Event')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($clubs);
        return new JsonResponse($formatted);
    }

    public function AjoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Event('', New \DateTime('now'));
        $event->setNomEvent($request->get('NomEvent')) ;
        $event->setCategorieEvent($request->get('CategorieEvent'));
        $event->setNbrPlaceDispo($request->get('NbrPlaceDispo'));
        $event->setDateEvent($request->get('DateEvent', new \DateTime('now')));
        $event->setDescription($request->get('Description'));
        $event->setAdresse($request->get('Adresse'));
        $em->persist($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function participaAction($id){

        $event=$this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);
        $event->setNbrPlaceDispo($event->getNbrPlaceDispo()-1);
        $this->getDoctrine()->getManager()->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
        return $this->redirectToRoute('event_show',
            array('event' => $event,'id'=>$id,
                'msg'=>"vous avez participer à l'evenement",));

    }

    }

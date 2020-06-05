<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\MapLocation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class MapLocationController extends Controller
{

    /**
     * @Route("/mobile/MapLocation/add", name="mobileMapLocationAdd")
     */
    public function newMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $MapLocation = new MapLocation();
        $MapLocation->setX($request->get('x'));
        $MapLocation->setY($request->get('y'));
        $MapLocation->setId($request->get('id'));

        $em->persist($MapLocation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($MapLocation);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/mobile/MapLocation/all", name="mobileMapLocationAll")
     */
    public function allMobileAction()
    {
        $MapLocation = $this->getDoctrine()->getManager()
            ->getRepository('ReclamationBundle:MapLocation')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($MapLocation);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/mobile/MapLocation/delete", name="mobileMapLocationDelete")
     */


    public function deleteLocationAction(Request $request)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $MapLocation= $em->getRepository(MapLocation::class)->find($request->get('idMapLocation'));
        //remove from the ORM
        $em->remove($MapLocation);
        //update the data base
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($MapLocation);
        return new JsonResponse($formatted);

    }


    /**
     * @Route("/mobile/MapLocation/find/{id}", name="mobileMapLocationFind")
     */
    public function findLocationAction($id)
    {
        $MapLocation = $this->getDoctrine()->getManager()
            ->getRepository('ReclamationBundle:MapLocation')
            ->findBy(['id' => $id]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($MapLocation);
        return new JsonResponse($formatted);
    }

}

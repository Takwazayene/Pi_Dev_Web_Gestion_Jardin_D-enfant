<?php

namespace RestoBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use RestoBundle\Entity\Plat;
use RestoBundle\Entity\Plats;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Plat controller.
 *
 */
class PlatController extends Controller
{
    /**
     * Lists all plat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('RestoBundle:Plat')->findAll();

        return $this->render('plat/index.html.twig', array(
            'plats' => $plats,
        ));
    }

    /**
     * Creates a new plat entity.
     *
     */
    public function newAction(Request $request)
    {
        $plat = new Plat();
        $form = $this->createForm('RestoBundle\Form\PlatType', $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('plat_show', array('id' => $plat->getId()));
        }

        return $this->render('plat/new.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plat entity.
     *
     */
    public function showAction(Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('plat/show.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plat entity.
     *
     */
    public function editAction(Request $request, Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);
        $editForm = $this->createForm('RestoBundle\Form\PlatType', $plat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plat_edit', array('id' => $plat->getId()));
        }

        return $this->render('plat/edit.html.twig', array(
            'plat' => $plat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plat entity.
     *
     */
    public function deleteAction(Request $request, Plat $plat)
    {
        $form = $this->createDeleteForm($plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plat);
            $em->flush();
        }

        return $this->redirectToRoute('plat_index');
    }

    /**
     * Creates a form to delete a plat entity.
     *
     * @param Plat $plat The plat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plat $plat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plat_delete', array('id' => $plat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function updaterateAction(Request $request)
    {
        $rat = new Plat();

        $em = $this->getDoctrine()->getManager();

        $plat = new Plat();
        $rate=$request->get('ratee');
        $note=$request->get('note');
        $idP=$request->get('idP');
        $em = $this->getDoctrine()->getManager();
        $plats = $em->getRepository('RestoBundle:Plats')->find($idP);
        $plats->setNote($note);
        $em->persist($plats);
        $em->persist($plat);
        $em->flush();



       // $matchee = $em->getRepository('MyAppUserBundle:Matchs')->find($idmatch);
        $rat->setRat($rate);
      //  $rat->setPlat($matchee);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rat);
        $em->flush();
        return $this->redirectToRoute('plat_rating');
    }



    public function statAction(){
        $pieChart= new PieChart();
        $em = $this->getDoctrine()->getManager();
        $stades=$em->getRepository('RestoBundle:Plats')->findAll();
        $totalcapacité=0;
        foreach($stades as $stade) {
            $totalcapacité=$totalcapacité+$stade->getNote();
        }
        $data= array();
        $stat=['Stade', 'capaciteStade'];
        $nb=0;
        array_push($data,$stat);
        foreach($stades as $stade) {
            $stat=array();
            array_push($stat,$stade->getNom(),(($stade->getNote()) *100)/$totalcapacité);
            $nb=($stade->getNote() *100)/$totalcapacité;
            $stat=[$stade->getNom(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des plats par note
        ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render(':plats:stat.html.twig', array('piechart' =>
            $pieChart));
    }


}

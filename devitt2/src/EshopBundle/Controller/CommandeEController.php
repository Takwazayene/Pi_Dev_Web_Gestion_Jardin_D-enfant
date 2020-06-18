<?php

namespace EshopBundle\Controller;

use EshopBundle\Entity\CommandeE;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeEController extends Controller
{
    public function ProccedToCheckoutAction(){


        $panelist  = $this->getDoctrine()->getRepository('EshopBundle:LigneCommandeE')->findAllProducts();

        $listligne = $this->getDoctrine()->getRepository('EshopBundle:LigneCommandeE')->findByCmdId();

        $a=array($panelist,$listligne);


        $cmd=new CommandeE();
        $all= $this->getDoctrine()->getRepository('EshopBundle:LigneCommandeE')->getBiggestIDCommandInLigneCommande();

        $id=$all[0];

        $cmd->setId($id);

        $em = $this->getDoctrine()->getManager();


            $em->persist($cmd);
            $em->flush();

        return $this->render('@Eshop/Produit/checkout.html.twig', array('id' => $id,'infoLigne'=>$listligne,'panelist'=>$panelist));

    }

}

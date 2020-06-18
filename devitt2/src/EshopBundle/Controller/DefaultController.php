<?php

namespace EshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EshopBundle:Default:index.html.twig');
    }
    /*************************/
    public function voirPanierAction()
    {

        $panelist  = $this->getDoctrine()->getRepository('EshopBundle:LigneCommandeE')->findAllProducts();

        $listligne = $this->getDoctrine()->getRepository('EshopBundle:LigneCommandeE')->findByCmdId();

        $a=array($panelist,$listligne);

        return $this->render('@Eshop/Produit/panier.html.twig', array('orders' => $panelist,'infoLigne'=>$listligne));

    }
    /*************************/

}

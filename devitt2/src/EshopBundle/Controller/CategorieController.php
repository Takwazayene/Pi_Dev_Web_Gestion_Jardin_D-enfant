<?php

namespace EshopBundle\Controller;

use EshopBundle\Entity\CategorieE;
use EshopBundle\Form\CategorieEType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function ajoutCategorieAction(Request $request ){
        $categ = new CategorieE();
        $form = $this->createForm(CategorieEType::class,$categ);
        $form->handleRequest($request);

        if($form->isSubmitted() ){
            $em=$this->getDoctrine()->getManager();
            $em->persist($categ);
            $em->flush();
        }

        return $this->render("@Eshop/Categorie/gestionC.html.twig",array('form'=>$form->createView()));

    }

    /*********************************************/
    public function afficherCategoryAction()
    {
        $em=$this->getDoctrine()->getManager();
        $tab=$em->getRepository("EshopBundle:CategorieE")->findAll();
        return $this->render('@Eshop/Produit/afficherP.html.twig',array('categorie'=>$tab));
    }
    /*********************************************/
    public function  HelloAction($id)
    {
        $cnx=$this->getDoctrine()->getManager();

        $produits = $this->getDoctrine()
            ->getRepository('EshopBundle:CategorieE')
            ->find($id);


        $cnx->remove($produits);
        $cnx->flush();

        return $this->redirectToRoute('eshop_manageProducts');
    }
    /*********************************************/

}

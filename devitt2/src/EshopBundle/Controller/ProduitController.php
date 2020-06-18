<?php

namespace EshopBundle\Controller;

use EshopBundle\Entity\ProduitE;
use EshopBundle\Form\ProduitEType;

use EventBundle\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;


class ProduitController extends Controller
{

    ////////////////////////////////////
    public function  ajoutProduitAction(Request $request)
    {
        $produit = new ProduitE();
        $form = $this->createForm(ProduitEType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }

        return $this->render("@Eshop/Produit/ajoutP.html.twig", array('form' => $form->createView()));
    }
    /*********************************************/

    public function afficherProduitAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $tab=$em->getRepository("EshopBundle:ProduitE")->findAll();
        $tab2=$em->getRepository("EshopBundle:CategorieE")->findAll();

        $paginator = $this->get('knp_paginator');

        $produit = $paginator->paginate(
            $tab, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        //$request->query->getInt('page',1),
        // $request->query->getInt('limit',5)
        );

        return $this->render('@Eshop/Produit/afficherP.html.twig',array('produit'=>$produit,'categ'=>$tab2));


    }
    /*********************************************/
    public function afficherUnSeulProduitAction(Request $request,$id)
    {

            $produits = $this->getDoctrine()
                ->getRepository('EshopBundle:ProduitE')
                ->find($id);
          //  $produit = $em->getRepository("EshopBundle:ProduitE")->findBy(array('id' => $id));


     //   return $this->render('@Eshop/Produit/afficherSP.html.twig', array('produit'=>$tab));
        //return $this->redirectToRoute("eshop_afficherUnSeulProduit", array('id' => $produits->getId()));
        return $this->render('EshopBundle:Produit:afficherSP.html.twig',['product' => $produits
        ]);

    }
    /************************************************/
    public function getPanelAction()
    {
        $em=$this->getDoctrine()->getManager();
        $tab=$em->getRepository("EshopBundle:ProduitE")->findAll();




        $tab2=$em->getRepository("EshopBundle:CategorieE")->findAll();
        $e1= array();

        $arra= array(0);
        foreach ($e1 as  $tab2)
        {
            $va1=$tab3=$em->getRepository("EshopBundle:CategorieE")->countProductsThatBelongsToThisCategory(13);

            array_push($arra,$va1);
        }


        return $this->render('EshopBundle:Produit:ProduitPanel.html.twig',array('produit'=>$tab,'categ'=>$tab2,'nbpd'=>$arra));
    }
    /********************************************/
    public function salamAction($id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $d=$cnx->getRepository("EshopBundle:ProduitE")->find($id);
        $produits = $this->getDoctrine()
            ->getRepository('EshopBundle:ProduitE')
            ->find($id);
        $cnx->remove($produits);
        $cnx->flush();

        return $this->redirectToRoute('eshop_manageProducts');

    }
    /********************************************/
    public function UpdateProdAction($id)
    {


        $produit = $this->getDoctrine()
            ->getRepository('EshopBundle:ProduitE')
            ->find($id);


        $produit->setLibelle($produit->getLibelle());
        $produit->setDescription($produit->getDescription());
        $produit->setQuantite($produit->getQuantite());
        $produit->setPrix($produit->getPrix());
        $produit->setIdCategorie($produit->getIdCategorie());

        $produit3 = new ProduitE();

        $form = $this->createForm(ProduitEType::class, $produit);


        if ($form->isSubmitted()) {


            $nom = $form['libelle']->getData();
            $description = $form['description']->getData();
            $quantity = $form['quantite']->getData();
            $prix = $form['prix']->getData();
            $img=$form['img']->getData();
            $cat = $form['idCategorie']->getData();

            $produit->setLibelle($nom);
            $produit->setDescription($description);
            $produit->setQuantite($quantity);
            $produit->setPrix($prix);
            $produit->setIdCategorie($cat);
            $produit->setImg($img);



            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }

        return $this->render("@Eshop/Produit/ajoutP.html.twig",array(
            'produits'=>$produit,
            'form'=>$form->createView()
        ));

    }
/*********************************************/
    public function getAccueilAction()
    {
        $em=$this->getDoctrine()->getManager();
        $tab=$em->getRepository("EshopBundle:ProduitE")->findAll();

        $tab2=$em->getRepository("EshopBundle:CategorieE")->findAll();
        $val=$em->getRepository("EshopBundle:ProduitE")->getNbDesProduits();


        return $this->render('EshopBundle:Produit:accueilShop.html.twig',array('produit'=>$tab,'categ'=>$tab2,'val'=>$val));

    }
    /*********************************************/
    public function statAction(){
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb->select('u.quantite as a ,COUNT(u.id) as b')
            ->from('EshopBundle\Entity\ProduitE', 'u')

            ->orderBy('u.quantite')
            ->groupBy('u.idCategorie')

        ;

        $events = $qb->getQuery()->getArrayResult();


        $data = [];
        foreach($events as $e) {

            array_push($data,[$e["a"],(int)$e["b"]]);
        }

        $ob = new Highchart();
        $ob->chart->renderTo('container');
        $ob->chart->type('column');

        $ob->title->text('Taux de inscription par jour');
        $ob->series(array(array("data"=>$data)));

        return $this->render('EshopBundle:Produit:stat.html.twig', [
            'mypiechart' => $ob
        ]);
    }
    /****************************************************/
}

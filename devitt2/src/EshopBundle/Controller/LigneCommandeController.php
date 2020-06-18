<?php

namespace EshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EshopBundle\Entity\LigneCommandeE;

class LigneCommandeController extends Controller
{


    public function ajouterUneLigneAction(Request $request, $id)
    {


            /*$repository = $this->getDoctrine()->getRepository('EshopBundle:CommandeE');
            $idcmd=$repository->lastID();*/

            $all= $this->getDoctrine()->getRepository('EshopBundle:CommandeE')->lastID();


            $var=$request->get("niveau");

            $idcmd=$all[0];

            $prixLigne=$this->getDoctrine()->getRepository('EshopBundle:ProduitE')->getPrixProduitById($id);
            $prixLigne =$prixLigne*$var;

             $lc = new LigneCommandeE();
             $lc->setIdCommande($idcmd->getId());
             $lc->setIdProduit($id);
             $lc->setQuantite($var);
             $lc->setPrixLigne($prixLigne);


                $em = $this->getDoctrine()->getManager();
                $var = $this->getDoctrine()
                        ->getRepository('EshopBundle:ProduitE')
                        ->checkIfProductExistInLigneCommande($idcmd);

                if($var) {
                    $em->persist($lc);
                    $em->flush();
                }

        return $this->redirectToRoute('eshop_afficherUnSeulProduit', array(
            'id' => $id)
        );

    }
    /********************************************/
    public function  deleteLigneAction($id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $produits = $this->getDoctrine()
            ->getRepository('EshopBundle:LigneCommandeE')
            ->find($id);
        $cnx->remove($produits);
        $cnx->flush();

        return $this->redirectToRoute('eshop_voirpanier');

    }
}


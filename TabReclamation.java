/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.models;

/**
 *
 * @author Hp
 */
public class TabReclamation {

   
     private int idDemande;
    private String nomDemande;
    private String prenomDemande;
    private String numTelDemande;
    private String postDemande;
    private String cinDemande;
    private int rating;
   
public TabReclamation() {
    }

public TabReclamation(int idDemande,String nomDemande,String prenomDemande,String numTelDemande,String postDemande,String cinDemande,int rating ){
this.idDemande=idDemande;
this.nomDemande=nomDemande;
this.prenomDemande=prenomDemande;
this.numTelDemande=numTelDemande;
this.postDemande=postDemande;
this.cinDemande=cinDemande;
this.rating=rating;

}
public TabReclamation(String nomDemande,String prenomDemande,String numTelDemande,String postDemande,String cinDemande,int rating ){

this.nomDemande=nomDemande;
this.prenomDemande=prenomDemande;
this.numTelDemande=numTelDemande;
this.postDemande=postDemande;
this.cinDemande=cinDemande;
this.rating=rating;

}

    @Override
    public String toString() {
        return "TabReclamation{" + "idDemande=" + idDemande + ", nomDemande=" + nomDemande + ", prenomDemande=" + prenomDemande + ", numTelDemande=" + numTelDemande + ", postDemande=" + postDemande + ", cinDemande=" + cinDemande + ", rating=" + rating + '}';
    }

    public void setidDemande(int idDemande) {
        this.idDemande = idDemande;
    }

    public void setnomDemande(String nomDemande) {
        this.nomDemande = nomDemande;
    }

    public void setprenomDemande(String prenomDemande) {
        this.prenomDemande = prenomDemande;
    }

    public void setnumTelDemande(String numTelDemande) {
        this.numTelDemande = numTelDemande;
    }

    public void setpostDemande(String postDemande) {
        this.postDemande = postDemande;
    }

    public void setcinDemande(String cinDemande) {
        this.cinDemande = cinDemande;
    }

    public void setRating(int rating) {
        this.rating = rating;
    }

    public int getidDemande() {
        return idDemande;
    }

    public String getnomDemande() {
        return nomDemande;
    }

    public String getprenomDemande() {
        return prenomDemande;
    }

    public String getnumTelDemande() {
        return numTelDemande;
    }

    public String getpostDemande() {
        return postDemande;
    }

    public String getcinDemande() {
        return cinDemande;
    }

    public int getRating() {
        return rating;
    }

    




    
}

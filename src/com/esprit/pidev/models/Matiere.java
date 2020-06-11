/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.models;

/**
 *
 * @author ines
 */
public class Matiere {
    
    
    private int menseignant;
    private int Id_Matiere;
    private String Nom_Matiere;
    private int Coef_Matiere;
    private int Nbre_Heure_Matiere;

    public Matiere(String Nom_Matiere, int Coef_Matiere, int Nbre_Heure_Matiere) {
        this.Nom_Matiere = Nom_Matiere;
        this.Coef_Matiere = Coef_Matiere;
        this.Nbre_Heure_Matiere = Nbre_Heure_Matiere;
    }

 

    @Override
    public String toString() {
        return "Matiere{" + "menseignant=" + menseignant + ", Id_Matiere=" + Id_Matiere + ", Nom_Matiere=" + Nom_Matiere + ", Coef_Matiere=" + Coef_Matiere + ", Nbre_Heure_Matiere=" + Nbre_Heure_Matiere + '}';
    }

    
    public Matiere() {
    }

    
    public Matiere(int menseignant, int Id_Matiere, String Nom_Matiere, int Coef_Matiere, int Nbre_Heure_Matiere) {
        this.menseignant = menseignant;
        this.Id_Matiere = Id_Matiere;
        this.Nom_Matiere = Nom_Matiere;
        this.Coef_Matiere = Coef_Matiere;
        this.Nbre_Heure_Matiere = Nbre_Heure_Matiere;
    }

    
    public int getMenseignant() {
        return menseignant;
    }

    public void setMenseignant(int menseignant) {
        this.menseignant = menseignant;
    }

    public int getId_Matiere() {
        return Id_Matiere;
    }

    public void setId_Matiere(int Id_Matiere) {
        this.Id_Matiere = Id_Matiere;
    }

    public String getNom_Matiere() {
        return Nom_Matiere;
    }

    public void setNom_Matiere(String Nom_Matiere) {
        this.Nom_Matiere = Nom_Matiere;
    }

    public int getCoef_Matiere() {
        return Coef_Matiere;
    }

    public void setCoef_Matiere(int Coef_Matiere) {
        this.Coef_Matiere = Coef_Matiere;
    }

    public int getNbre_Heure_Matiere() {
        return Nbre_Heure_Matiere;
    }

    public void setNbre_Heure_Matiere(int Nbre_Heure_Matiere) {
        this.Nbre_Heure_Matiere = Nbre_Heure_Matiere;
    }
    
    
}

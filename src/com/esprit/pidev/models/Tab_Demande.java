/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.models;

import java.util.Date;

/**
 *
 * @author ines
 */
public class Tab_Demande {
    
    private int Id_Demande;
    private String Nom_Demande;
    private String Prenom_Demande;
    private int Cin_Demande;
    private int Num_Tel_Demande;
    private String CV_Demande;
    private Date dateNaissance;
    private String Etude_Demande;
    private String Poste_Demande;
    private String Etat;
    private int resultat_quiz;
    private int iduser;

    public Tab_Demande(int Id_Demande, String Nom_Demande, String Prenom_Demande, int Cin_Demande, int Num_Tel_Demande, String CV_Demande, Date dateNaissance, String Etude_Demande, String Poste_Demande, String Etat, int resultat_quiz, int iduser) {
        this.Id_Demande = Id_Demande;
        this.Nom_Demande = Nom_Demande;
        this.Prenom_Demande = Prenom_Demande;
        this.Cin_Demande = Cin_Demande;
        this.Num_Tel_Demande = Num_Tel_Demande;
        this.CV_Demande = CV_Demande;
        this.dateNaissance = dateNaissance;
        this.Etude_Demande = Etude_Demande;
        this.Poste_Demande = Poste_Demande;
        this.Etat = Etat;
        this.resultat_quiz = resultat_quiz;
        this.iduser = iduser;
    }

    public Tab_Demande() {
    }

    public Tab_Demande(String Nom_Demande, String Prenom_Demande, int Cin_Demande, int Num_Tel_Demande, String CV_Demande, String Etude_Demande, String Poste_Demande) {
        this.Nom_Demande = Nom_Demande;
        this.Prenom_Demande = Prenom_Demande;
        this.Cin_Demande = Cin_Demande;
        this.Num_Tel_Demande = Num_Tel_Demande;
        this.CV_Demande = CV_Demande;
        this.Etude_Demande = Etude_Demande;
        this.Poste_Demande = Poste_Demande;
    }

  

    @Override
    public String toString() {
        return "Tab_Demande{" + "Id_Demande=" + Id_Demande + ", Nom_Demande=" + Nom_Demande + ", Prenom_Demande=" + Prenom_Demande + ", Cin_Demande=" + Cin_Demande + ", Num_Tel_Demande=" + Num_Tel_Demande + ", CV_Demande=" + CV_Demande + ", dateNaissance=" + dateNaissance + ", Etude_Demande=" + Etude_Demande + ", Poste_Demande=" + Poste_Demande + ", Etat=" + Etat + ", resultat_quiz=" + resultat_quiz + ", iduser=" + iduser + '}';
    }

    public int getId_Demande() {
        return Id_Demande;
    }

    public void setId_Demande(int Id_Demande) {
        this.Id_Demande = Id_Demande;
    }

    public String getNom_Demande() {
        return Nom_Demande;
    }

    public void setNom_Demande(String Nom_Demande) {
        this.Nom_Demande = Nom_Demande;
    }

    public String getPrenom_Demande() {
        return Prenom_Demande;
    }

    public void setPrenom_Demande(String Prenom_Demande) {
        this.Prenom_Demande = Prenom_Demande;
    }

    public int getCin_Demande() {
        return Cin_Demande;
    }

    public void setCin_Demande(int Cin_Demande) {
        this.Cin_Demande = Cin_Demande;
    }

    public int getNum_Tel_Demande() {
        return Num_Tel_Demande;
    }

    public void setNum_Tel_Demande(int Num_Tel_Demande) {
        this.Num_Tel_Demande = Num_Tel_Demande;
    }

    public String getCV_Demande() {
        return CV_Demande;
    }

    public void setCV_Demande(String CV_Demande) {
        this.CV_Demande = CV_Demande;
    }

    public Date getDateNaissance() {
        return dateNaissance;
    }

    public void setDateNaissance(Date dateNaissance) {
        this.dateNaissance = dateNaissance;
    }

    public String getEtude_Demande() {
        return Etude_Demande;
    }

    public void setEtude_Demande(String Etude_Demande) {
        this.Etude_Demande = Etude_Demande;
    }

    public String getPoste_Demande() {
        return Poste_Demande;
    }

    public void setPoste_Demande(String Poste_Demande) {
        this.Poste_Demande = Poste_Demande;
    }

    public String getEtat() {
        return Etat;
    }

    public void setEtat(String Etat) {
        this.Etat = Etat;
    }

    public int getResultat_quiz() {
        return resultat_quiz;
    }

    public void setResultat_quiz(int resultat_quiz) {
        this.resultat_quiz = resultat_quiz;
    }

    public int getIduser() {
        return iduser;
    }

    public void setIduser(int iduser) {
        this.iduser = iduser;
    }

    
    
    
    
}

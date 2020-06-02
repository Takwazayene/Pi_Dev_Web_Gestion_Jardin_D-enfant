/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.models;
import java.util.Date;
import java.lang.String;

/**
 *
 * @author Hp
 */
public class Evaluation {
    
     private int id;
    private String reclamation_id;
    private Date datee;
    private String note;
    
    
 public Evaluation() {
        
    }

    public Evaluation(int id, String reclamation_id, Date datee, String note) {
        this.id = id;
        this.reclamation_id = reclamation_id;
        this.datee = datee;
        this.note = note;
    }

    public Evaluation(String reclamation_id, Date datee, String note) {
        this.reclamation_id = reclamation_id;
        this.datee = datee;
        this.note = note;
    }

    public Evaluation(int id, String note) {
                this.id = id;

      //  this.datee = datee;
        this.note = note;
        
    }
      public Evaluation( String note) {
                //this.id = id;

      //  this.datee = datee;
        this.note = note;
        
    }


    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getReclamationId() {
        return reclamation_id;
    }

    public void setReclamationId(String reclamation_id) {
        this.reclamation_id = reclamation_id;
    }

    public Date getDatee() {
        return datee;
    }

    public void setDatee(Date datee) {
        this.datee = datee;
    }

   
    public String getNote() {
        return note;
    }

    public void setNote(String note) {
        this.note = note;
    }

    @Override
    public String toString() {
        return "Evaluation{" + "id=" + id + ", reclamation_id=" + reclamation_id + ", datee=" + datee + ", note=" + note + '}';
    }
 
 

}

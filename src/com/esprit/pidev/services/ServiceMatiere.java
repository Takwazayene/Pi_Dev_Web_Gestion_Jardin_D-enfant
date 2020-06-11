/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.esprit.pidev.models.Matiere;
import com.esprit.pidev.models.Tab_Demande;
import com.esprit.pidev.models.Task;
import com.esprit.pidev.utils.DataSource;
import com.esprit.pidev.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

/**
 *
 * @author ines
 */
public class ServiceMatiere {
    
    public ArrayList<Matiere> matieres;
    
    private ConnectionRequest request;

    private boolean responseResult;
    //public ArrayList<Tab_> matieres;

    public ServiceMatiere() {
        request = DataSource.getInstance().getRequest();
    }
    public ArrayList<Matiere> parseMatieres(String jsonText) {
        try {
            matieres = new ArrayList<>();

            JSONParser jp = new JSONParser();
            Map<String, Object> matieresListJson = jp.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            List<Map<String, Object>> list = (List<Map<String, Object>>) matieresListJson.get("root");
            for (Map<String, Object> obj : list) {
//                int menseignant = (int)Float.parseFloat(obj.get("menseignant").toString());
//                int Id_Matiere = (int)Float.parseFloat(obj.get("Id_Matiere").toString());
                String Nom_Matiere = obj.get("nomMatiere").toString();
                int Coef_Matiere = (int)Float.parseFloat(obj.get("coefMatiere").toString());
                int Nbre_Heure_Matiere = (int)Float.parseFloat(obj.get("nbreHeureMatiere").toString());
                matieres.add(new Matiere(Nom_Matiere,Coef_Matiere, Nbre_Heure_Matiere));
            }

        } catch (IOException ex) {
        }

        return matieres;
    }
public ArrayList<Matiere> getAllMatieres() {
        String url = Statics.BASE_URL + "/affichageMobile";

        request.setUrl(url);
        request.setPost(false);
        request.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                matieres = parseMatieres(new String(request.getResponseData()));
                request.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(request);

        return matieres;
    }
   public ArrayList<Matiere> Recherche(String nomMatiere){        
        ConnectionRequest con = new ConnectionRequest();
        con.setUrl( "http://localhost/devitt2/web/app_dev.php/findMobile/"+nomMatiere);  
        con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                ServiceMatiere ser = new ServiceMatiere();
                matieres = ser.parseMatieres(new String(con.getResponseData()));
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
        return matieres;
    }
    public ArrayList<Matiere> Tri(){        
        ConnectionRequest con = new ConnectionRequest();
        con.setUrl( "http://localhost/devitt2/web/app_dev.php/tasks/tri");  
        con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                ServiceMatiere ser = new ServiceMatiere();
                matieres = ser.parseMatieres(new String(con.getResponseData()));
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
        return matieres;
    }
}

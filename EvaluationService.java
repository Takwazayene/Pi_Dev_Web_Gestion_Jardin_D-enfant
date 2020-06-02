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
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.events.ActionListener;
import com.esprit.pidev.models.TabReclamation;
import com.esprit.pidev.models.Evaluation;
import com.esprit.pidev.utils.DataSource;
import com.esprit.pidev.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;

/**
 *
 * @author Hp
 */
public class EvaluationService {
    
     private ConnectionRequest request;

    private boolean responseResult;
    public ArrayList<Evaluation> tasks;

    public EvaluationService() {
        request = DataSource.getInstance().getRequest();
    }
  /*  public void addTask1 (int reclamation_id,String note) {
        ConnectionRequest con = new ConnectionRequest();
        String Url = "http://localhost/devitt2/web/app_dev.php/reclamation_api/ajoutMobile?note=" + note + 
                "&reclamation_id=" + reclamation_id;// création de l'URL
        con.setUrl(Url);
        con.addResponseListener((NetworkEvent evt) -> {
            String str = new String(con.getResponseData());
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
    }*/
    
  

    
    public boolean addTask1(Evaluation task) {
        String url = Statics.BASE_URL + "reclamation_api/ajoutMobile?note=" + task.getNote()
               
                +"$datee"+ task.getDatee();
               
        request.setUrl(url);
        request.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                responseResult = request.getResponseCode() == 200; // Code HTTP 200 OK
                request.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(request);

        return responseResult;
    }

    public ArrayList<Evaluation> getAllTasks() {
        String url = Statics.BASE_URL + "reclamation_api/affichageMobile";

        request.setUrl(url);
        request.setPost(false);
        request.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                tasks = parseTasks(new String(request.getResponseData()));
                request.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(request);

        return tasks;
    }

  /*  public ArrayList<Evaluation> parseTasks(String jsonText) {
        try {
            tasks = new ArrayList<>();

            JSONParser jp = new JSONParser();
            Map<String, Object> tasksListJson = jp.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            List<Map<String, Object>> list = (List<Map<String, Object>>) tasksListJson.get("root");
            for (Map<String, Object> obj : list) {
                
                 
                ReclamationService e =new ReclamationService();
                
                
                float id = Float.parseFloat(obj.get("id").toString());
                String note = obj.get("note").toString();
            // String reclamation_id = obj.get("reclamation_id").toString();

               // float reclamation_id = Float.parseFloat(obj.get("reclamation_id").toString());
               // String datee = obj.get("datee").toString();
                
               //  e.setReclamation_id(obj.get("reclamation_id").toString());
                

               // System.out.println(e);
                
           // tasks.add(e); 
                                
                

                System.out.println(e);
                 System.out.println(tasks);
        return tasks;
              
             

               
               // tasks.add(new Evaluation(id, note,Id_demande));
            }

        } catch (IOException ex) {
        }

        return tasks;
    }
    */
    
    //////////
    public ArrayList<Evaluation> parseTasks(String jsonText){
        try {
            tasks=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> clubsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)clubsListJson.get("root");
            for(Map<String,Object> obj : list){
                Evaluation t = new Evaluation();
                float id = Float.parseFloat(obj.get("id").toString());
                t.setId((int)id);
                t.setNote(obj.get("note").toString());
               // t.setReclamationId(obj.get("reclamationId").toString());
              //  t.setDescription(obj.get("description").toString());
                //t.setDate_fondation(((Date)format.parse(obj.get("date_fondation").toString())));
               // t.setNbmembres(((int)Float.parseFloat(obj.get("nbmembres").toString())));
               /// t.setResponsable(obj.get("responsable").toString());
               // t.setLogo(obj.get("logo").toString());
               // t.setLienfacebook(obj.get("lienfacebook").toString());
               //////////////////////////Affichage Date////////////////
                        Map<String, Object> date = null;
                       date = (Map<String, Object>) obj.get("datee");
                    
                       try {

                          Date longdate = new Date((long) Float.parseFloat(date.get("timestamp").toString()) * 1000);
                             

                            System.out.println("*************" + longdate);
                            SimpleDateFormat formatter = new SimpleDateFormat("dd-MM-yyyy ");

                            String d = formatter.format(longdate);
                            t.setDatee(longdate);
                        } catch (NumberFormatException ex) {

                        }

                      
               
               
               
               
               
               
               
                tasks.add(t);
            }
            
            
        } catch (IOException ex) {
            
        }
        return tasks;
    }
    
    
    
    
    
    
    
    
    
    
    
    
}

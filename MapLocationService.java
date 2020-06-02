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
import com.esprit.pidev.models.MapLocation;

//import entity.TraitementMedical;
//import entity.User;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

/**
 *
 * @author autonome
 */
public class MapLocationService {

    public MapLocationService() {
    }
    
    public void addLocation(MapLocation ml ) {
        //  http://localhost/3A11/happy_olds/web/app_dev.php/mobile/traitement/
        //  ajouter?id=3&nomMedicament=medicmnt%20Abc&traitementDesc=3%20Comprimee&duree=40&dejeuner=avant&petitDejeuner=non&diner=non
        ConnectionRequest con = new ConnectionRequest();
        String Url = "http://localhost/devitt2/web/app_dev.php/reclamation_api/newMobile?x="
               
             +ml.getX()
                +"&y=" +ml.getY();
                
        con.setUrl(Url);

            con.addResponseListener((e) -> {
            String str = new String(con.getResponseData());
            //System.out.println(str);

        });
        NetworkManager.getInstance().addToQueueAndWait(con);
    }
    
    
    ArrayList<MapLocation> listLocation ;
    
    public ArrayList<MapLocation> getAllLocations() {
        listLocation = new ArrayList<>()  ;
        ConnectionRequest con = new ConnectionRequest();
        con.setUrl("http://localhost/devitt2/web/app_dev.php/reclamation_api/allMobile");
        con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                listLocation = subGetAllLocations(new String(con.getResponseData()));

            }
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
        return listLocation;
    }
    
    
    public ArrayList<MapLocation> subGetAllLocations(String json) {

        ArrayList<MapLocation> u = new ArrayList<>();

        try {
            JSONParser j = new JSONParser();

            Map<String, Object> p = j.parseJSON(new CharArrayReader(json.toCharArray()));
            System.out.println("__________p to string"+p.toString());
            List<Map<String, Object>> list = (List<Map<String, Object>>) p.get("root");
            for (Map<String, Object> obj : list) {
                float x = Float.parseFloat(obj.get("x").toString());
                float y = Float.parseFloat(obj.get("y").toString());
                float id = Float.parseFloat(obj.get("id").toString());

                MapLocation ml = new MapLocation ();
                ml.setX((int)x);
                ml.setY((int)y);
                ml.setId((int) id);
                u.add(ml);
            }

        } catch (Exception ex) {
        }
        return u;

    }
    
    
 /*   public ArrayList<MapLocation> getAllLocationsOfUser() {
        listLocation = new ArrayList<>()  ;
        ConnectionRequest con = new ConnectionRequest();
        con.setUrl("http://localhost/3A11/happy_olds/web/app_dev.php/mobile/MapLocation/find/"+agee.getId());
        con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                listLocation = subGetAllLocationsOfUser(new String(con.getResponseData()), agee);

            }
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
        return listLocation;
    }*/
    
    
    public ArrayList<MapLocation> subGetAllLocationsOfUser(String json ) {

        ArrayList<MapLocation> u = new ArrayList<>();

        try {
            JSONParser j = new JSONParser();

            Map<String, Object> p = j.parseJSON(new CharArrayReader(json.toCharArray()));
            System.out.println("__________p to string"+p.toString());
            List<Map<String, Object>> list = (List<Map<String, Object>>) p.get("root");
            System.out.println("avant for _____________________");
            for (Map<String, Object> obj : list) {
                System.out.println("dans for __________________");
                float x = Float.parseFloat(obj.get("x").toString());
                System.out.println("__________x__________ "+x);
                float y = Float.parseFloat(obj.get("y").toString());
                System.out.println("__________y__________ "+y);
                
                
                MapLocation ml = new MapLocation ();
                ml.setX((int)x);
                ml.setY((int)y);
                //ml.setY((int)id);
               // ml.setIdAgee(agee.getId());
                u.add(ml);
                System.out.println("ml sout mapservice: " +ml.toString());
            }

        } catch (Exception ex) {
            System.out.println("dans ex _-_-_-_-_-_-_-_-_-_-_-_-_-_-_-");
        }
        return u;

    }
    
    
    
}

package com.esprit.pidev.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.esprit.pidev.models.Tab_Demande;
import com.esprit.pidev.utils.DataSource;
import com.esprit.pidev.utils.Statics;
import com.codename1.sendgrid.SendGrid;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;


/**
 *
 * @author bhk
 */
public class ServiceDemande {

    public ArrayList<Tab_Demande> demandes;
    
    private ConnectionRequest request;

    private boolean responseResult;
    //public ArrayList<Tab_> demandes;

    public ServiceDemande() {
        request = DataSource.getInstance().getRequest();
    }

    

    
    
    public boolean addDemande(Tab_Demande t) {
        String url = Statics.BASE_URL + "/newDemande?nomDemande="+t.getNom_Demande()+"&prenomDemande="+t.getPrenom_Demande()+"&cinDemande="+t.getCin_Demande()+"&numTelDemande="+t.getNum_Tel_Demande()+"&cVDemande="+t.getCV_Demande()+"&etudeDemande="+t.getEtude_Demande()+"&posteDemande="+t.getPoste_Demande();

        request.setUrl(url);
        request.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                responseResult = request.getResponseCode() == 200; // Code HTTP 200 OK
                request.removeResponseListener(this);
                SendGrid s = SendGrid.create("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");
//        SendGrid s = SendGrid.create("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");
        s.sendSync("ines.lachiheb@esprit.tn"
                , "ines.lachiheb@esprit.tn"
                , "DEMANDE ACCEPTER"
                , "VOTRE DEMANDE A ETE ACCEPTER"       );
        System.out.println("ajout avec succés ");




            }
        });
        NetworkManager.getInstance().addToQueueAndWait(request);

        return responseResult;
    }

    public ArrayList<Tab_Demande> parseDemandes(String jsonText){
        try {
            demandes=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> demandesListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)demandesListJson.get("root");
            for(Map<String,Object> obj : list){
                Tab_Demande t = new Tab_Demande();
                float Id_Demande = Float.parseFloat(obj.get("Id_Demande").toString());
                t.setId_Demande((int)Id_Demande);
                t.setNom_Demande(obj.get("Nom_Demande").toString());
                t.setPrenom_Demande(obj.get("Prenom_Demande").toString());
                
                float Cin_Demande = Float.parseFloat(obj.get("Cin_Demande").toString());
                t.setCin_Demande((int)Cin_Demande);
                float Num_Tel_Demande = Float.parseFloat(obj.get("Num_Tel_Demande").toString());
                t.setNum_Tel_Demande((int)Num_Tel_Demande);
                
                t.setCV_Demande(obj.get("CV_Demande").toString());
                
                t.setEtude_Demande(obj.get("Etude_Demande").toString());
                
                t.setPoste_Demande(obj.get("Poste_Demande").toString());
                
                

                
          
                
                demandes.add(t);
            }
            
            
        } catch (IOException ex) {
            
        }
        return demandes;
    }
    
    
      
        
}
    
    

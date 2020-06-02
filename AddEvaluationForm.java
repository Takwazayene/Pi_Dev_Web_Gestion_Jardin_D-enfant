/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.forms;

import com.codename1.components.ImageViewer;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import com.codename1.l10n.DateFormat;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.notifications.LocalNotification;
import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.spinner.Picker;
import com.esprit.pidev.models.Evaluation;
import com.esprit.pidev.models.TabReclamation;
import com.esprit.pidev.services.EvaluationService;
import com.esprit.pidev.services.ReclamationService;
import com.esprit.pidev.utils.SMSAPI;
import java.io.IOException;
import java.util.Date;
//import codename1.scene.control.Alert;
/**
 *
 * @author Hp
 */
public class AddEvaluationForm extends Form {
     public AddEvaluationForm(Form previous) {
        super("Add a new task", BoxLayout.y());
        
        
        
          LocalNotification n;
    

        TextField tfNote = new TextField(null, "note");
        TextField tfReclamationId = new TextField(null, "reclamationId");
       // TextField tfDatee = new TextField(null, "datee");
        
        Picker datee = new Picker();
        

        Button btn = new Button("Add the task");
        
        
          try {
                ImageViewer IV = new ImageViewer(Image.createImage("/m777.jpg"));
//                IV.Fares
                this.getAllStyles().setBgImage(IV.getImage());
                
            } catch (IOException ex) {
            }
          
          
                   Label totalLabel5 = new Label();
                    Label totalLabel6 = new Label();
         Label totalLabel3 = new Label();
                   ConnectionRequest con = new ConnectionRequest();
        con.setUrl("http://localhost/devitt2/web/app_dev.php/reclamation_api/gettotalperMobile2");  
        con.addResponseListener((e) -> {
               
              String str = new String(con.getResponseData());//Récupération de la réponse du serveur
            System.out.println(str);
             totalLabel5.setText("******************** ");
            totalLabel6.setText(" Moyenne des note remis au meme date ! ");
             totalLabel5.setText(" :"+str+"");
        });
        
        
        NetworkManager.getInstance().addToQueueAndWait(con);
       
                
        
         
        
        
          n = new LocalNotification();
        btn.addActionListener((evt) -> {
            if ((tfNote.getText().length() == 0) || (tfReclamationId.getText().length() == 0)
                     || (datee.getText().length() == 0)
                    
                    ) {
                Dialog.show("Alert", "Please fill all the fields", "OK", null);
            } else {
                try {
                    DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss.SSS");
      Date datecreation = new Date(System.currentTimeMillis());



                    Evaluation t = new Evaluation (tfNote.getText()
                    , datee.getDate()
                    , tfReclamationId.getText()
                   
                    );
                    if (new EvaluationService().addTask1(t)) {
                       
     
                        Dialog.show("SUCCESS", "Task sent", "OK", null);
                   // SMSAPI sms = new SMSAPI("Votre evaluation est remis avec succes la noye attribuer est :  "+tfNote.getText()+"  mercii   ", "+21652272411");
   n.setId("demo-notification");
        n.setAlertBody("It's time to take a break and look at me");
        n.setAlertTitle("Break Time!");
      //  n.setAlertSound("/notification_sound_juntos.mp3"); //file name must begin with notification_sound

System.out.println("ok");
        Display.getInstance().scheduleLocalNotification(
                
              
                n,
                System.currentTimeMillis() + 10 * 1000, // fire date/time
                LocalNotification.REPEAT_MINUTE  // Whether to repeat and what frequency
        );
        System.out.println("ok");
                    } else {
                        Dialog.show("ERROR", "Server error", "OK", null);
                    }
                } catch (NumberFormatException e) {
                    Dialog.show("ERROR", "Status must be a number", "OK", null);
                }

            }
        });
        
        
        
        
        
        
        

      /*  btn.addActionListener((evt) -> {
            if ((tfNote.getText().length() == 0) || (tfNote.getText().length() == 0)
                     
                    ) {
                Dialog.show("Alert", "Please fill all the fields", "OK", null);
            } else {
                try {
                    Evaluation t = new Evaluation(tfNote.getText()  
                            ,tfDatee.getText()  
                    );
                    if (new EvaluationService().addTask1(t)) {
                        Dialog.show("SUCCESS", "Task sent", "OK", null);
                    SMSAPI sms = new SMSAPI("marekkk  "+tfNote.getText()+"  mgalbaaa  ", "+21652272411");

                    } else {
                        Dialog.show("ERROR", "Server error", "OK", null);
                    }
                } catch (NumberFormatException e) {
                    Dialog.show("ERROR", "Status must be a number", "OK", null);
                }

            }
        });*/
        
        
        

        this.addAll(tfNote,datee,tfReclamationId, btn);

        this.getToolbar().addCommandToLeftBar("Return", null, (evt) -> {
            previous.showBack();
        });
    
        
        
         Toolbar tb = this.getToolbar();
        Toolbar.setGlobalToolbar(true);
        
                  this.add(totalLabel5);
                  this.add(totalLabel6);

    
}
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.forms;

import com.codename1.components.ImageViewer;
import com.codename1.messaging.Message;
import com.codename1.notifications.LocalNotification;
import com.codename1.ui.Button;
import com.codename1.ui.Component;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.table.TableLayout;
import com.codename1.ui.util.Resources;
import com.esprit.pidev.models.TabReclamation;
import com.esprit.pidev.services.ReclamationService;
import com.esprit.pidev.utils.SMSAPI;
import java.io.IOException;

/**
 *
 * @author Hp
 */
public class AddReclamationForm extends SideMenuBaseForm {
    
    
     public AddReclamationForm(Resources res) {
        //super("Add a new task", BoxLayout.y());
        
         LocalNotification n;
    
Button cam = new Button("Open camera");

 /* try {
                ImageViewer IV = new ImageViewer(Image.createImage("/m777.jpg"));
//                IV.Fares
                this.getAllStyles().setBgImage(IV.getImage());
                
            } catch (IOException ex) {
            }*/
        

   
        TableLayout tl;
int spanButton = 2;
if(Display.getInstance().isTablet()) {
    tl = new TableLayout(7, 2);
} else {
    tl = new TableLayout(14, 1);
    spanButton = 1;
}
tl.setGrowHorizontally(true);
//hi.setLayout(tl);


        TextField tfNom_Demande = new TextField(null, "Nom_Demande");
        TextField tfPrenom_Demande = new TextField(null, "Prenom_Demande (0 or 1)");
        TextField tfNum_Tel_Demande = new TextField(null, "num tel");
        TextField tfPost_Demande = new TextField(null, "post");
        TextField tfCin_Demande = new TextField(null, "cin");
        TextField tfrating = new TextField(null, "rating");

        Button btn = new Button("Add the task");
         n = new LocalNotification();

        btn.addActionListener((evt) -> {
            if ((tfNom_Demande.getText().length() == 0) || (tfPrenom_Demande.getText().length() == 0)
                     || (tfNum_Tel_Demande.getText().length() == 0)
                     || (tfPost_Demande.getText().length() == 0)
                     || (tfCin_Demande.getText().length() == 0)
                     || (tfrating.getText().length() == 0)
                    ) {
                
                
                Dialog.show("Alert", "Please fill all the fields", "OK", null);
                
                 n.setId("demo-notification");
                      System.out.println("ok1");
        n.setAlertBody("It's time to take a break and look at me");
             System.out.println("ok2");
        n.setAlertTitle("Break Time!");
             System.out.println("ok3");
        // n.setAlertBody(.getString("NOTIF_BODY"));
       n.setAlertSound("/notification_sound_juntos.mp3"); //file name must begin with notification_sound

System.out.println("ok4");
        Display.getInstance().scheduleLocalNotification(
                
              
                n,
                System.currentTimeMillis() + 10 * 10000, // fire date/time
                LocalNotification.REPEAT_MINUTE  // Whether to repeat and what frequency
                
        );
        System.out.println("ok5");
                
                
             
            } else {
                try {
                    TabReclamation t = new TabReclamation(tfNom_Demande.getText()
                    , tfPrenom_Demande.getText()
                    , tfNum_Tel_Demande.getText()
                    , tfPost_Demande.getText()
                    , tfCin_Demande.getText()
                    ,Integer.parseInt(tfrating.getText()));
                    if (new ReclamationService().addTask(t)) {
                        Dialog.show("SUCCESS", "Task sent", "OK", null);
                 
                      Message m = new Message("votre reclamation sera traité dans les plus bref délais ");
//m.getAttachments().put(textAttachmentUri, "text/plain");
//m.getAttachments().put(imageAttachmentUri, "image/png");
Display.getInstance().sendMessage(new String[] {"ichrak.salhi@esprit.tn"}, "Subject of message", m); 
                        
                        
                        
                        SMSAPI sms = new SMSAPI(" Merci mdm/ms : "+tfPrenom_Demande.getText()+" d'avoir passer cette reclamation dont le suijet est : "+tfPost_Demande.getText()+"   Merci bien !!  ", "+21652272411");
     n.setId("demo-notification");
        n.setAlertBody("It's time to take a break and look at me");
        n.setAlertTitle("Break Time!");
        // n.setAlertBody(.getString("NOTIF_BODY"));
       n.setAlertSound("/notification_sound_juntos.mp3"); //file name must begin with notification_sound

System.out.println("ok");
        Display.getInstance().scheduleLocalNotification(
                
              
                n,
                System.currentTimeMillis() + 10 * 10000, // fire date/time
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
        
        
        

        this.addAll(tfNom_Demande, tfPrenom_Demande,tfNum_Tel_Demande,tfPost_Demande,tfCin_Demande,tfrating, btn);

        this.getToolbar().addCommandToLeftBar("Return", null, (evt) -> {
           // previous.showBack();
        });
    
        
        
         Toolbar tb = this.getToolbar();
        Toolbar.setGlobalToolbar(true);
        
        
        TableLayout.Constraint cn = tl.createConstraint();
cn.setHorizontalSpan(spanButton);
cn.setHorizontalAlign(Component.RIGHT);
         cam.addActionListener((e) -> {
           
            //cameraForm f=new cameraForm();
          //  f.init(cn);
          //  f.start();
        });
        this.add(cam);
         
  
        }
      public void localNotificationReceived(String notificationId) {
        System.out.println("Received local notification "+notificationId);    
    }
      private Image createCircleLine(int color, int height, boolean first) {
        Image img = Image.createImage(height, height, 0);
        Graphics g = img.getGraphics();
        g.setAntiAliased(true);
        g.setColor(0xcccccc);
        int y = 0;
        if(first) {
            y = height / 6 + 1;
        }
        g.drawLine(height / 2, y, height / 2, height);
        g.drawLine(height / 2 - 1, y, height / 2 - 1, height);
        g.setColor(color);
        g.fillArc(height / 2 - height / 4, height / 6, height / 2, height / 2, 0, 360);
        return img;
    }
    
    public boolean estUnEntier(String chaine) {
		try {
			Integer.parseInt(chaine);
		} catch (NumberFormatException e){
			return false;
		}
 
		return true;
	}
    
    

    @Override
    protected void showOtherForm(Resources res) {
        new StatsForm(res).show();
    }



   /* @Override
    protected void showOtherForm(Resources res) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }*/

    
}

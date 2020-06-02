/*
 * Copyright (c) 2016, Codename One
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions 
 * of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
 */

package com.esprit.pidev.forms;
import com.codename1.components.FloatingActionButton;
import com.codename1.components.MultiButton;
import com.codename1.messaging.Message;
import com.codename1.notifications.LocalNotification;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import static com.codename1.ui.Component.RIGHT;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Font;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.list.GenericListCellRenderer;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.util.Resources;

import static java.lang.Integer.parseInt;
import java.util.Map;
import java.lang.String;
import java.util.ArrayList;
import java.util.List;
//import javafx.scene.control.Alert;
import com.esprit.pidev.models.TabReclamation;
import com.esprit.pidev.services.ReclamationService;
import com.esprit.pidev.utils.SMSAPI;

////
import com.codename1.components.FloatingActionButton;
import com.codename1.components.MultiButton;
import com.codename1.components.ToastBar;
import com.codename1.l10n.DateFormat;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.messaging.Message;
import com.codename1.notifications.LocalNotification;
import com.codename1.ui.Button;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Font;
import com.codename1.ui.FontImage;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.spinner.Picker;
import com.codename1.ui.table.TableLayout;
import com.codename1.ui.util.Resources;
import com.esprit.pidev.models.Evaluation;
import com.esprit.pidev.models.TabReclamation;
import com.esprit.pidev.services.EvaluationService;
import com.esprit.pidev.services.ReclamationService;
import com.esprit.pidev.utils.SMSAPI;
import java.util.Date;

/**
 * Represents a user profile in the app, the first form we open after the walkthru
 *
 * @author Shai Almog
 */
public class AddEvaluationForm1 extends SideMenuBaseForm {
    
    
   
    LocalNotification n; 
  
    Container ajoutCont ;
            
    // TextField tfNote = new TextField(null, "note");
        //TextField tfReclamationId = new TextField(null, "reclamationId");
  
    TextField tfNote  ;
    TextField tfReclamationId  ;
    Picker datee;
    
   
    
    Button btnDetail ;
    
    Button [] btnTab ;
    int [] intBtnTab ;
  
    
    int [] tabColeur = {0xd997f1,0x5ae29d,0x4dc2ff} ;

    public AddEvaluationForm1(Resources res) {
        
      super(BoxLayout.y());
         this.setLayout(BoxLayout.y());
         
        Toolbar tb = getToolbar();
        tb.setTitleCentered(false);
        Image profilePic = res.getImage("user-picture.jpg");
        Image mask = res.getImage("round-mask.png");
        profilePic = profilePic.fill(mask.getWidth(), mask.getHeight());
        Label profilePicLabel = new Label(profilePic, "ProfilePicTitle");
        profilePicLabel.setMask(mask.createMask());

        Button menuButton = new Button("");
        menuButton.setUIID("Title");
        FontImage.setMaterialIcon(menuButton, FontImage.MATERIAL_MENU);
        menuButton.addActionListener(e -> getToolbar().openSideMenu());
        
       Container remainingTasks = BoxLayout.encloseY(
                        new Label("12", "CenterTitle"),
                        new Label("remaining tasks", "CenterSubTitle")
                );
        remainingTasks.setUIID("RemainingTasks");
        Container completedTasks = BoxLayout.encloseY(
                        new Label("32", "CenterTitle"),
                        new Label("completed tasks", "CenterSubTitle")
        );
        completedTasks.setUIID("CompletedTasks");

        Container titleCmp = BoxLayout.encloseY(
                        FlowLayout.encloseIn(menuButton),
                        BorderLayout.centerAbsolute(
                                BoxLayout.encloseY(
                                    new Label("Espace Reclamation", "Title"),
                                    new Label("Salhi ichrak", "SubTitle")
                                )
                            ).add(BorderLayout.WEST, profilePicLabel),
                        GridLayout.encloseIn(2, remainingTasks, completedTasks)
                );
        
        FloatingActionButton fab = FloatingActionButton.createFAB(FontImage.MATERIAL_ADD);
        fab.getAllStyles().setMarginUnit(Style.UNIT_TYPE_PIXELS);
        fab.getAllStyles().setMargin(BOTTOM, completedTasks.getPreferredH() - fab.getPreferredH() / 2);
        tb.setTitleComponent(fab.bindFabToContainer(titleCmp, CENTER, BOTTOM));
                        
        //add(new Label("Today", "TodayTitle"));
        
        FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);
      
      
        
       // tfNote = new TextField("", "Nom", 20, TextField.EMAILADDR) ;
        tfNote = new TextField("", "nom", 10, TextField.EMAILADDR) ;
        tfReclamationId = new TextField("", "prenom", 20, TextField.EMAILADDR) ;
        Picker datee = new Picker();
        
        Button Enregistrer = new Button("Enregistrer");
        Enregistrer.setUIID("LoginButton");
        
        n = new LocalNotification();
        n.setId("demo-notification");
        n.setAlertBody("It's time to take a break and look at me");
        n.setAlertTitle("Break Time!");
        n.setAlertSound("/notification_sound_bells.mp3"); //file name must begin with notification_sound


        Display.getInstance().scheduleLocalNotification(
                n,
                System.currentTimeMillis() + 10 * 1000, // fire date/time
                LocalNotification.REPEAT_MINUTE  // Whether to repeat and what frequency
        );
        
        
        //action bouton 
        
        Enregistrer.addActionListener((evt) -> {
            
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
                         showToast("succes ! bien recu");
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
               
        
        ////////////////// les icones 
//        tfNote.getAllStyles().setMargin(LEFT, 0);
        Label addIcon = new Label("", "TextField");
        Label descIcon = new Label("", "TextField");
        Label dureeIcon = new Label("", "TextField");
         Label duree1Icon = new Label("", "TextField");
          Label duree2Icon = new Label("", "TextField");
           Label duree3Icon = new Label("", "TextField");
           
        addIcon.getAllStyles().setMargin(RIGHT, 0);
        FontImage.setMaterialIcon(addIcon, FontImage.MATERIAL_10MP, 2);
        
        
        descIcon.getAllStyles().setMargin(RIGHT, 0);
        //
        descIcon.getAllStyles().setMargin(RIGHT, 0); 
        duree1Icon.getAllStyles().setMargin(RIGHT, 0); 
         duree2Icon.getAllStyles().setMargin(RIGHT, 0);
          duree3Icon.getAllStyles().setMargin(RIGHT, 0);
        
        

        
        FontImage.setMaterialIcon(descIcon, FontImage.MATERIAL_10MP, 2);
        FontImage.setMaterialIcon(dureeIcon, FontImage.MATERIAL_10MP , 2);
        //
        FontImage.setMaterialIcon(duree1Icon, FontImage.MATERIAL_DATE_RANGE , 2);
        FontImage.setMaterialIcon(duree2Icon, FontImage.MATERIAL_DATE_RANGE , 2);
        FontImage.setMaterialIcon(duree3Icon, FontImage.MATERIAL_10MP , 2);
        
        
        addIcon.getAllStyles().setBgColor(0x000000);
        addIcon.getAllStyles().setFgColor(0x000000);
//        addIcon.getAllStyles().setBgColor(0x000000);
        Button btnBlack = new Button();
//        btnBlack.set
        addIcon.setUIID(Enregistrer.getUIID());
        descIcon.setUIID(Enregistrer.getUIID());
        dureeIcon.setUIID(Enregistrer.getUIID());
        duree1Icon.setUIID(Enregistrer.getUIID());
        duree2Icon.setUIID(Enregistrer.getUIID());
        duree3Icon.setUIID(Enregistrer.getUIID());
        
        
        
       // FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);

        
       
       
        
//        addActionButton(res);
      
        

        

        FloatingActionButton fab2 = FloatingActionButton.createFAB(FontImage.MATERIAL_KEYBOARD_ARROW_UP);

        fab.addActionListener(e-> {

            this.getStyle().setBgColor(0xFFFFFF);

            
            ajoutCont = new Container();
            ajoutCont.setLayout(BoxLayout.y());

            
            
           
 //        tfNote.getStyle().setMargin(30, BOTTOM, 30, RIGHT);
            tfNote.getStyle().setFgColor(0x000000);
//            tfReclamationId.getStyle().setMargin(30, BOTTOM, 30, RIGHT);
            tfReclamationId.getStyle().setFgColor(0x000000);
//            tfNum_Tel_Demande.getStyle().setMargin(30, BOTTOM, 30, RIGHT);
            datee.getStyle().setFgColor(0x000000);
            
            
        
            
            Font largeBoldMonospaceFont = Font.createSystemFont(Font.FACE_MONOSPACE, Font.STYLE_BOLD, Font.SIZE_LARGE);
            tfNote.getStyle().setFgColor(0xFE79D1);
            tfReclamationId.getStyle().setFgColor(0x24445C);
            datee.getStyle().setFgColor(0xFE79D1);
            
            tfNote.setGrowLimit(10000);
            tfNote.getStyle().setFont(largeBoldMonospaceFont);
            tfReclamationId.getStyle().setFont(largeBoldMonospaceFont);
            datee.getStyle().setFont(largeBoldMonospaceFont);
             
            
           
            
            
            
            ajoutCont.add(fab2);
           
            Container by = BoxLayout.encloseY(
                
                BorderLayout.center(tfNote).
                        add(BorderLayout.WEST, addIcon),
                BorderLayout.center(tfReclamationId).
                        add(BorderLayout.WEST, descIcon),
                BorderLayout.center(datee).
                        add(BorderLayout.WEST, dureeIcon),
               
                            
                Enregistrer
                
            );

            add(by);
            add(ajoutCont);
            ajoutCont.setHidden(false);
            fab.setHidden(true);
            System.out.println("fab set hiden");
            
            this.show();
        });
        
        AddEvaluationForm1 pf = this ;
        fab2.addActionListener(e->{
            ajoutCont.setHidden(true);
            new ProfileForm(res).show();
        });
        
        
      
        

        setupSideMenu(res);
    }
    
    
    
    int idBtn = 0;
    
    private void addButtonBottom(Image arrowDown, String text, int color, boolean first ,Resources res) {
        btnTab[idBtn] = new Button ();
        MultiButton finishLandingPage = new MultiButton(text);
        finishLandingPage.setEmblem(arrowDown);
        finishLandingPage.setUIID("Container"+idBtn);
        finishLandingPage.setUIIDLine1("TodayEntry"+idBtn);
        finishLandingPage.setIcon(createCircleLine(color, finishLandingPage.getPreferredH(),  first));
        finishLandingPage.setIconUIID("Container"+idBtn);
        finishLandingPage.setLeadComponent(btnTab[idBtn]);
        add(FlowLayout.encloseIn(finishLandingPage));       
        idBtn++;       
    }
    
 /*   public void actLst(Resources res){
        for(int i = 0 ; i<l.size() ; i++){
            ActionListnerClass alc = new ActionListnerClass(btnTab[i] , l.get(i) , res);
            
        }
    }
    */

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
    
    
private void showToast(String text) {
        Image errorImage = FontImage.createMaterial(FontImage.MATERIAL_ERROR, UIManager.getInstance().getComponentStyle("Title"), 4);
        ToastBar.Status status = ToastBar.getInstance().createStatus();
        status.setMessage(text);
        status.setIcon(errorImage);
        status.setExpires(4000);
        status.show();
    }
    
    @Override
    protected void showOtherForm(Resources res) {
        new StatsForm(res).show();
    }
}

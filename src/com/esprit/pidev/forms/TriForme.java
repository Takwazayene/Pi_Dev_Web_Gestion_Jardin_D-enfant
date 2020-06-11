/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.forms;

import com.codename1.components.FloatingActionButton;
import com.codename1.components.ImageViewer;
import com.codename1.components.SpanLabel;
import com.codename1.ui.Button;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
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
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.esprit.pidev.services.ServiceMatiere;
import java.io.IOException;


public class TriForme extends SideMenuBaseForm { 
     
       
    private Resources theme;

    
    
     Button btnrech;
      TextField rtitre;
       SpanLabel lb;
        Button btnaff;
       
   public TriForme(Resources theme) {
        super(BoxLayout.y());
        Toolbar tb = getToolbar();
        tb.setTitleCentered(false);
        Image profilePic = theme.getImage("logo.jpg");
        Image mask = theme.getImage("round-mask.png");
        profilePic = profilePic.fill(mask.getWidth(), mask.getHeight());
        Label profilePicLabel = new Label(profilePic, "ProfilePicTitle");
        profilePicLabel.setMask(mask.createMask());

        Button menuButton = new Button("");
        menuButton.setUIID("Title");
        FontImage.setMaterialIcon(menuButton, FontImage.MATERIAL_MENU);
        menuButton.addActionListener(e -> getToolbar().openSideMenu());
        
        Container remainingMatieres = BoxLayout.encloseY(
                        new Label("12", "CenterTitle"),
                        new Label("remaining matieres", "CenterSubTitle")
                );
        remainingMatieres.setUIID("RemainingMatieres");
        Container completedMatieres = BoxLayout.encloseY(
                        new Label("32", "CenterTitle"),
                        new Label("completed matieres", "CenterSubTitle")
        );
        completedMatieres.setUIID("CompletedMatieres");

        Container titleCmp = BoxLayout.encloseY(
                        FlowLayout.encloseIn(menuButton),
                        BorderLayout.centerAbsolute(
                                BoxLayout.encloseY(
                                    new Label("OUELDY APP", "Title"),
                                    new Label("Jardin d'enfant", "SubTitle")
                                )
                            ).add(BorderLayout.WEST, profilePicLabel),
                        GridLayout.encloseIn(2, remainingMatieres, completedMatieres)
                );
        
        FloatingActionButton fab = FloatingActionButton.createFAB(FontImage.MATERIAL_ADD);
        fab.getAllStyles().setMarginUnit(Style.UNIT_TYPE_PIXELS);
        fab.getAllStyles().setMargin(BOTTOM, completedMatieres.getPreferredH() - fab.getPreferredH() / 2);
        tb.setTitleComponent(fab.bindFabToContainer(titleCmp, CENTER, BOTTOM));
                        
        
        FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);
        
        setupSideMenu(theme);
        
           
           
           
                 

          btnrech=new Button("Search");
         rtitre = new TextField("","Name");
          lb = new SpanLabel("");
          
         
         
        add(rtitre);
        
         add(btnrech);
          add(lb);
         
       
       
//               back = Image.createImage("/back-command.png");
      
             //  f.getToolbar().addCommandToLeftBar(" ", back, (ev) -> {
                   //TasksListForm myp = new TasksListForm();
                   //myp.showBack();
        //}); 
          
        btnrech.addActionListener((e)->{
        
        if(rtitre.getText().equalsIgnoreCase("") ){
            
            
             Dialog.show("alert","Please, try to fill the text field title !!", "ok", null);
                 ;}
                         else{
        ServiceMatiere ser=new ServiceMatiere();
        lb.setText(ser.Recherche(rtitre.getText()).toString());
        }});
        

       }

    
      

  

    @Override
    protected void showOtherForm(Resources res) {
      //  throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
    
    
}

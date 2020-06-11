/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.forms;







import com.codename1.components.FloatingActionButton;
import com.codename1.components.ImageViewer;
import com.codename1.components.MultiButton;
 
import com.codename1.components.SpanLabel;
import com.codename1.components.ToastBar;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.messaging.Message;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.EncodedImage;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.Slider;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.URLImage;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.events.SelectionListener;
import com.codename1.ui.geom.Dimension;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.table.TableLayout;
import com.codename1.ui.util.Resources;
import com.esprit.pidev.forms.SideMenuBaseForm;
import com.esprit.pidev.models.Matiere;
import com.esprit.pidev.services.ServiceMatiere;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;






/**
 *
 * @author ASUS
 */
public class Trie extends SideMenuBaseForm {
    
    Form f;
    ImageViewer ip;
    List<Matiere> lse = new ArrayList();
        ArrayList<Matiere> form;
   
    EncodedImage encImg;
    Image img;
    ImageViewer imgV;

     Image videImg;
  private static int idCat = -1;

    public Trie(Resources theme)   {
 
       // f = new Form(" Liste des évenements ", BoxLayout.y());
        //  Resources theme = UIManager.initFirstTheme("/theme");
          //-----------------------------RECHERCHES-----------------------------------------    
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
        

         
        
     tb.setTitleCentered(false);
        Button rech = new Button("search");
        add(rech);
        rech.addActionListener(new ActionListener() {
                private String textAttachmentUri;
                private String imageAttachmentUri;
                public void actionPerformed(ActionEvent evt) {
                       TriForme detail_form2;
                       detail_form2 = new TriForme(theme);
                       detail_form2.show();
                       
                    }
            });
                 this.lse = new ServiceMatiere().Tri();
        for (int i = 0; i < lse.size(); i++) {
        
            addItem(lse.get(i));
             Integer quantity = lse.get(i).getNbre_Heure_Matiere();
      //  this.add(new SpanLabel(new ServiceMatiere().getAllTasks().toString()));

  //      this.getToolbar().addCommandToLeftBar("Return", null, (evt) -> {
    //        previous.showBack();
     //   });
    }
    }
    public void addItem(Matiere e) {

       
       
                
        Container c1 = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        Container c2 = new Container(new BoxLayout(BoxLayout.Y_AXIS));
       
        Label l2 = new Label("Nom Matiére :"+e.getNom_Matiere());
        Label l = new Label("coef Matiére:" +e.getCoef_Matiere());
        Label a  =new Label("nombre des heures :" +e.getNbre_Heure_Matiere());
        //Label 13 = new Label("Nom Matiére :"+e.getNbre_Heure_Matiere());
     
        
        c2.add(l2);
        c2.add(l);
        c2.add(a);
        
        c1.add(c2);
       
        add(c1);
        refreshTheme();
        
       
        
    }
    
 private void addButtonBottom(Image arrowDown, String text, int color, boolean first) {
        MultiButton finishLandingPage = new MultiButton(text);
        finishLandingPage.setEmblem(arrowDown);
        finishLandingPage.setUIID("Container");
        finishLandingPage.setUIIDLine1("TodayEntry");
      //  finishLandingPage.setIcon(createCircleLine(color, finishLandingPage.getPreferredH(),  first));
        finishLandingPage.setIconUIID("Container");
        add(FlowLayout.encloseIn(finishLandingPage));
    }
         
    
    

    @Override
    protected void showOtherForm(Resources res) {
      //  throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }


  
      }
   


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.forms;

import com.codename1.capture.Capture;
import com.codename1.components.FloatingActionButton;
import com.codename1.components.MultiButton;
import com.codename1.components.ToastBar;
import com.codename1.io.FileSystemStorage;
import com.codename1.io.Util;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.media.Media;
import com.codename1.media.MediaManager;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
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
import com.esprit.pidev.models.Tab_Demande;
import com.esprit.pidev.models.Task;
import com.esprit.pidev.services.ServiceDemande;
import com.esprit.pidev.services.TaskService;
import java.io.IOException;
import java.util.Date;

/**
 *
 * @author aissa
 */
public class AddDemandeForm extends SideMenuBaseForm {

    public AddDemandeForm(Resources theme) {
      //  super("Add a new task", BoxLayout.y());
        super(BoxLayout.y());
       // Toolbar tb = getToolbar();
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
        
        Container remainingDemandes = BoxLayout.encloseY(
                        new Label("12", "CenterTitle"),
                        new Label("remaining demandes", "CenterSubTitle")
                );
        remainingDemandes.setUIID("RemainingDemandes");
        Container completedDemandes = BoxLayout.encloseY(
                        new Label("32", "CenterTitle"),
                        new Label("completed demandes", "CenterSubTitle")
        );
        completedDemandes.setUIID("CompletedDemandes");

        Container titleCmp = BoxLayout.encloseY(
                        FlowLayout.encloseIn(menuButton),
                        BorderLayout.centerAbsolute(
                                BoxLayout.encloseY(
                                    new Label("OUELDY APP", "Title"),
                                    new Label("Jardin d'enfant", "SubTitle")
                                )
                            ).add(BorderLayout.WEST, profilePicLabel),
                        GridLayout.encloseIn(2, remainingDemandes, completedDemandes)
                );
        
        FloatingActionButton fab = FloatingActionButton.createFAB(FontImage.MATERIAL_ADD);
        fab.getAllStyles().setMarginUnit(Style.UNIT_TYPE_PIXELS);
        fab.getAllStyles().setMargin(BOTTOM, completedDemandes.getPreferredH() - fab.getPreferredH() / 2);
        tb.setTitleComponent(fab.bindFabToContainer(titleCmp, CENTER, BOTTOM));
                        
        
        FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);
        
        setupSideMenu(theme);
    
      
        TextField tfNom = new TextField("","Nom");
        TextField tfPrenom = new TextField("","Prenom");
        TextField tfCin = new TextField("","Cin");
        TextField tfNumTel = new TextField("","NUMERO");
        TextField tfCv = new TextField("","age");
        // Picker tfDateNaissance = new Picker();
        TextField tfEtudeDemande = new TextField("","Niveau d'etude");
        TextField tfPosteDemande = new TextField("","metier");
        Button btn = new Button("Add the Demande");
        
      
        btn.addActionListener((evt) -> {
            if ((tfCin.getText().length() == 0) || (tfNumTel.getText().length() == 0)) {
                Dialog.show("Alert", "Please fill all the fields", "OK", null);
            } else {
                try {
                    Tab_Demande t = new Tab_Demande (tfNom.getText(), tfPrenom.getText(), Integer.parseInt(tfCin.getText()) ,Integer.parseInt(tfNumTel.getText()), tfCv.getText(), tfEtudeDemande.getText() , tfPosteDemande.getText());
                    if (new ServiceDemande().addDemande(t)) {
                      //  Dialog.show("SUCCESS", "Demande sent", "OK", null);
                      ToastBar.showMessage("Demande sent",FontImage.MATERIAL_DONE);
                    } else {
                        Dialog.show("ERROR", "Server error", "OK", null);
                    }
                } catch (NumberFormatException e) {
                    Dialog.show("ERROR", "Status must be a number", "OK", null);
                }

            }
        });

        this.addAll(tfNom, tfPrenom,tfCin,tfNumTel,tfCv,tfEtudeDemande,tfPosteDemande, btn);
        
        
        
        
        
        
        
        
        
     Container voca=new Container(BoxLayout.y());
       
     Label ll=new Label("Si vous avez des remarques les enregistrer... ");
        
        Style s = UIManager.getInstance().getComponentStyle("Title");
        FontImage icon = FontImage.createMaterial(FontImage.MATERIAL_MIC, s);
        Button voice= new Button(icon);
        voice.setUIID("LoginButton");
        voca.addAll(ll,voice);
        
        FileSystemStorage fs = FileSystemStorage.getInstance();
        String recordings = fs.getAppHomePath() + "recording/";
        fs.mkdir(recordings);
        try {
            for (String file : fs.listFiles(recordings)) {
                MultiButton mb = new MultiButton(file.substring(file.lastIndexOf("/") + 1));
                mb.addActionListener((e) -> {
                    try {
                        Media m = MediaManager.createMedia(recordings + file, false);
                        m.play();
                    } catch (Throwable err) {
                      //  Log.e(err);
                    }
                });
              
               voca.add(mb);        
            }

            voice.addActionListener( (ev) -> {
                try {
                    String file = Capture.captureAudio();
                    if (file != null) {
                        SimpleDateFormat sd = new SimpleDateFormat("yyyy-MMM-dd-kk-mm");
                        String fileName = sd.format(new Date());
                        String filePath = recordings + fileName;
                        Util.copy(fs.openInputStream(file), fs.openOutputStream(filePath));
                        MultiButton mb = new MultiButton(fileName);
                        mb.addActionListener((e) -> {
                            try {
                                Media m = MediaManager.createMedia(filePath, false);
                                m.play();
                            } catch (IOException err) {
                          //      Log.e(err);
                            }
                        });
                        voca.add(mb);
                        voca.revalidate();
                    }
                } catch (IOException err) {
                   
                }
            });
        } catch (IOException err) {
          
        }
           
   add(voca);
       
    }

    @Override
    protected void showOtherForm(Resources res) {
       // throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

}

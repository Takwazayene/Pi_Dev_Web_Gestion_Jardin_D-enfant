/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.esprit.pidev.models;

/**
 *
 * @author Hp
 */
public class MapLocation {
     int Id ;
    
    int x , y ;

    public MapLocation() {
    }

    public MapLocation(int Id, int x, int y) {
        this.Id = Id;
      
        this.x = x;
        this.y = y;
    }

    public int getId() {
        return Id;
    }

    public void setId(int id) {
        this.Id= Id;
    }

   

    public int getX() {
        return x;
    }

    public void setX(int x) {
        this.x = x;
    }

    public int getY() {
        return y;
    }

    public void setY(int y) {
        this.y = y;
    }

    @Override
    public String toString() {
        return "to String location __________ x: "+x
                +"  y: "+y
                +"   id :"+Id;
    }
    
    
}

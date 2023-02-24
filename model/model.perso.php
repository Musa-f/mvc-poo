<?php

class Personnage{
    private $_id;
    private $_nom;
    private $_degats;

    function __construct($id, $nom, $degats){
        $this->$id = $this->setId($id);
        $this->$nom = $this->setNom($nom);
        $this->$degats = $this->setDegats($degats);
    }

    //GETTERS
    public function getId(){
        return $this->_id;
    }
    
    public function getNom(){
        return $this->_nom;
    }

    public function getDegats(){
        return $this->_degats;
    }

    // SETTERS
    public function setId($id){
        $this->_id = $id;
    }

    public function setNom($nom){
        $this->_nom = $nom;
    }

    public function setDegats($degats){
        $this->_degats = $degats;
    }

    // METHODES
    public function frapper(Personnage $perso){
        if($perso->getId() == $this->_id){
            return "Erreur";
        }else{
            return $perso->recevoirDegats();
        }
    }

    public function recevoirDegats(){
        if($this->_degats < 100){
            $this->_degats += 5;
        }else{
            return "mort";
        }
    }
}
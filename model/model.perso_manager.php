<?php

class PersonnageManager{
    private $_conn;

    public function __construct($conn){
        $this->_conn = $conn;
    }

    public function creer(Personnage $perso){
        $stmt = $this->_conn->prepare("INSERT INTO personnages (nom_perso) VALUES (:nomPerso)");
        $stmt = $stmt->execute(array(
            "nomPerso" => $perso->getNom()
        ));
        $perso = new Personnage($this->_conn->lastInsertId(), $perso->getNom(), 0);
    }

    public function lecture($info){

        if(is_int($info)){
            $stmt = $this->_conn->prepare("SELECT * FROM personnages WHERE id_perso = :idPerso ");
            $stmt->execute(array(
                "idPerso" => $info
            ));
            $stmt = $stmt->fetch();
            return new Personnage($stmt['id_perso'], $stmt['nom_perso'], $stmt['degats_perso']);
        }else{
            $stmt = $this->_conn->prepare("SELECT * FROM personnages WHERE nom_perso = :nomPerso");
            $exec = $stmt->execute(array(
                "nomPerso" => $info
            ));
            $stmt = $stmt->fetch();
            return new Personnage($stmt['id_perso'], $stmt['nom_perso'], $stmt['degats_perso']);
        }
    }

    public function modifier(Personnage $perso){
        $stmt = $this->_conn->prepare("UPDATE personnages
                                    SET degats_perso = :degatsPerso
                                    WHERE id_perso = :idPerso
                                    ");
        $stmt = $stmt->execute(array(
            "degatsPerso" => $perso->getDegats(),
            "idPerso" => $perso->getId()
        ));
    }

    public function supprimer(Personnage $perso){
        $stmt = $this->_conn->prepare("DELETE FROM personnages WHERE id_perso = :idPerso ");
        $stmt = $stmt->execute(array(
            "idPerso" => $perso->getId()
        ));
    }

    public function compter(){
        $stmt = $this->_conn->prepare("SELECT COUNT(*) FROM personnages");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function listePerso($nom){
        $persos = array();
        $stmt = $this->_conn->prepare("SELECT * FROM personnages WHERE nom_perso <> :nomPerso ORDER BY nom_perso");
        $exec = $stmt->execute(array(
            "nomPerso" => $nom
        ));
        $donnees = $stmt->fetchAll();
        foreach($donnees as $donnee){
            $persos[] = new Personnage($donnee['id_perso'], $donnee['nom_perso'], $donnee['degats_perso']);
        }
        return $persos;
    }

    public function existencePerso($info){

        if(is_int($info)){
            $stmt = $this->_conn->prepare("SELECT COUNT(*) FROM personnages WHERE id_perso = :idPerso ");
            $stmt->execute(array(
                'idPerso' => $info
            ));
        }else{
            $stmt = $this->_conn->prepare("SELECT COUNT(*) FROM PERSONNAGES WHERE nom_perso = :nomPerso ");
            $stmt->execute(array(
                "nomPerso" => $info
            ));
        }
        return $stmt->fetchColumn();
    }
 
}


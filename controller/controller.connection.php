<?php

require_once '../model/model.conn.php';
require_once '../model/model.perso_manager.php';
require_once '../model/model.perso.php';
session_start();

$conn = conn();
$personnageManager = new PersonnageManager($conn);

if(!isset($_SESSION["user"])){
    $message;

    if (isset($_POST['creer']) && !empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        $bool = $personnageManager->existencePerso($nom);
        if ($bool == 1) {
            $message = "Le personnage existe déjà.";
        } else {
            $personnage = new Personnage(0, $nom, 0);
            $personnageManager->creer($personnage);
            $message = "Le personnage a bien été créé.";
        }
    }
    
    if (isset($_POST['utiliser']) && !empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        $bool = $personnageManager->existencePerso($nom);
        if ($bool == 1) {
            $_SESSION['user'] = $personnageManager->lecture($nom);
            header('Location: controller.account.php');
        } else {
            $message = "Ce nom n'existe pas.";
        }
    }

    include "../view/view.connection.php";
}else{
    include "controller.account.php";
}
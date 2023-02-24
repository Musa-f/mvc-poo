<?php
session_start();

if(!isset($_SESSION["user"])){
    echo "Accès interdit";
}else{
    $message = "";
    $user = $_SESSION["user"];

    $nom = $user->getNom();

    
    if(isset($_GET['frapper']))
    {
        $perso1 = $user;
        $perso2 = $_GET['frapper'];
        $personnage2 = $personnageManager->lecture($perso2);
        $return;

        if($_GET['frapper'] !== $nom)
        {
            $return = $perso1->frapper($personnage2);
            $personnageManager->modifier($personnage2);
            $message = "Vous avez frappé le personnage $perso2";
        }
        else if($_GET['frapper'] == $nom)
        {
            $message = "Vous ne pouvez pas vous frapper";
        }
        else if($return == "mort")
        {
            $personnageManager->supprimer($personnage2);
            $message = "Le personnage a été tué";
        }
    }

    $persos = $personnageManager->listePerso($user->getNom());

    include "../view/view.account.php";
}


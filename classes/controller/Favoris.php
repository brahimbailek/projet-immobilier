<?php
session_start();
require_once '../view/ViewAnnonce.php';
require_once '../view/ViewTemplate.php';
require_once '../model/ModelUser.php';

if (isset($_SESSION['id'])) {
    $user = new ModelUser($_SESSION['id']);
    ViewTemplate::baliseTop();
    ViewTemplate::navBar();
    // ViewTemplate::baliseMain(1);
    ViewAnnonce::mesAnnonces('Mes Favoris', $user->getFavoris());
    // ViewTemplate::baliseMain(0);
    ViewTemplate::footer();
    ViewTemplate::baliseBottom();
} else {
    header('location:Accueil.php');
}

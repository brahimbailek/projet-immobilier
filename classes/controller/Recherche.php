<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../utils/TestPreg.php';

if (isset($_POST['recherche'])) {
    ViewTemplate::baliseTop();
    ViewTemplate::navBar();


    $donnee = [$_POST['Type'], $_POST['ville'], $_POST['typeBien'], $_POST['surfaceMin'], $_POST['surfaceMax'], $_POST['prixMax']];
    $type = ['type', 'cp', 'typeBien', 'surfaceMin', 'surfaceMax', 'prix'];
    $donneeOk = testPreg::testInput($donnee, $type);

    if ($donneeOk['ok']) {
        $donneeOk = $donneeOk['donnee'];
        if (isset($_POST['surfaceC']) && isset($_POST['prixMaxC'])) {
            $liste =  ModelAnnonce::recherche($donneeOk['type'], $donneeOk['cp'], $donneeOk['typeBien'], '0', $donneeOk['surfaceMax'], '0');
        } else if (isset($_POST['prixMaxC'])) {
            $liste =   ModelAnnonce::recherche($donneeOk['type'], $donneeOk['cp'], $donneeOk['typeBien'], $donneeOk['surfaceMin'], $donneeOk['surfaceMax'], '0');
        } else if (isset($_POST['surfaceC'])) {

            $liste =   ModelAnnonce::recherche($donneeOk['type'], $donneeOk['cp'], $donneeOk['typeBien'], '0', $donneeOk['surfaceMax'], $donneeOk['prix']);
        } else {
            $liste = ModelAnnonce::recherche($donneeOk['type'], $donneeOk['cp'], $donneeOk['typeBien'], $donneeOk['surfaceMin'], $donneeOk['surfaceMax'], $donneeOk['prix']);
        }
        if (empty($liste)) {
            ViewTemplate::alerte('success" style="margin-top:70px;margin-bottom:-115px;"', 'desolé, aucun resultat trouver.', '', '');
            ViewAnnonce::derniereAnonce();
        } else {
            ViewAnnonce::mesAnnonces('Recherche',$liste);
        }
    } else {
        ViewTemplate::alerte('secondary style="padding-top:255px;"', 'donné corompue', '', '');
    }
} else {
    header('location:Accueil.php');
}

ViewTemplate::footer();
ViewTemplate::baliseBottom();

<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewTypeBiens.php';
require_once '../utils/TestPreg.php';
require_once '../model/ModelTypeBien.php';
require_once '../utils/constante.php';

if (isset($_POST['idModifType'])) {
    $donnee = [$_POST['idModifType'], $_POST['newNom'], $_POST['nom']];
    $type = ['id', 'nomtype', 'prenom'];
    $donneeok = testPreg::testInput($donnee, $type);
    if ($donneeok['ok']) {
        $donneeok = $donneeok['donnee'];
        if (ModelTypeBien::typebienViaLibele($donneeok['nomtype'])) {
            ViewTemplate::alerte('secondary', 'ce libellé est déjà pris ', 'TypeBiens.php', 'retour ici');
        } else {

            ModelTypeBien::modifType($donneeok['id'], $donneeok['nomtype']);
            rename(ROOT_DIR . '/assets/img/' . $donneeok['prenom'] . '.jpg', ROOT_DIR . '/assets/img/' . $donneeok['nomtype'] . '.jpg');
            ViewTypeBiens::listeTypeBiens3($donneeok['nomtype']);
        }
    } else {
        ViewTemplate::alerte('danger', 'erreur de securite', 'TypeBiens.php', 'retour');
    }
} else {
    header('location:Accueil.php');
}

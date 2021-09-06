<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../model/ModelAnnonce.php';
require_once '../utils/TestPreg.php';
require_once '../utils/telechargement.php';

if (!isset($_SESSION['id']) && empty($_SESSION['role'])) {
    header('location:ConnexionUser.php');
    exit();
} else {
    if (isset($_POST['validerAjoutAnnonce'])) {
        $donnee = [
            $_POST['titre'],
            $_POST['type'],
            $_POST['typeBienAnnonce'],
            $_POST['surface'],
            $_POST['prix'],
            $_POST['description'],
            $_POST['adresse'],
            $_POST['cp'],
            $_POST['ville'],
            $_SESSION['id']
        ];
        $type = ['titre', 'type', 'typeBien', 'surface', 'prix', 'description', 'adresse', 'cp', 'ville', 'id'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {
            $json = [];
            $extensions = ['jpg', 'gif', 'png', 'jpeg'];
            $downloadP = telechargement::telecharge2($_FILES['photoP'], $extensions, 'images');
            $json['photoP'] = $downloadP['nom'];
            $fichierT = 0;
            $countFichier = count($_FILES['photos']['name']);
            for ($i = 0; $i < $countFichier; $i++) {
                $fichier = ['name' => $_FILES['photos']['name'][$i], 'type' => $_FILES['photos']['type'][$i], 'tmp_name' => $_FILES['photos']['tmp_name'][$i], 'error' => $_FILES['photos']['error'][$i], 'size' => $_FILES['photos']['size'][$i]];

                $fichier = telechargement::telecharge2($fichier, $extensions, 'images');
                $fichier['ok'] ? $fichierT += 1 : '';
                $json[$i] = $fichier['nom'];
            }

            if ($downloadP['ok'] && $fichierT == $countFichier) {
                $donneeOk = $donneeOk['donnee'];
                $json = json_encode($json);
                $idAnnonce = ModelAnnonce::ajoutAnnonce($donneeOk['titre'], $donneeOk['type'], $donneeOk['typeBien'], $donneeOk['surface'], $donneeOk['prix'], $donneeOk['description'], $donneeOk['adresse'], $donneeOk['cp'], $donneeOk['ville'], $json, $_SESSION['id']);
                header('location:Annonce.php?id=' . $idAnnonce);
            } else {
                ViewTemplate::baliseTop();
                ViewTemplate::navBar();
                ViewAnnonce::formAjout();
                ViewTemplate::alerte('secondary', 'erreur lors du telechargement des immage. Veuillez reessayer', '', '');
            }
        } else {
            ViewTemplate::baliseTop();
            ViewTemplate::navBar();
            ViewAnnonce::formAjout();
            ViewTemplate::alerte('secondary', $donneeOk['retour'], '', '');
        }
    } else {

        ViewTemplate::baliseTop();
        ViewTemplate::navBar();
        ViewAnnonce::formAjout();
    }

    ViewTemplate::footer();
    ViewTemplate::baliseBottom();
}
?>
<script>
    validationClient('ajoutAnnonce', ['titre', 'surface', 'prix', 'adresse', 'cp', 'nomville'])
    
</script>
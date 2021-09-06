<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../model/ModelAnnonce.php';
require_once '../utils/TestPreg.php';
if (!isset($_SESSION['id'])) {
    header('location:ConnexionUser.php');
} else {
    if (isset($_GET['id'])) {

        $donnee = [$_GET['id']];
        $type = ['id'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {
            $annonce = ModelAnnonce::annonceViaId($donneeOk['donnee']['id']);
            if ($annonce && $annonce['user_id'] == $_SESSION['id']) {
                ViewTemplate::baliseTop();
                ViewTemplate::navBar();
                ViewAnnonce::modifAnnonces($annonce);
                ViewTemplate::footer();
                ViewTemplate::baliseBottom();
            } else {
                header('location:Accueil.php?alert=cette+annonce+ne+vous+appartient+pas');
            }
        } else {

            header('location:Accueil.php?alert=Donnee+corompue,modification+de+l+annonce+annuler');
        }
    } else if (isset($_POST['validerModifAnnonce'])) {
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
            $_POST['validerModifAnnonce']
        ];
        $type = ['titre', 'type', 'typeBien', 'surface', 'prix', 'description', 'adresse', 'cp', 'ville', 'annonceId'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {
            $donneeOk = $donneeOk['donnee'];

            $json = json_decode(ModelAnnonce::annonceViaId($donneeOk['annonceId'])['photos'], true);
            if (isset($_FILES['photos']['name'][0]) && !empty($_FILES['photos']['name'][0])) {
                $extensions = ['jpg', 'gif', 'png', 'jpeg'];
                $fichierT = 0;
                $countFichier = count($_FILES['photos']['name']);
                for ($i = 0; $i < $countFichier; $i++) {
                    $fichier = ['name' => $_FILES['photos']['name'][$i], 'type' => $_FILES['photos']['type'][$i], 'tmp_name' => $_FILES['photos']['tmp_name'][$i], 'error' => $_FILES['photos']['error'][$i], 'size' => $_FILES['photos']['size'][$i]];

                    $fichier = telechargement::telecharge2($fichier, $extensions, 'images');
                    $fichier['ok'] ? $fichierT += 1 : '';
                    array_push($json, $fichier['nom']);
                }
                if ($fichierT == $countFichier) {
                    $json = json_encode($json);
                    ModelAnnonce::modifAnnonce($donneeOk['titre'], $donneeOk['type'], $donneeOk['typeBien'], $donneeOk['surface'], $donneeOk['prix'], $donneeOk['description'], $donneeOk['adresse'], $donneeOk['cp'], $donneeOk['ville'], $json, $donneeOk['annonceId']);
                    header('location:Annonce.php?id=' . $donneeOk['annonceId']);
                } else {
                    ViewTemplate::baliseTop();
                    ViewTemplate::navBar();
                    ViewAnnonce::modifAnnonces(ModelAnnonce::annonceViaId($donneeOk['annonceId']));
                    ViewTemplate::alerte('secondary', 'erreur lors du telechargement des immage. Veuillez reessayer', '', '');
                }
            } else {
                $json = json_encode($json);
                ModelAnnonce::modifAnnonce($donneeOk['titre'], $donneeOk['type'], $donneeOk['typeBien'], $donneeOk['surface'], $donneeOk['prix'], $donneeOk['description'], $donneeOk['adresse'], $donneeOk['cp'], $donneeOk['ville'], $json, $donneeOk['annonceId']);
                header('location:Annonce.php?id=' . $donneeOk['annonceId']);
            }
        } else {
            ViewTemplate::baliseTop();
            ViewTemplate::navBar();
            ViewTemplate::alerte('secondary text-danger" style="margin-top:155px"', 'donnee corompue. pour revenir aux annonces cliquez', 'Annonce.php?mesAnnonces=1', 'ici');
            ViewTemplate::footer();
            ViewTemplate::baliseBottom();
        }

        //MODIF PHOTO P
    } else if (isset($_POST['modifPhotoP'])) {
        $donnee = [$_POST['modifPhotoP'], $_POST['lienPhotoP']];
        $type = ['annonceId', 'lienImg'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {
            $donneeOk = $donneeOk['donnee'];
            // unlink('../../images/' . $donneeOk['lienImg']);
            $json = json_decode(ModelAnnonce::annonceViaId($donneeOk['annonceId'])['photos'], true);
            $extensions = ['jpg', 'gif', 'png', 'jpeg'];
            $downloadP = telechargement::telecharge2($_FILES['newPhotoP'], $extensions, 'images');
            $json['photoP'] = $downloadP['nom'];
            var_dump($_POST, $_FILES, $json);
            ModelAnnonce::modifPhotoP($donneeOk['lienImg'], json_encode($json), $donneeOk['annonceId']);
            header('location:ModifAnnonce.php?id=' . $donneeOk['annonceId']);
        } else {
            ViewTemplate::baliseTop();
            ViewTemplate::navBar();
            ViewTemplate::alerte('secondary text-danger" style="margin-top:155px"', 'donnee corompue. pour revenir aux annonces cliquez', 'Annonce.php?mesAnnonces=1', 'ici');
            ViewTemplate::footer();
            ViewTemplate::baliseBottom();
        }
    } else {
        header('location:Annonce.php?mesAnnonces=1');
    }
}
?>
<script>
    //ajout photo click
    $("#ajoutPhoto").click(function(e) {
        $("#photos").click();
    })

    //modal supression
    $('#modalPhoto').on('shown.bs.modal', function(e) {
        let button = $(e.relatedTarget)
        let img = button.data('image')
        let idAnnonce = $("#validerModifAnnonce").val()
        console.log(img, idAnnonce)
        $('#suppImg').click(function(e) {
            generationAjax('SuppImg.php', {
                idAn: idAnnonce,
                nomImg: img
            }, 'html', 'immageAnnonce')
            $('#fermeModalSup').click()
        })
    })
    //modal modif photoP
    $('#modalPhotoP').on('shown.bs.modal', function(e) {
        let button = $(e.relatedTarget)
        let idAnnonce = $("#validerModifAnnonce").attr('value')
        let img = button.data('image')
        console.log(idAnnonce, img)
        $("#modifPhotoP").val(idAnnonce)
        $("#lienPhotoP").val(img)

    })

    //validation client
    validationClient('modifAnnonce', ['titre', 'surface', 'prix', 'adresse', 'cp', 'nomVille'])
</script>
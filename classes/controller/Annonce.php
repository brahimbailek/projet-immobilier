<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../model/ModelAnnonce.php';
require_once '../utils/TestPreg.php';


if (isset($_GET['id'])) {
    $donnee = [$_GET['id']];
    $type = ['id'];
    $donneeOk = testPreg::testInput($donnee, $type);
    if ($donneeOk['ok']) {
        $donneeOk = $donneeOk['donnee'];
        ViewTemplate::baliseTop();
        ViewTemplate::navBar();
        ViewAnnonce::annonce($donneeOk['id']);
    } else {
        ViewTemplate::baliseTop();
        ViewTemplate::navBar();
        ViewTemplate::alerte('secondary" style="margin-top:250px;" ', 'Donnée incorrect,retour a l\'Accueil', 'Accueil.php', 'ici');
    }
} else if (isset($_GET['mesAnnonces'])) {
    if (isset($_SESSION['id'])) {
        ViewTemplate::baliseTop();
        ViewTemplate::navBar();
        $dataUser = new ModelUser($_SESSION['id']);
        if ($dataUser->getAnnonces()) {
            ViewAnnonce::mesAnnonces('Mes Annonces', $dataUser->getAnnonces());
        } else {
            ViewTemplate::alerte('secondary " style="margin-top:250px;" ', 'Vous n\'avez auccune Annonce,Ajouter une annonce', 'CreationAnnonce.php', 'ici');
        }
    } else {
        header('location:ConnexionUser.php');
    }
} else if (isset($_GET['touteAnnonce'])) {
    ViewTemplate::baliseTop();
    ViewTemplate::navBar();
    ViewAnnonce::mesAnnonces('Les Annonces', ModelAnnonce::annonceListe());
} else {
    header('location:Accueil.php');
}




ViewTemplate::footer();
ViewTemplate::baliseBottom();
?>
<script>
    //activ modal, ajax
    $('.iconeSupp').click(function(e) {
        e.preventDefault()
        let button = $(e.currentTarget)
        console.log(button)
        $('#modalSuppAnnonce').modal('show')
        let idAnnonce = button.data('idannonce')
        let kimodif = button.data('kimodif')
        console.log(idAnnonce, kimodif)
        $('#validSuppAnnonce').click(function(e) {
            console.log('tay')
            generationAjax('SuppAnnonce.php', {
                id: idAnnonce,
                ki: kimodif
            }, 'html', 'listeAnnonce')
            $('#fermeModal').click()
            console.log('tay')
        })
    })
</script>
<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../model/ModelAnnonce.php';
require_once '../model/ModelUser.php';
require_once '../utils/TestPreg.php';
require_once '../utils/telechargement.php';

if (!isset($_SESSION['id'])) {
    header('location:ConnexionUser.php');
} else {



    if (isset($_POST['id'])) {
        $donnee = [$_POST['id'], $_POST['ki']];
        $type = ['id', 'role'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {

            if ($donneeOk['donnee']['role']) {

                ModelAnnonce::suppAnnonce($donneeOk['donnee']['id']);


                $dataUser = new ModelUser($_SESSION['id']);
                ViewAnnonce::retourMesAnnonces($dataUser->getAnnonces());
            } else {
                ModelAnnonce::suppAnnonce($donneeOk['donnee']['id']);
                ViewAnnonce::retourMesAnnonces(ModelAnnonce::annonceListe());
            }
        } else {
            ViewTemplate::alerte('secondary', 'donne corompue', '', '');
        }
    } else {
        header('location:Accueil.php');
    }
}
?>
<script>
    //Gestion hover supp et modif type de bien
    $(".suppTypeBien span, .iconeSupp span").hover(
        function(e) {
            $(this).addClass("text-danger");
        },
        function(e) {
            $(this).removeClass("text-danger");
        }
    );
    $(".modifTypeBien span, .iconeModif span").hover(
        function(e) {
            $(this).addClass("text-success");
        },
        function(e) {
            $(this).removeClass("text-success");
        }
    );


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
<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../view/ViewInscription.php';
require_once '../model/ModelAnnonce.php';
require_once '../utils/TestPreg.php';
if (!isset($_SESSION['id'])) {
    header('location:Accueil.php');
} else {
    $user = new ModelUser($_SESSION['id']);
    ViewTemplate::baliseTop();
    ViewTemplate::navBar();
    ViewTemplate::baliseMain(1);

    if (isset($_POST['validerModifProfil'])) {
        $donnee = [$_POST['inscriNom'], $_POST['inscriPrenom'], $_POST['inscriMail'], $_POST['inscriTel'], $_POST['inscriMdp']];
        $typeTest = ['nom', 'prenom', 'email', 'tel', 'mdp'];
        $donneeOk = testPreg::testInput($donnee, $typeTest);
        if ($donneeOk['ok']) {
            $donneeOk = $donneeOk['donnee'];
            $user->setNom($donneeOk['nom'])->setPrenom($donneeOk['prenom'])->setMail($donneeOk['email'])->setTel($donneeOk['tel'])->setPass(password_hash($donneeOk['mdp'], PASSWORD_DEFAULT))->modifUser();
            ViewInscription::voirProfil($_SESSION['id']);
        } else {
            ViewTemplate::alerte('secondary" style="margin-top:150px;"', 'Donnee Corompue', '', '');
        }
    } else {
        ViewInscription::voirProfil($_SESSION['id']);
    }
    $user->getRole() ? ViewInscription::listeUser() : '';
    ViewTemplate::baliseMain(0);
    ViewTemplate::footer();
    ViewTemplate::baliseBottom();
}

?>
<script>
    $('#lienListeUser').click(function(e) {
        $('#monProfil').addClass('d-none');
        $('#listeUser').removeClass('d-none').hide().fadeIn('slow');
    })
    $('#lienMonProfil').click(function(e) {
        $('#listeUser').addClass('d-none');
        $('#monProfil').removeClass('d-none').hide().fadeIn('slow');
    })

    //script desactivation compte par admin
    $('.activeDesactive').click(function(e) {
        e.preventDefault()
        let button = $(e.currentTarget)
        let idUser = button.data('iduser')
        let actif = button.data('actif')
        console.log(idUser, actif)
        if (actif) {
            console.log('tay');
            generationAjax('ActiveDesactive.php', {
                desactive: idUser
            }, 'html', 'tay');
            $(this).toggleClass('lientay');
            ($(this).parent()).parent().toggleClass('bg-danger')
        } else {
            console.log('arsene');
            generationAjax('ActiveDesactive.php', {
                active: idUser
            }, 'html', 'tay');
            $(this).toggleClass('lientay');
            ($(this).parent()).parent().toggleClass('bg-danger')
        }
    })

    //script atribution role admin par admin 
    $('.admin').click(function(e) {
        e.preventDefault()
        let button = $(e.currentTarget)
        let idUser = button.data('iduser')
        let role = button.data('role')
        console.log(idUser, role)
        if (role) {
            console.log('tay');
            generationAjax('ActiveDesactive.php', {
                prendAdmin: idUser
            }, 'html', 'tay');
            $(this).toggleClass('text-warning');
            
        } else {
            console.log('arsene');
            generationAjax('ActiveDesactive.php', {
                rendAdmin: idUser
            }, 'html', 'tay');
            $(this).toggleClass('text-warning');
            
        }
    })
</script>
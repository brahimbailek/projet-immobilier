<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewTypeBiens.php';
require_once '../utils/TestPreg.php';
require_once '../model/ModelTypeBien.php';

if (isset($_POST['idSupp'])) {
    $donnee = [$_POST['idSupp']];
    $type = ['id'];
    $donneeok = testPreg::testInput($donnee, $type);
    if ($donneeok['ok']) {
        $donneeok = $donneeok['donnee'];
        ModelTypeBien::suppType($donneeok['id']);
        ViewTypeBiens::listeTypeBiens2();
    } else {
        ViewTemplate::alerte('danger', 'erreur de securite', 'TypeBiens.php', 'retour');
    }
} else {
    header('location:Accueil.php');
}
?>
<script>
    $('.suppTypeBien span').hover(function(e) {
        $(this).addClass('text-danger')
    }, function(e) {
        $(this).removeClass('text-danger')
    })
    $('.modifTypeBien span').hover(function(e) {
        $(this).addClass('text-success')
    }, function(e) {
        $(this).removeClass('text-success')
    })
    $('.suppTypeBien').click(function(e) {
        e.preventDefault();

        console.log($(this).attr('data-idType'))
        let donnee = {
            idSupp: $(this).attr('data-idType')
        }
        generationAjax('SuppType.php', donnee, 'html', 'majAjax')

    })
</script>
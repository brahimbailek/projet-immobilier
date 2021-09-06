<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../utils/TestPreg.php';
require_once '../model/ModelAnnonce.php';
require_once '../utils/constante.php';


if (isset($_POST['idAn'])) {
    $donnee = [$_POST['idAn'], $_POST['nomImg']];
    $type = ['id', 'nomImg'];
    $donneeok = testPreg::testInput($donnee, $type);
    if ($donneeok['ok']) {
        $donneeok = $donneeok['donnee'];
        $photo = json_decode(ModelAnnonce::annonceViaId($donneeok['id'])['photos'], true);
        unset($photo[array_search($donneeok['nomImg'], $photo)]);
        ModelAnnonce::suppImg(json_encode($photo), $donneeok['nomImg'], $donneeok['id']);
        ViewAnnonce::listeImg(json_decode(ModelAnnonce::annonceViaId($donneeok['id'])['photos'], true));
    } else {
        ViewTemplate::alerte('danger', 'erreur de securite', 'TypeBiens.php', 'retour');
    }
} else {
    header('location:Accueil.php');
}
?>
<script>
    $("#ajoutPhoto").click(function(e) {
        $("#photos").click();
    })
</script>
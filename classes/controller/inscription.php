<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewInscription.php';
require_once '../model/ModelUser.php';
require_once '../utils/TestPreg.php';
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header('location:Accueil.php');
    exit();
} else {
    ViewTemplate::baliseTop();

    ViewTemplate::navBar();
    if (isset($_POST['validerInscription'])) {
        $donnee = [$_POST['inscriNom'], $_POST['inscriPrenom'], $_POST['inscriMail'], $_POST['inscriTel'], $_POST['inscriMdp']];
        $typeTest = ['nom', 'prenom', 'email', 'tel', 'mdp'];
        $donneeOk = testPreg::testInput($donnee, $typeTest);
        if ($donneeOk['ok']) {
            $donneeOk = $donneeOk['donnee'];
            if (ModelUser::getByMail($donneeOk['email'])) {
                ViewInscription::reponseToken($code, $donneeOk['email'], 0);
            } else {
                $code = uniqid();
                ModelUser::ajoutUser($donneeOk['nom'], $donneeOk['prenom'], $donneeOk['email'], $donneeOk['tel'], password_hash($donneeOk['mdp'], PASSWORD_DEFAULT), $code);
                ViewInscription::reponseToken($code, $donneeOk['email'], 1);
            }
        } else {
            ViewInscription::formInscription();
            ViewTemplate::alerte('secondary', $donneeOk['retour'], '', '');
        }
    } else {
        ViewInscription::formInscription();
    }


    ViewTemplate::footer();
    ViewTemplate::baliseBottom();
}
?>
<script>
    //validation client
    let type = ['nom', 'prenom', 'tel', 'email', 'mdp']
    validationClient('formInscription', type)
</script>
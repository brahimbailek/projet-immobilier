<?php
 session_start();
require_once '../model/ModelUser.php';
require_once '../utils/TestPreg.php';


if (isset($_GET['code']) && isset($_GET['mail'])) {
    $donnee = [$_GET['code'], $_GET['mail']];
    $type = ['code', 'mail'];
    $donneeOk = testPreg::testInput($donnee, $type);
    $codeParUrl = $donneeOk['donnee']['code'];
    $codeParBDD = ModelUser::getByMail($donneeOk['donnee']['mail'])['token'];

   
    if ($codeParUrl == $codeParBDD) {
        ModelUser::confirmCompte($donneeOk['donnee']['mail']);
        header('location:ConnexionUser.php?mailValider=1');
    }
}

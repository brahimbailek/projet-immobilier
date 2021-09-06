<?php
require_once '../model/ModelUser.php';

if (isset($_POST['desactive'])) {
    ModelUser::modifColonneUser('actif', '0', $_POST['desactive']);
} else if (isset($_POST['active'])) {
    ModelUser::modifColonneUser('actif', '1', $_POST['active']);
} else if (isset($_POST['prendAdmin'])) {
    ModelUser::modifColonneUser('role', '0', $_POST['prendAdmin']);
} else if (isset($_POST['rendAdmin'])) {
    ModelUser::modifColonneUser('role', '1', $_POST['rendAdmin']);
} else {
    header('location:Accueil.php');
}

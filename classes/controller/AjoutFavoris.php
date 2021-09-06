<?php
require_once '../model/ModelFavoris.php';


if (isset($_POST['ajoutFav'])) {
    ModelFavoris::ajoutFavoris($_POST['idUser'], $_POST['ajoutFav']);
} else if (isset($_POST['suppFav'])) {
    ModelFavoris::suppFavoris($_POST['idUser'], $_POST['suppFav']);
} else {
    header('location:Accueil.php');
}

<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../utils/TestPreg.php';

ViewTemplate::baliseTop();
ViewTemplate::navBar();
ViewAnnonce::mesAnnonces('Annonces à Vendre', ModelAnnonce::annonceListeVL(0));
ViewTemplate::footer();
ViewTemplate::baliseBottom();

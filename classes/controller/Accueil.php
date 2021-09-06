<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewAnnonce.php';
require_once '../utils/TestPreg.php';

ViewTemplate::baliseTop();

ViewTemplate::navBar();
ViewAnnonce::grosCarousel(1,2,3);


if (isset($_GET['alert'])) {
    $donnee = [$_GET['alert']];
    $type = ['alert'];
    $donneeOk = testPreg::testInput($donnee, $type);
    if ($donneeOk['ok']) {
        ViewTemplate::alerte('secondary text-danger mt-5', $donneeOk['donnee']['alert'], '', '');
    }
}
ViewTemplate::baliseMain(1);
ViewTemplate::nosServices();
ViewAnnonce::derniereAnonce();


ViewTemplate::baliseMain(0);

ViewTemplate::footer();
ViewTemplate::baliseBottom();
?>

<?php
require_once 'connexion.php';
class ModelFavoris
{

    //ajout  d'un nouveau type de bien par l'admin
    public static function ajoutFavoris($idUser, $idAnnonce)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("INSERT INTO favoris VALUES (?,?)");
        $rPrep->execute([$idUser, $idAnnonce]);
    }

    //suuppr favoris
    public static function suppFavoris($idUser, $idAnnonce)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("DELETE FROM favoris WHERE user_id=? AND annonce_id=?");
        $rPrep->execute([$idUser, $idAnnonce]);
    }


    public static function verifieSiFav($idUser, $idAnnonce)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM favoris WHERE user_id=? AND annonce_id=?");
        $rPrep->execute([$idUser, $idAnnonce]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }
}

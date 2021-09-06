<?php
require_once 'connexion.php';

class ModelTypeBien
{
    //ajout  d'un nouveau type de bien par l'admin
    public static function ajoutType($type)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("INSERT INTO typebien VALUES (null,?)");
        $rPrep->execute([$type]);
    }

    //berification de l'existence d'un type de bien

    public static function typebienViaLibele($type)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM typebien WHERE libelle=?");
        $rPrep->execute([$type]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }
    public static function typebienViaId($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM typebien WHERE id=?");
        $rPrep->execute([$id]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }

    //recupe liste tout les rype de bien
    public static function typeBiens()
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM typebien");
        $rPrep->execute();
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }

    //suppression type
    public static function suppType($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("DELETE FROM typebien WHERE id=?");
        $rPrep->execute([$id]);
    }

    //modif Type
    public static function modifType($id, $libelle)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE typebien SET libelle=? WHERE id=?");
        $rPrep->execute([$libelle, $id]);
    }
}

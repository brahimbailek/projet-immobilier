<?php
require_once 'connexion.php';
require_once '../utils/telechargement.php';
class ModelAnnonce
{

    public static function ajoutAnnonce($titre, $type, $typeBien, $surface, $prix, $description, $adresse, $cp, $ville, $imgJson, $userId)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("INSERT INTO annonce VALUES (null,:titre,:descriptions,:surface,:photos,:adresse,:ville,:cp,:prix,:type,:typeBien_id)");
        $rPrep->execute([
            ':titre' => $titre,
            ':descriptions' => $description,
            ':surface' => $surface,
            ':photos' => $imgJson,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':cp' => $cp,
            ':prix' => $prix,
            ':type' => $type,
            ':typeBien_id' => $typeBien
        ]);
        $idAnnonce = $datay->lastInsertId();
        $rPrep2 = $datay->prepare('INSERT INTO user_annonce VALUES(:userId,:annonceId)');
        $rPrep2->execute([':userId' => $userId, ':annonceId' => $idAnnonce]);
        return $idAnnonce;
    }

    //modif Annonce
    public static function modifAnnonce($titre, $type, $typeBien, $surface, $prix, $description, $adresse, $cp, $ville, $imgJson, $id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE annonce SET titre=:titre,descriptions=:descriptions,surface=:surface,photos=:photos,adresse=:adresse,ville=:ville,cp=:cp,prix=:prix,type=:type,type_bien_id=:typeBien_id WHERE id=:id");
        $rPrep->execute([
            ':titre' => $titre,
            ':descriptions' => $description,
            ':surface' => $surface,
            ':photos' => $imgJson,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':cp' => $cp,
            ':prix' => $prix,
            ':type' => $type,
            ':typeBien_id' => $typeBien,
            ':id' => $id
        ]);
    }


    public static function annonceViaId($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce
        INNER JOIN user_annonce
        ON annonce.id=user_annonce.annonce_id
        INNER JOIN user 
        ON user_annonce.user_id=user.id
        WHERE annonce.id=?");
        $rPrep->execute([$id]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }

    //anonce liste
    public static function annonceListe()
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce
        INNER JOIN user_annonce
        ON annonce.id=user_annonce.annonce_id
        INNER JOIN user 
        ON user_annonce.user_id=user.id");
        $rPrep->execute([]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }
    //anonce liste avec parametre
    public static function annonceListeVL($type)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce
        INNER JOIN user_annonce
        ON annonce.id=user_annonce.annonce_id
        INNER JOIN user 
        ON user_annonce.user_id=user.id
        WHERE type=? ");
        $rPrep->execute([$type]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }
    //anonce liste des dernieres annonce
    public static function annonceListederniere()
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce
        INNER JOIN user_annonce
        ON annonce.id=user_annonce.annonce_id
        INNER JOIN user 
        ON user_annonce.user_id=user.id
        ORDER BY annonce_id DESC LIMIT 10");
        $rPrep->execute([]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }

    //supprimer une znnoce
    public static function suppAnnonce($id)
    {
        telechargement::effaceImg(self::annonceViaId($id)['photos']);

        $datay = connexion();
        $rPrep = $datay->prepare("DELETE FROM annonce WHERE annonce.id=?");
        $rPrep->execute([$id]);
        $rPrep2 = $datay->prepare("DELETE FROM user_annonce WHERE user_annonce.annonce_id=?");
        $rPrep2->execute([$id]);
    }

    //supprimer une photo

    public static function suppImg($photoJson, $photoEfface, $annonceId)
    {
        unlink('../../images/' . $photoEfface);
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE annonce SET photos=? WHERE annonce.id=?");
        $rPrep->execute([$photoJson, $annonceId]);
    }

    //modif la photo principal

    public static function modifPhotoP($photop,$photoJson ,$annonceId)
    {
        unlink('../../images/' . $photop);
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE annonce SET photos=? WHERE annonce.id=?");
        $rPrep->execute([$photoJson, $annonceId]);
    }

    //recherche
    public static function recherche($type, $ville, $typeBien, $surfaceMin, $surfaceMax, $prixMax)
    {
        $recherche = "SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce  
        INNER JOIN user_annonce ON annonce.id=user_annonce.annonce_id  
        INNER JOIN user  ON user_annonce.user_id=user.id 
        WHERE type LIKE ? AND cp LIKE ? AND type_bien_id LIKE ? ";
        $type == 0 ? $type = '%%' : '';
        $ville == 0 ? $ville = '%%' : '';
        $typeBien == 0 ? $typeBien = '%%' : '';
        $surfaceMin != 0 ? $recherche .= 'AND (surface BETWEEN ? AND ?) ' : '';
        $prixMax != 0 ? $recherche .= '  AND prix<=?' : '';


        $datay = connexion();
        $rPrep = $datay->prepare($recherche);
        if ($surfaceMin == 0 && $prixMax == 0) {
            $rPrep->execute([$type, $ville, $typeBien]);
        } else if ($surfaceMin == 0) {
            $rPrep->execute([$type, $ville, $typeBien, $prixMax]);
        } else if ($prixMax == 0) {
            $rPrep->execute([$type, $ville, $typeBien, $surfaceMin, $surfaceMax]);
        } else {
            $rPrep->execute([$type, $ville, $typeBien, $surfaceMin, $surfaceMax, $prixMax]);
        }

        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }
}

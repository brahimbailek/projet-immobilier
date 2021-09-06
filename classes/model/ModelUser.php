<?php
require_once 'connexion.php';
class ModelUser
{

    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $pass;
    private $tel;
    private $role;
    private $confirme;
    private $actif;
    private $token;
    private $annonces = [];
    private $favoris = [];

    public function __construct($id)
    {
        $donneeUser = $this->getById($id);
        $this->id = $id;
        $this->nom = $donneeUser['nom'];
        $this->prenom = $donneeUser['prenom'];
        $this->mail = $donneeUser['mail'];
        $this->pass = $donneeUser['pass'];
        $this->tel = $donneeUser['tel'];
        $this->role = $donneeUser['role'];
        $this->confirme = $donneeUser['confirme'];
        $this->actif = $donneeUser['actif'];
        $this->token = $donneeUser['token'];
        $this->annonces = $this->getUserAnnonceById($id);
        $this->favoris = $this->getUserFavorisById($id);
    }





    // ajoute utilisateur via form CREATE
    static function ajoutUser($nom, $prenom, $mail, $tel, $mdp, $code)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("INSERT INTO user (nom,prenom,mail,pass,tel,token) VALUES (:nom,:prenom,:mail,:mdp,:tel,:code)");
        $rPrep->execute([':nom' => $nom, ':prenom' => $prenom, ':mail' => $mail, ':tel' => $tel, ':mdp' => $mdp, ':code' => $code]);
    }
    // mODIF USER
    function modifUser()
    {
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE user SET nom=:nom, prenom=:prenom, mail=:mail, tel=:tel, pass=:mdp WHERE id=:id ");
        $rPrep->execute([':nom' => $this->nom, ':prenom' => $this->prenom, ':mail' => $this->mail, ':tel' => $this->tel, ':mdp' =>$this->pass, ':id' => $this->id]);
    }

    //recup user via mail

    public static function getByMail($mail)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM user WHERE mail=?");
        $rPrep->execute([$mail]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }

    //recup user via id

    public static function getById($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM user WHERE id=?");
        $rPrep->execute([$id]);
        return $rPrep->fetch(pdo::FETCH_ASSOC);
    }

    //recup annonce user via id

    public static function getUserAnnonceById($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_id,nom,prenom,mail,tel FROM annonce
        INNER JOIN user_annonce
        ON annonce.id=user_annonce.annonce_id
        INNER JOIN user 
        ON user.id=user_annonce.user_id
        WHERE user.id=?");
        $rPrep->execute([$id]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }
    //recup annonce user favoris via id

    public static function getUserFavorisById($id)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT favoris.annonce_id,titre,descriptions,surface,photos,adresse,ville,cp,prix,type,type_bien_id,user_annonce.user_id,nom,prenom,mail,tel,favoris.user_id as fav_user_id FROM favoris
        INNER JOIN annonce
        ON annonce.id=favoris.annonce_id
        INNER JOIN user 
        ON user.id=favoris.user_id
        INNER JOIN user_annonce
        ON user_annonce.annonce_id=annonce.id
      
        WHERE favoris.user_id=?");
        $rPrep->execute([$id]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }

    //confirme compte via token
    public static function confirmCompte($mail)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE user SET confirme='1' WHERE mail=? ");
        $rPrep->execute([$mail]);
    }
    //modif Colonne
    public static function modifColonneUser($colonne, $valeur, $mail)
    {
        $datay = connexion();
        $rPrep = $datay->prepare("UPDATE user SET $colonne=? WHERE mail=? ");
        $rPrep->execute([$valeur, $mail]);
    }

    //liste user
    public static function listeUser()
    {
        $datay = connexion();
        $rPrep = $datay->prepare("SELECT * FROM user ");
        $rPrep->execute([]);
        return $rPrep->fetchAll(pdo::FETCH_ASSOC);
    }

    //GETTER user
    public function getId()
    {
        return $this->id;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getTel()
    {
        return $this->tel;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getConfirme()
    {
        return $this->confirme;
    }
    public function getActif()
    {
        return $this->actif;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getAnnonces()
    {
        return $this->annonces;
    }
    public function getFavoris()
    {
        return $this->favoris;
    }


    //SETTER User
    public function setNom($newNom)
    {
        $this->nom = $newNom;

        return $this;
    }
    public function setPrenom($newPrenom)
    {
        $this->prenom = $newPrenom;
        return $this;
    }
    public function setMail($newMail)
    {
        $this->mail = $newMail;
        return $this;
    }
    public function setPass($newPass)
    {
        $this->pass = $newPass;
        return $this;
    }
    public function setTel($newTel)
    {
        $this->tel = $newTel;
        return $this;
    }
    public function setRole($newRole)
    {
        $this->role = $newRole;
        return $this;
    }
    public function setConfirme($newConfirme)
    {
        $this->confirme = $newConfirme;
        return $this;
    }
    public function setActif($newActif)
    {
        $this->actif = $newActif;
        return $this;
    }
    public function setToken($newToken)
    {
        $this->token = $newToken;
        return $this;
    }
    public function setAnnonces($newAnnonces)
    {
        $this->annonces = $newAnnonces;
        return $this;
    }
    public function setFavoris($newFavoris)
    {
        $this->favoris = $newFavoris;
        return $this;
    }
}

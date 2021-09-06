<?php
function connexion()
{
    $servername = "localhost"; //utiliser le nom du serveur fourni par l'hebergeur 
    $username = "root"; //username pour acceder a la base
    $password = ""; //mot de passe d'acces a la base
    $dbname = "immo"; // nom de la base de donnée

    try {
        $idcon = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        return $idcon;
    } catch (PDOException $a) {
        echo "Connection failed: " . $a->getMessage();
        return FALSE;
        exit();
    }
}

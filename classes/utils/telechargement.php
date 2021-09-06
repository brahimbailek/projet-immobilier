<?php
require_once 'constante.php';
class telechargement
{
    //telechargement image ype bien 

    public static function telecharge($fichier, $extension, $dossierCible, $nom)
    {
        $fichier_dir = ROOT_DIR . '/' . $dossierCible . '/';
        $fichier_basename = $nom . '.jpg';
        $fichier_chemin = $fichier_dir . $fichier_basename;
        $fichier_ok = 1;
        $fichierType = strtolower(pathinfo($fichier_chemin, PATHINFO_EXTENSION));


        // Check if file already exists + renomage 
        // $fichier_basename = substr(md5($fichier_basename), 10);
        // $fichier_chemin = $fichier_dir . $fichier_basename;
        // while (file_exists($fichier_chemin . ".$fichierType")) {
        //     $fichier_basename = md5($fichier_basename);
        //     $fichier_chemin = $fichier_dir . $fichier_basename . ".$fichierType";
        // }

        //check error $file
        switch ($fichier['error']) {
            case 1:
                return ['ok' => 0, 'alert' => 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini'];
            case 2:
                return ['ok' => 0, 'alert' => 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.'];
            case 3:
                return ['ok' => 0, 'alert' => ' Le fichier n\'a été que partiellement téléchargé. '];
            case 4:
                return ['ok' => 0, 'alert' => 'Aucun fichier n\'a été téléchargé.'];
            case 6:
                return ['ok' => 0, 'alert' => 'Un dossier temporaire est manquant. '];
            case 7:
                return ['ok' => 0, 'alert' => 'Échec de l\'écriture du fichier sur le disque.'];
            case 8:
                return ['ok' => 0, 'alert' => 'Une extension PHP a arrêté l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider. '];
        }
        // Check file size
        if ($fichier["size"] > 10000000) {
            return ['ok' => 0, 'alert' => ' Sorry, your file is too large.'];
            $fichier_ok = 0;
        }
        // Allow certain file formats
        if (!in_array($fichierType, $extension)) {
            return ['ok' => 0, 'alert' => ' Sorry, extension non autorisé.'];
            $fichier_ok = 0;
        }


        // Check if $fichier_Ok is set to 0 by an error
        if ($fichier_ok == 0) {
            echo ' <div class="alert alert-primary text-danger text-center" role="alert"> your file was not uploaded.</div>';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fichier["tmp_name"], $fichier_chemin)) {

                return ['ok' => 1, 'nom' => $fichier_basename, 'alert' => ' The file ' . htmlspecialchars(basename($fichier_basename)) . ' has been uploaded.'];
            } else {
                return ['ok' => 0, 'alert' => ' Sorry, there was an error uploading your file.'];
            }
        }
    }

    // telechargement image annonce 

    public static function telecharge2($fichier, $extension, $dossierCible)
    {
        $fichier_dir = ROOT_DIR . '/' . $dossierCible . '/';
        $fichier_basename = basename(htmlspecialchars($fichier['name']));
        $fichier_chemin = $fichier_dir . $fichier_basename;
        $fichier_ok = 1;
        $fichierType = strtolower(pathinfo($fichier_chemin, PATHINFO_EXTENSION));


        // Check if file already exists + renomage 

        $fichier_chemin = $fichier_dir . $fichier_basename;
        while (file_exists($fichier_chemin)) {
            $fichier_basename = mt_rand(0, 9) . $fichier_basename;
            $fichier_chemin = $fichier_dir . $fichier_basename;
        }

        //check error $file
        switch ($fichier['error']) {
            case 1:
                return ['ok' => 0, 'alert' => 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini'];
            case 2:
                return ['ok' => 0, 'alert' => 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.'];
            case 3:
                return ['ok' => 0, 'alert' => ' Le fichier n\'a été que partiellement téléchargé. '];
            case 4:
                return ['ok' => 0, 'alert' => 'Aucun fichier n\'a été téléchargé.'];
            case 6:
                return ['ok' => 0, 'alert' => 'Un dossier temporaire est manquant. '];
            case 7:
                return ['ok' => 0, 'alert' => 'Échec de l\'écriture du fichier sur le disque.'];
            case 8:
                return ['ok' => 0, 'alert' => 'Une extension PHP a arrêté l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider. '];
        }

        // Check file size
        if ($fichier["size"] > 50000000) {
            return ['ok' => 0, 'alert' => ' Sorry, your file is too large.', 'nom' => null];
            $fichier_ok = 0;
        }
        // Allow certain file formats
        if (!in_array($fichierType, $extension)) {
            return ['ok' => 0, 'alert' => ' Sorry, extension non autorisé.', 'nom' => null];
            $fichier_ok = 0;
        }
        // Check if $fichier_Ok is set to 0 by an error
        if ($fichier_ok == 0) {
            return ['ok' => 0, 'alert' => '  your file was not uploaded.', 'nom' => null];
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fichier["tmp_name"], $fichier_chemin)) {

                return ['ok' => 1, 'nom' => $fichier_basename, 'alert' => 'The file ' . htmlspecialchars(basename($fichier_basename)) . ' has been uploaded.'];
            } else {
                echo ['ok' => 0, 'alert' => ' Sorry, there was an error uploading your file.'];
            }
        }
    }


    public static function effaceImg($photoJson)
    {
        $photos = json_decode($photoJson, true);
        foreach ($photos as $ph) {
            unlink('../../images/' . $ph);
        }
    }
}
$oualid = 458;
<?php
class ViewInscription
{
    public static function formInscription()
    { ?>

        <main id="main">

            <!-- ======= Intro Single ======= -->
            <section class="intro-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="title-single-box">
                                <h1 class="title-single">Je veux M'inscrire</h1>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="Accueil.php">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        M'inscrire
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- FORMULAIRE D4INSCRIPTION  -->
                    <div>
                        <form class="row" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="formInscription" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriNom'] : '' ?>" id="inscriNom" name="inscriNom">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Prenom">Prenom</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriPrenom'] : '' ?>" id="inscriPrenom" name="inscriPrenom">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tel">Numero de telephone</label>
                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriTel'] : '' ?>" id="inscriTel" name="inscriTel">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput1">Adresse Email</label>
                                <input type="email" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriMail'] : '' ?>" id="inscriMail" name="inscriMail" placeholder="name@example.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mdp">Mot de Passe</label>
                                <input type="password" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriMdp'] : '' ?>" id="inscriMdp" name="inscriMdp">
                            </div>


                            <div class="col-md-12 mt-2">
                                <button type="submit" name="validerInscription" id="validerInscription" class="btn btn-success">valider</button>
                                <button type="reset" class="btn btn-secondary ml-2">effacer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </section><!-- End Intro Single-->
        </main>
    <?php  }

    public static function reponseToken($code, $mail, $ok)
    { ?>
        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single">Inscription Prise en compte</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="Accueil.php">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    M'inscrire
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php if ($ok == 1) { ?>
                    <div class="text-center mt-5">
                        Pour valider votre inscription, veuillez cliquez <a class="text-success" href="ValidationInscription.php?code=<?php echo $code ?>&mail=<?php echo $mail ?>">ici</a>
                    </div> <?php } else { ?>
                    <div class="text-center mt-5">
                        Cet utilisateur existe deja, pour reessayer cliquez <a class="text-success" href="inscription.php">ici</a>
                    </div>
                <?php } ?>
            </div>
        </section><!-- End Intro Single-->
        </main>
    <?php }
    public static function reinitMdp($a, $b)
    { ?>

        <main id="main">

            <!-- ======= Intro Single ======= -->
            <section class="intro-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="title-single-box">
                                <h1 class="title-single">Reinitialisation du Mot de Passe</h1>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="Accueil.php">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Nouveau Mot de passe
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- FORMULAIRE De modif mdp  -->
                    <?php if ($a) { ?>
                        <div>
                            <form class="row" id="modifMdpOublie" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

                                <div class="form-group col-md-6">
                                    <label for="mdp">Mot de Passe</label>
                                    <input type="password" class="form-control" id="reinitMpd" name="reinitMpd">
                                </div>
                                <input type="hidden" name="mail" value="<?php echo isset($_POST['validerReinitMpd']) ? $_POST['mail'] : $b ?>">

                                <div class="col-md-12 mt-2">
                                    <button type="submit" name="validerReinitMpd" id="validerReinitMpd" class="btn btn-success">valider</button>
                                    <button type="reset" class="btn btn-secondary ml-2">effacer</button>
                                </div>
                            </form>

                        </div> <?php } else {
                                ViewTemplate::alerte('secondary', 'donnée corrompue', '', '');
                            } ?>
                </div>
            </section><!-- End Intro Single-->
        </main>
    <?php
    }
    public static function voirProfil($id)
    {
        $user = new ModelUser($id);
    ?><div id="monProfil">
            <!-- ======= Intro Single ======= -->
            <section class="intro-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="title-single-box">
                                <h1 class="title-single"><?= $user->getNom() . ' ' . $user->getPrenom() ?></h1>
                                <span class="color-text-a">Mon Compte</span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="Accueil.php">Accueil</a>
                                    </li>
                                    <?php if ($user->getRole()) { ?>
                                        <li class="breadcrumb-item">
                                            <a id="lienListeUser" href="#">Admin</a>
                                        </li>
                                    <?php } ?>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?= $user->getNom() . ' ' . $user->getPrenom() ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section><!-- End Intro Single -->
            <section class="agent-single">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="agent-avatar-box">
                                        <img src="../../assets/img/agent-7.jpg" alt="" class="agent-avatar img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-5 section-md-t3">
                                    <div class="agent-info-box">
                                        <div class="agent-title">
                                            <div class="title-box-d">
                                                <h3 class="title-d"><?= $user->getNom() . ' ' . $user->getPrenom() ?>
                                                    <br>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="agent-content mb-3">
                                            <p class="content-d color-text-a">

                                            </p>
                                            <div class="info-agents color-a">

                                                <p>
                                                    <strong>Mobile: </strong>
                                                    <span class="color-text-a"> <?= $user->getTel() ?></span>
                                                </p>
                                                <p>
                                                    <strong>Email: </strong>
                                                    <span class="color-text-a"> <?= $user->getMail() ?></span>
                                                </p>
                                                <p>
                                                    <strong>edit: </strong>
                                                    <a href="#" data-toggle="modal" data-target="#modalModifProfil" class=" pl-5"> <i class="fas fa-user-edit fa-3x"></i> </a>
                                                </p>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalModifProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="formModifProfil" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group ">
                                                <label for="nom">Nom</label>
                                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriNom'] : $user->getNom() ?>" id="inscriNom" name="inscriNom">
                                            </div>
                                            <div class="form-group ">
                                                <label for="Prenom">Prenom</label>
                                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriPrenom'] : $user->getPrenom() ?>" id="inscriPrenom" name="inscriPrenom">
                                            </div>
                                            <div class="form-group ">
                                                <label for="tel">Numero de telephone</label>
                                                <input type="text" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriTel'] : $user->getTel() ?>" id="inscriTel" name="inscriTel">
                                            </div>
                                            <div class="form-group ">
                                                <label for="exampleFormControlInput1">Adresse Email</label>
                                                <input type="email" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriMail'] : $user->getMail() ?>" id="inscriMail" name="inscriMail" placeholder="name@example.com">
                                            </div>
                                            <div class="form-group ">
                                                <label for="mdp">Mot de Passe</label>
                                                <input type="password" class="form-control" value="<?php echo isset($_POST['inscriNom']) ? $_POST['inscriMdp'] : '' ?>" id="inscriMdp" name="inscriMdp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="validerModifProfil" id="validerModifProfil" class="btn btn-success">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </section><!-- End Agent Single -->
        </div>
    <?php }

    public static function listeUser()
    {
        $user = ModelUser::listeUser();
    ?>
        <div id="listeUser" class="d-none">
            <section class="intro-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="title-single-box">
                                <h1 class="title-single">Liste Des Users</h1>
                                <span class="color-text-a">Grille des users</span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="Accueil.php">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a id="lienMonProfil" href="#">Mon Profil</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Admin
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section><!-- End Intro Single-->

            <!-- ======= Agents Grid ======= -->
            <section class="agents-grid grid">
                <div class="container">
                    <div class="row">
                        <?php foreach ($user as $moi) {
                            if ($moi['id'] == $_SESSION['id']) {
                                continue;
                            } else { ?>


                                <div class="col-md-4">
                                    <div class="card-box-d">
                                        <div class="card-img-d">
                                            <img src="../../assets/img/agent-4.jpg" alt="" class="img-d img-fluid">
                                        </div>
                                        <div class="card-overlay card-overlay-hover <?= $moi['actif'] ? '' : 'bg-danger' ?>">
                                            <div class="card-header-d">
                                                <div class="card-title-d align-self-center">
                                                    <h3 class="title-d">
                                                        <a href="#" class="link-two"> <?= $moi['nom']  ?>
                                                            <br> <?= $moi['prenom'] ?></a>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body-d">
                                                <p class="content-d color-text-a">

                                                </p>
                                                <div class="info-agents color-a">
                                                    <p>
                                                        <strong>Phone: </strong> <?= $moi['tel'] ?>
                                                    </p>
                                                    <p>
                                                        <strong>Email: </strong><?= $moi['mail'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer-d d-flex justify-content-around">
                                                <a href="" data-actif="<?= $moi['actif'] ?>" class="activeDesactive <?= $moi['actif'] ? 'lientay' : '' ?>" data-iduser="<?= $moi['mail'] ?>"><i class="fas fa-window-close fa-3x"></i></a>
                                                <a href="" data-role="<?= $moi['role'] ?>" class="admin <?= $moi['role'] ? 'text-warning' : '' ?>" data-iduser="<?= $moi['mail'] ?>"><i class="fas fa-crown fa-3x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php }
                        } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="pagination-a">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <span class="ion-ios-arrow-back"></span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="#">
                                            <span class="ion-ios-arrow-forward"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section><!-- End Agents Grid-->

        </div>
<?php }
}

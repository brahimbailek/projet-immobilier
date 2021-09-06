<?php
require_once '../model/ModelAnnonce.php';
require_once '../model/ModelTypeBien.php';
require_once '../model/ModelUser.php';
class ViewTemplate
{

    public static function baliseTop()
    {
?>
        <!DOCTYPE html>

        <html>

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1  shrink-to-fit=no" />
            <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css" />
            <link rel="stylesheet" href="../../css/fontawesome/all.min.css" />
            <!-- Favicons -->
            <link href="../../assets/img/logtay.png" rel="icon">
            <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
            <!-- Vendor CSS Files -->
            <link href="../../assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
            <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
            <link href="../../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

            <!-- Template Main CSS File -->
            <link href="../../assets/css/style.css" rel="stylesheet">




            <link rel="stylesheet" href="../../css/styles.css" />
            <title>HTML</title>
        </head>

        <body>


        <?php }

    public static function baliseBottom()
    { ?>

            <script src="../../js/jquery/jquery-3.5.1.min.js"></script>
            <script src="../../js/bootstrap/bootstrap.min.js"></script>
            <script src="../../js/fontawesome/all.min.js"></script>
            <!-- Vendor JS Files -->
            <script src="../../assets/vendor/php-email-form/validate.js"></script>
            <script src="../../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
            <script src="../../assets/vendor/scrollreveal/scrollreveal.min.js"></script>
            <!-- Template Main JS File -->
            <script src="../../assets/js/main.js"></script>
            <script src="../../js/testPreg.js"></script>
            <script src="../../js/jsTay.js"></script>

        </body>

        </html>

    <?php  }

    public static function navBar()
    {
        $data = ModelAnnonce::annonceListe();
        $dataTypeBien = ModelTypeBien::typeBiens();
    ?>
        <!-- ======= Property Search Section ======= -->
        <div class="click-closed"></div>
        <!--/ Form Search Star /-->
        <div class="box-collapse">
            <div class="title-box-d">
                <h3 class="title-d">Rechercher une Annonce</h3>
            </div>
            <span class="close-box-collapse right-boxed ion-ios-close"></span>
            <div class="box-collapse-wrap form">
                <form class="form-a" action="Recherche.php" method="POST">
                    <div class="row">
                        <!-- <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label for="Type">Keyword</label>
                                <input type="text" class="form-control form-control-lg form-control-a" placeholder="Keyword">
                            </div>
                        </div> -->
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select class="form-control form-control-lg form-control-a" name="Type" id="Type">
                                    <option value="0" <?= isset($_POST['recherche']) && $_POST['Type'] == 0 ? 'selected' : '' ?>>Tous</option>
                                    <option value="1" <?= isset($_POST['recherche']) && $_POST['Type'] == 1 ? 'selected' : '' ?>>A Louer</option>
                                    <option value="2" <?= isset($_POST['recherche']) && $_POST['Type'] == 2 ? 'selected' : '' ?>>A Vendre</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <select class="form-control form-control-lg form-control-a" name="ville" id="ville">
                                    <option value="0" <?= isset($_POST['recherche']) && $_POST['ville'] == 0 ? 'selected' : '' ?>>Partout</option>
                                    <?php foreach ($data as $annonce) { ?> <option value="<?= $annonce['cp'] ?>" <?= isset($_POST['recherche']) && $_POST['ville'] == $annonce['cp'] ? 'selected' : '' ?>><?= $annonce['ville'] ?> </option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="bedrooms">Type d'offre</label>
                                <select class="form-control form-control-lg form-control-a" name="typeBien" id="typeBien">
                                    <option value="0" <?= isset($_POST['recherche']) && $_POST['typeBien'] == 0 ? 'selected' : '' ?>>Tous</option>
                                    <?php foreach ($dataTypeBien as $typebien) { ?> <option value="<?= $typebien['id'] ?>" <?= isset($_POST['recherche']) && $_POST['typeBien'] == $typebien['id'] ? 'selected' : '' ?>><?= $typebien['libelle'] ?> </option> <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2 row">
                            <div class="form-group col-md-4">
                                <label for="garages">surface min</label>
                                <input type="number" name="surfaceMin" id="surfaceMin" min="1" class="form-control  form-control-lg form-control-a" value="<?= isset($_POST['recherche']) ? $_POST['surfaceMin'] : '9'  ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="surface">surface max</label>
                                <input type="number" name="surfaceMax" id="surfaceMax" min="9" class="form-control form-control-lg form-control-a" value="<?= isset($_POST['recherche']) ? $_POST['surfaceMax'] : '50'  ?>">
                            </div>
                            <div class="form-check form-check-inline pt-2">
                                <input class="form-check-input" type="checkbox" name="surfaceC" id="surfaceC" <?= isset($_POST['surfaceC']) ? 'checked' : ''  ?>>
                                <label class="form-check-label" for="surface">Toutes Les Surfaces</label>
                            </div>
                        </div>


                        <div class="col-md-12 mb-2 row">
                            <div class="form-group col-md-7">
                                <label for="prix">Max Price</label>
                                <input type="number" name="prixMax" id="prixMax" min="1" class="form-control form-control-lg form-control-a" value="<?= isset($_POST['recherche']) ? $_POST['prixMax'] : '800'  ?>">
                            </div>
                            <div class="form-check  form-check-inline pt-2">
                                <input class="form-check-input" type="checkbox" name="prixMaxC" id="prixMaxC" <?= isset($_POST['prixMaxC']) ? 'checked' : ''  ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Tout les Prix</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="recherche" class="btn btn-b">Rechercher</button>

                        </div>
                    </div>
                </form>
            </div>
        </div><!-- End Property Search Section -->

        <!-- ======= Header/Navbar ======= -->
        <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top" id="navbartay">
            <div class="container">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a class="navbar-brand text-brand" href="Accueil.php">Log'<span class="color-b">Tay</span></a>
                <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
                    <span class="fa fa-search" aria-hidden="true"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link p-md-2 bg-success text-white rounded-pill" href="CreationAnnonce.php">Deposer une annonce</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Acheter.php">Acheter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Louer.php">louer</a>
                        </li>

                        <?php if (isset($_SESSION['id'])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $_SESSION['nom'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="Profil.php">Mon profil</a>
                                    <a class="dropdown-item" href="Favoris.php">Mes favoris</a>
                                    <a class="dropdown-item" href="Annonce.php?mesAnnonces=1">Mes annonces</a>
                                    <?php if ($_SESSION['role']) { ?> <a class="dropdown-item" href="TypeBiens.php">Les Types de Biens</a> <?php } ?>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="Deconnexion.php" class="nav-link">Deconnexion</a>
                            </li> <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a href="ConnexionUser.php" class="nav-link btn">Connexion</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
                    <span class="fa fa-search" aria-hidden="true"></span>
                </button>
            </div>
        </nav><!-- End Header/Navbar -->


    <?php }
    public static function footer()
    { ?>
        <!-- ======= Footer ======= -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="nav-footer">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="Accueil.php">Accueil</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="Acheter.php">Acheter</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="Louer.php">Louer</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="CreationAnnonce.php">Vendre</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="socials-a">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fab fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fab fa-dribbble" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="copyright-footer">
                            <p class="copyright color-text-a">
                                &copy; Copyright
                                <span class="color-a">Log'Tay</span> All Rights Reserved.
                            </p>
                        </div>
                        <div class="credits">
                            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
          -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!-- End  Footer -->

        <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
        <div id="preloader"></div>
    <?php }

    public static function alerte($type, $message, $lien, $messageLien)
    { ?>
        <div class="alert text-center alert-<?php echo $type ?>" role="alert">
            <?php echo $message ?> <a href="<?php echo $lien ?>"><?php echo $messageLien ?></a>
        </div>
        <?php }

    public static function baliseMain($AouB)
    {
        if ($AouB) { ?>
            <main id="main">
            <?php } else { ?>
            </main><!-- End #main -->
        <?php }
    }

    public static function nosServices()
    { ?>
        <!-- ======= Services Section ======= -->
        <section class="section-services section-t8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-wrap d-flex justify-content-between">
                            <div class="title-box">
                                <h2 class="title-a">Nos Services</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-box-c foo">
                            <div class="card-header-c d-flex">
                                <div class="card-box-ico">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                                <div class="card-title-c align-self-center">
                                    <h2 class="title-c">Log'Tay.fr</h2>
                                </div>
                            </div>
                            <div class="card-body-c">
                                <p class="content-c">
                                    Une plateforme de suivi en ligne fluide qui est mis a jour regulierement. Nos agents s'occupent de faire la modération pour assurer a nos utilisateur
                                    la meilleur des experiences.
                                </p>
                            </div>
                            <div class="card-footer-c">
                                <!-- <a href="#" class="link-c link-icon">Read more
                                    <span class="ion-ios-arrow-forward"></span>
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box-c foo">
                            <div class="card-header-c d-flex">
                                <div class="card-box-ico">
                                    <i class="fas fa-euro-sign"></i>
                                </div>
                                <div class="card-title-c align-self-center">
                                    <h2 class="title-c">Location</h2>
                                </div>
                            </div>
                            <div class="card-body-c">
                                <p class="content-c">
                                    Vous chercher à louer un bien?
                                    Notre rubrique "louer" regroupe des milliers d'annonces dans lesquelles vous attend votre reve.
                                </p>
                            </div>
                            <div class="card-footer-c">
                                <a href="Louer.php" class="link-c link-icon">Cliquez ici
                                    <span class="ion-ios-arrow-forward"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box-c foo">
                            <div class="card-header-c d-flex">
                                <div class="card-box-ico">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="card-title-c align-self-center">
                                    <h2 class="title-c">Vente</h2>
                                </div>
                            </div>
                            <div class="card-body-c">
                                <p class="content-c">
                                    Vous souhaitez vendre votre bien?
                                    Ajouter une annonce qui sera consulté par des milliers d'acheteur potentiel.
                                    Transaction garantie.


                                </p>
                            </div>
                            <div class="card-footer-c">
                                <a href="CreationAnnonce.php" class="link-c link-icon">Cliquez ici
                                    <span class="ion-ios-arrow-forward"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->
<?php }
}

<?php

class ViewTypeBiens
{

    public static function listeTypeBiens1()
    { ?>

        <main id="main">

            <!-- ======= Intro Single ======= -->
            <section class="intro-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="title-single-box">
                                <h1 class="title-single">Nos Types de Biens</h1>
                                <span class="color-text-a">Types</span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="Accueil.php">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a id="afficherAjoutType" href="#">Ajouter</a>
                                    </li>
                                    <li class="breadcrumb-item active" id="actifDansBien" aria-current="page">
                                        Liste des Types
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section><!-- End Intro Single-->

            <!-- =======  Blog Grid ======= -->
            <section class="news-grid grid">
                <div class="container">
                    <div id="listeTypeBiens" class="">
                        <div class="row" id="majAjax">

                            <?php self::listeTypeBiens2('a') ?>


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
                    <!-- Formulaire ajout type de bien  -->
                    <div class="mb-5 d-none" id="formTypeBiens">
                        <form class="col-md-9" id="formTypeBien" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="typeBien">Type de bien </label>
                                <input type="text" class="form-control" id="typeBien" name="typeBien">
                            </div>
                            <div class="custom-file ml-3 col-md-12">
                                <input type="file" class="custom-file-input" name="photo" id="photo" required>
                                <label class="custom-file-label col-md-12" id="labelPhoto" for="customFile">photo ( jpg, 500*500)</label>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" name="ajoutTypeBien" id="ajoutTypeBien" class="btn btn-success">Ajouter</button>
                                <button type="reset" class="btn btn-secondary ml-2">effacer</button>
                            </div>
                        </form>
                    </div>
                    <!-- ende formulaire  -->
                </div>
                <!-- MODAL modif type bien  -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modifier Type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-md-6">
                                    <label for="modifTypeBien">Type de bien </label>
                                    <input type="text" class="form-control" id="modifTypeBien" name="modifTypeBien">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="dismissModalModtifType" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="validModifType" class="btn btn-success">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </section><!-- End Blog Grid-->

        </main><!-- End #main -->
        <?php  }

    public static function listeTypeBiens2()
    {
        $bien = ModelTypeBien::typeBiens();

        foreach ($bien as $nomBien) {  ?>
            <div class="col-md-4" id="<?php echo 'divTypeBien' . $nomBien['id'] ?>">
                <div class="card-box-b card-shadow news-box">
                    <div class="img-box-b">
                        <img src="<?php echo '../../assets/img/' . $nomBien['libelle'] . '.jpg' ?>" alt="" class="img-b img-fluid">
                    </div>
                    <div class="card-overlay">
                        <div class="card-header-b">
                            <div class="card-category-b">
                                <a href="#" class="category-b">Type</a>
                            </div>
                            <div class="card-title-b pb-5">
                                <h2 class="title-2">
                                    <a href="#"><?php echo $nomBien['libelle'] ?>
                                        <br> </a>
                                </h2>
                            </div>
                            <div class="card-date d-flex justify-content-between ">
                                <div><a href="" class="suppTypeBien" data-idType="<?php echo $nomBien['id'] ?>"> <span class="date-b text-White"><i class="fas fa-trash fa-2x"></i></span></a></div>
                                <div> <a href="" class="modifTypeBien " data-idtype="<?php echo $nomBien['id'] ?>" data-nomtype="<?php echo $nomBien['libelle'] ?>" data-toggle="modal" data-target="#exampleModal"> <span class="date-b text-white"><i class="fas fa-edit fa-2x"></i></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }

    public static function listeTypeBiens3($libelle)
    {
        $bien = ModelTypeBien::typebienViaLibele($libelle);
        ?>

        <div class="card-box-b card-shadow news-box">
            <div class="img-box-b">
                <img src="<?php echo '../../assets/img/' . $bien['libelle'] . '.jpg' ?>" alt="" class="img-b img-fluid">
            </div>
            <div class="card-overlay">
                <div class="card-header-b">
                    <div class="card-category-b">
                        <a href="#" class="category-b">Type</a>
                    </div>
                    <div class="card-title-b pb-5">
                        <h2 class="title-2">
                            <a href="#"><?php echo $bien['libelle'] ?>
                                <br> </a>
                        </h2>
                    </div>
                    <div class="card-date d-flex justify-content-between ">
                        <div><a href="" class="suppTypeBien" data-idType="<?php echo $bien['id'] ?>"> <span class="date-b text-White"><i class="fas fa-trash fa-2x"></i></span></a></div>
                        <div> <a href="" class="modifTypeBien " data-idtype="<?php echo $bien['id'] ?>" data-nomtype="<?php echo $bien['libelle'] ?>" data-toggle="modal" data-target="#exampleModal"> <span class="date-b text-white"><i class="fas fa-edit fa-2x"></i></span></a></div>
                    </div>

                </div>
            </div>
        </div>


<?php }
}

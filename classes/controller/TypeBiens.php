<?php
session_start();
require_once '../view/ViewTemplate.php';
require_once '../view/ViewTypeBiens.php';
require_once '../utils/TestPreg.php';
require_once '../utils/telechargement.php';
require_once '../model/ModelTypeBien.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('location:Accueil.php');
    exit();
} else {
    ViewTemplate::baliseTop();

    ViewTemplate::navBar();
$oualid;
    if (isset($_POST['ajoutTypeBien'])) {
        $donnee = [$_POST['typeBien']];
        $type = ['nomtype'];
        $donneeOk = testPreg::testInput($donnee, $type);
        if ($donneeOk['ok']) {
            $donneeOk = $donneeOk['donnee'];

            if (!ModelTypeBien::typebienViaLibele($donneeOk['nomtype'])) {

                $extensions = ['jpg'];
                $dowload = telechargement::telecharge($_FILES['photo'], $extensions, 'assets/img', $donneeOk['nomtype']);
                if ($dowload['ok']) {
                   
                    ModelTypeBien::ajoutType($donneeOk['nomtype']);
                    ViewTypeBiens::listeTypeBiens1();
                    ViewTemplate::alerte('success', 'ajout effectué', '', '');
                } else {
                    ViewTypeBiens::listeTypeBiens1();
                    ViewTemplate::alerte('secondary', $dowload['alert'], '', '');
                }
            } else {
                ViewTypeBiens::listeTypeBiens1();
                ViewTemplate::alerte('secondary', 'Ce type de Bien a déjà été ajouter', '', '');
            }
        } else {
            ViewTypeBiens::listeTypeBiens1();
            ViewTemplate::alerte('secondary', 'format non conforme', '', '');
        }
    } else {
        ViewTypeBiens::listeTypeBiens1();
    }


    ViewTemplate::footer();
    ViewTemplate::baliseBottom();
}
?>
<script>
    //affichage formulaire d'ajout
    $('#afficherAjoutType').click(function(e) {
        $('#listeTypeBiens').hide().toggleClass('d-none').fadeIn('slow');
        $('#formTypeBiens').hide().toggleClass('d-none').fadeIn('slow');
        $('#afficherAjoutType').text() == 'Ajouter' ? $('#afficherAjoutType').text(' Liste des Types') : $('#afficherAjoutType').text('Ajouter')
        $('#actifDansBien').text() == 'Ajouter' ? $('#actifDansBien').text(' Liste des Types') : $('#actifDansBien').text('Ajouter')
    })

    //validation client Ajout type
    validationClient('formTypeBien', ['nomType', 'file'])
</script>
<script>
    


    //Ajax suppression type de bien 
    $('.suppTypeBien').click(function(e) {
        e.preventDefault();

        console.log($(this).attr('data-idType'))
        let donnee = {
            idSupp: $(this).attr('data-idType')
        }
        generationAjax('SuppType.php', donnee, 'html', 'majAjax')

    })
</script>

<script>
    //MODIF Type DE bien
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('idtype')
        let nomType = button.data('nomtype')
        var modal = $(this)
        modal.find('.modal-title').text('Modification du type "' + nomType + '"')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).


        $('#validModifType').click(function(e) {
            let regexNom = /./u;
            let v;
            regexNom.test($('#modifTypeBien').val()) ? v = true : v = false;

            //AJAX MODIF
            if (v) {

                generationAjax('ModifType.php', {
                    idModifType: recipient,
                    nom: nomType,
                    newNom: $('#modifTypeBien').val()
                }, 'html', 'divTypeBien' + recipient);
                $('#dismissModalModtifType').click()
            } else {
                $('#modifTypeBien').addClass('bg-danger text-white')
            }
        })
    })
</script>
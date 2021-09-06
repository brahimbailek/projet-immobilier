$("#photo").change(function (e) {
  let val = $(this).val();
  val = val.split("\\");
  $("#labelPhoto").text(val[val.length - 1]);
});
$("#photos").change(function (e) {
  let val = $(this).val();
  val = val.split("\\");
  $("#labelPhotos").text(val[val.length - 1]);
});
$("#photoP").change(function (e) {
  let val = $(this).val();
  val = val.split("\\");
  $("#labelPhotoP").text(val[val.length - 1]);
});
$("#newPhotoP").change(function (e) {
  let val = $(this).val();
  val = val.split("\\");
  $("#labelNewPhotoP").text(val[val.length - 1]);
});

function generationAjax(url, donnee, donneeType, idDiv) {
  let request = $.ajax({
    type: "POST",
    url: url,
    data: donnee,

    dataType: donneeType,
  });

  request.done(function (retour) {
    //Code à jouer en cas d'éxécution sans erreur du script du PHP
    $("#" + idDiv)
      .hide()
      .html(retour)
      .fadeIn("slow");
  });
  request.fail(function (http_error) {
    //Code à jouer en cas d'éxécution en erreur du script du PHP

    let server_msg = http_error.responseText;
    let code = http_error.status;
    let code_label = http_error.statusText;
    alert("Erreur " + code + " (" + code_label + ") : " + server_msg);
  });
}
//Gestion hover supp et modif type de bien
$(".suppTypeBien span, .iconeSupp span").hover(
  function (e) {
    $(this).addClass("text-danger");
  },
  function (e) {
    $(this).removeClass("text-danger");
  }
);
$(".modifTypeBien span, .iconeModif span").hover(
  function (e) {
    $(this).addClass("text-success");
  },
  function (e) {
    $(this).removeClass("text-success");
  }
);

//gestion favoris
$(".iconeFav").click(function (e) {
  e.preventDefault();
  let button = $(e.currentTarget);
  let idAnnonce = button.data("annonceid");
  let idUser = button.data("userid");
  console.log(idAnnonce, idUser);

  $(this).children().hasClass("text-white")
    ? $(this).children().toggleClass("text-white") &&
      $(this).children().toggleClass("text-secondary") &&
      generationAjax(
        "AjoutFavoris.php",
        { suppFav: idAnnonce, idUser: idUser },
        "html",
        "tay"
      )
    : $(this).children().toggleClass("text-white") &&
      $(this).children().toggleClass("text-secondary") &&
      generationAjax(
        "AjoutFavoris.php",
        { ajoutFav: idAnnonce, idUser: idUser },
        "html",
        "tay"
      );
});

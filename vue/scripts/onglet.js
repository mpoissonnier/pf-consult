$(document).ready(function(){
  // Gestion des onglets
  $('ul.tabs').each(function(){
    // Récupération de l'onglet actif
    var $active, $content, $links = $(this).find('a');
    $active = $($links.filter('[href="'+location.hash+'"]')[1] || $links[1]);
    $active.addClass('active');
    $content = $($active[0].hash);

    // Cacher les onglets non actifs
    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    // Changement d'onglet
    $(this).on('click', 'a', function(e){
      $active.removeClass('active');
      $content.hide();

      $active = $(this);
      $content = $(this.hash);

      $active.addClass('active');
      $content.show();

      e.preventDefault();
    });
  });

  // Afficher ou non ajout de proche
  i = 1;
  $('#ajout').on('click', function() {
    if (i == 1) {
      $("#ajouter").show();
      i = 0;
    } else {
      $("#ajouter").hide();
      i = 1;
    }
  });
});

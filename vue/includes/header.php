<script>
function setResponsive() {
    var x = document.getElementsByClassName("nav");
    var i;
    for (i = 0; i < x.length; i++) {
      if (x[i].className == "nav") {
        x[i].className += " responsive";
      } else {
        x[i].className = "nav";
      }
    }
}
</script>

<header>
  <div class="nav">
    <ul>
      <li><a href="?inscription=user">S'inscrire</a></li>
      <li class="dot"></li>
      <li><a href="?domaine=medical">Médical</a></li>
    </ul>
  </div>
  <div class="logo-nav"><a href="index.php"><img src="vue/img/main-logo.png"/></a></div>
  <div class="nav">
    <ul>
      <li><a href="?domaine=juridique">Juridique</a></li>
      <li><div class="dot"></div></li>
      <li><a href="?connexion">Connexion</a></li>
    </ul>
  </div>
  <a href="javascript:void(0);" class="icon" onclick="setResponsive()">&#9776;</a>
</header>

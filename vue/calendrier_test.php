<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="css/calendrier.css">
</head>
<body>
<?php
$jour = date("w"); // numéro du jour actuel

if (isset($_GET['jour']))
{
    $jour = intval($_GET['jour']);
}

if ($_GET['week'] == "pre") // Si on veut afficher la semaine précédente
{
    $jour = $jour + 7;
}
elseif ($_GET['week'] == "next") // Si on veut afficher la semaine suivante
{
    $jour = $jour - 7;
}

$nom_mois = date("F"); // nom du mois actuel
$annee = date("Y"); // année actuelle
$num_week = date("W"); // numéro de la semaine actuelle

if (isset($_GET['week']))
{
    $nom_mois = date("F", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
    $annee = date("Y", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
    $num_week = date("W", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
}

$dateDebSemaine = date("Y-m-d", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
$dateFinSemaine = date("Y-m-d", mktime(0,0,0,date("n"),date("d")-$jour+7,date("y")));

$dateDebSemaineFr = date("d/m/Y", mktime(0,0,0,date("n"),date("d")-$jour+1,date("y")));
$dateFinSemaineFr = date("d/m/Y", mktime(0,0,0,date("n"),date("d")-$jour+7,date("y")));

$jourTexte = array('',1=>'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
$plageH = array(1=>'08:00', '08:15', '08:30', '08:45 ', '09:00','09:15', '09:30','09:45' , '10:00','10:15', '10:30' , '10:45', '11:00','11:15', '11:30' , '11:45', '12:00',);

switch($nom_mois)
{
    case 'January' : $nom_mois = 'Janvier'; break;
    case 'February' : $nom_mois = 'Février'; break;
    case 'March' : $nom_mois = 'Mars'; break;
    case 'April' : $nom_mois = 'Avril'; break;
    case 'May' : $nom_mois = 'Mai'; break;
    case 'June' : $nom_mois = 'Juin'; break;
    case 'July' : $nom_mois = 'Juillet'; break;
    case 'August' : $nom_mois = 'Août'; break;
    case 'September' : $nom_mois = 'Septembre'; break;
    case 'October' : $nom_mois = 'Otober'; break;
    case 'November' : $nom_mois = 'Novembre'; break;
    case 'December' : $nom_mois = 'Décembre'; break;
}

echo '
<div id="titreMois" align="center">
    <h2>'.$nom_mois.' '.$annee.'</h2>
</div>';

echo '<div id="titreMois" align="center">
    <a href="calendrier_test.php?week=pre&jour='.$jour.'"><<</a> Semaine '.$num_week.' <a href="calendrier_test.php?week=next&jour='.$jour.'">>></a><br />
    du '.$dateDebSemaineFr.' au '.$dateFinSemaineFr.'
</div>';

echo '<table border="1" align="center">';

    // en tête de colonne
    echo '<tr>';
    for($k = 1; $k < 8; $k++)
    {
        if($k==0)
            echo '<th>'.$jourTexte[$k].'</th>';
        else
            echo '<th><div>'.$jourTexte[$k].'<br />'.date("d", mktime(0,0,0,date("n"),date("d")-$jour+$k,date("y"))).'</div></th>';

    }
    echo '</tr>';

    // les 2 plages horaires : matin - midi
    for ($h = 1; $h <= 17; $h++)
    {

        // les infos pour chaque jour
            for ($j = 1; $j < 8; $j++)
            {
              if ($h == 7 && $j== 4){
                echo '<td align="center"> <div class="non">'.$plageH[$h].'</div></td>';
              }
              else
              {
                echo '<td align="center"><div class="oui">'.$plageH[$h].'</div></td>';
              }
            }
            echo '</td>
            </tr>';
    }
echo '</table>';
?>
</body>

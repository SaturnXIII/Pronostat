<!DOCTYPE html>
<html lang="en">

<head>
<link rel="manifest" href="/manifest.json">

 <style>
        .data .range .fill {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(<?php echo $moyenne; ?>% - 1%);
            height: 100%;
            border-radius: 0.25rem;
            background-color: <?php echo $moyenne >= 10 ? '#10B981' : 'red'; ?>;
        }

        .percent {
            margin-left: 2.5rem;
            color: #bcc4d2;
            font-weight: 600;
            display: flex;
        }
    </style>

  
  <link rel="stylesheet" href="style-phone.css">
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="https://em-content.zobj.net/source/apple/354/butterfly_1f98b.png">
  <title>Pronostat🦋</title>
</head>

<body>
<div class="icon">
  <img src="img/icon.png" class="imgicon" >
</div>

   <div class="account">
        <div class="account-content">
            <h5 class="accounttext">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["username"])) {
                        echo htmlspecialchars($_POST["username"]);
                    }
                }
                ?>
            </h5>
            <img src="img/account.png" class="accountimg">
        </div>
    </div>
<div class="moyeng">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $directory = '/home/prono-user/';
    $filename = $directory . $username . '-clear.txt';

    // Ouvre le fichier
    $fichier = fopen($filename, "r");


// Ouvre le fichier
$fichier = fopen($filename, "r");

// Initialise les tableaux
$matieres = [];
$dates = [];
$notes = [];

// Parcours le fichier
while (!feof($fichier)) {
    $ligne = fgets($fichier);

    if (preg_match("/matieres : (.*)/", $ligne, $matches)) {
        $matieres[] = $matches[1];
    }

    if (preg_match("/date : ([0-9\/]+)/", $ligne, $matches)) {
        $dates[] = $matches[1];
    }

    if (preg_match("/note : ([0-9,.]+)/", $ligne, $matches)) {
        $notes[] = str_replace(",", ".", $matches[1]);
    }
}

// Ferme le fichier
fclose($fichier);

// Calcul de la moyenne sur 20
$sum = array_sum($notes);
$count = count($notes);
$moyenne = ($sum / $count);

// Affiche la moyenne générale
echo '<button class="btn" type="button">';
echo '<strong>Moyenne générale ' . number_format($moyenne, 2) . ' </strong>';
echo '<div id="container-stars">';
echo '<div id="stars"></div>';
echo '</div>';
echo '<div id="glow">';
echo '<div class="circle"></div>';
echo '<div class="circle"></div>';
echo '</div>';
echo '</button>';


?>

<div class="card3-state">
    <div class="card3">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="card3-inner">
  <h1>Satus :</h1>
            <div class="card">
                <div class="content">
                    <div class="back">
                        <div class="back-content">
                            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                            <?php
                            // Ouvre le fichier
                            $file = fopen($filename, "r");

                            // Initialise les variables
                            $notes = [];
                            $moyenne1 = 0;
                            $moyenne2 = 0;

                            // Parcours le fichier ligne par ligne
                            while (($ligne = fgets($file)) !== false) {
                                // Cherche les notes
                                preg_match("/note : ([0-9]+)/", $ligne, $matches);

                                // Ajoute les notes au tableau
                                if (isset($matches[1])) {
                                    $notes[] = intval($matches[1]);
                                }
                            }

                            // Calcule la moyenne des notes
                            $moyenne1 = array_sum($notes) / count($notes);

                            // Supprime les deux dernières notes du tableau
                            array_splice($notes, -2, 2);

                            // Calcule la moyenne des deux dernières notes
                            $moyenne2 = array_sum($notes) / count($notes);

                            // Compare les moyennes
                            if ($moyenne2 > $moyenne1) {
                                // Les notes montent
                                echo "En augmentation<br>";
                                echo '<img class="fleches" src="img/monte.png" alt="En baisse">';
                            } else {
                                // Les notes descendent
                                echo "En baisse<br>";
                                echo '<img class="fleches" src="img/descend.png" alt="En augmentation">';
                            }

                            // Ferme le fichier
                            fclose($file);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  


<div class="card3-notes">
<div class="card3">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="card3-inner">
  <h1>Derniere notes :</h1>
                
    <?php

    // Ouvre le fichier
    $fichier = fopen($filename, "r");

    // Initialise les tableaux
    $matieres = [];
    $dates = [];
    $notes = [];

    // Parcours le fichier
    while (!feof($fichier)) {
        $ligne = fgets($fichier);

        if (preg_match("/matieres : (.*)/", $ligne, $matches)) {
            $matieres[] = $matches[1];
        }

        if (preg_match("/date : ([0-9\/]+)/", $ligne, $matches)) {
            $dates[] = $matches[1];
        }

        if (preg_match("/note : ([0-9,.]+)/", $ligne, $matches)) {
            $notes[] = str_replace(",", ".", $matches[1]);
        }
    }

    // Ferme le fichier
    fclose($fichier);

    // Calcul de la moyenne sur 20
    $sum = array_sum($notes);
    $count = count($notes);
    $moyenne = ($sum / $count);

    // Affiche la moyenne générale

    // Affiche les résultats
    for ($i = 0; $i < count($matieres); $i++) {
        $matiere = $matieres[$i];
        $date = $dates[$i];
        $note = $notes[$i];

        // Calcul de l'écart par rapport à la moyenne générale
        $ecart = $note - $moyenne;

        echo '<div class="card2">';
        echo '<div class="title">';
        echo '<span><img src="https://cdn-icons-png.flaticon.com/512/768/768818.png" height="20" width="20">';
        echo '</span>';
        echo '<p class="title-text">' . $matiere . '</p>';
        echo '<p class="percent">' . number_format($ecart, 2) . ' %</p>';
        echo '</div>';
        echo '<div class="data">';
        echo '<p>' . number_format($note, 2) . '</p>';
        echo '<div class="range"><div class="fill" style="width: calc(' . ($note) . ' * 5% - 1%); background-color: ' . ($note >= $moyenne ? '#10B981' : 'red') . ';"></div></div>';
        echo '</div>';
        echo '</div>';
    }

       
}
?>
    </div>
</div>
</div>



<div class="graphique">
<?php
// Définir la valeur de la source (src) en fonction de vos besoins
$src = "graph/$username.php";
?>
<iframe

class="iframe"
  width="500"
  height="300"
  <?php echo $src; ?>
  src="<?php echo $src; ?>"
>
</iframe>
</div>


  





  
<div class="inputfriends">
<div class="card3">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="card3-inner">
            <div class="friendlistelement">
                <h1>Classement:</h1>
                <h4>Friend List :</h4>
                <?php
                $friendlistName = ''; // Par défaut, vide s'il n'est pas trouvé
                $redirectFile = 'friendslist/redirect.txt';
                if (file_exists($redirectFile)) {
                    $lines = file($redirectFile);
                    foreach ($lines as $line) {
                        $data = explode(';', $line);
                        if (count($data) == 2 && trim($data[0]) == $username) {
                            $friendlistName = trim($data[1]);
                            break;
                        }
                    }
                }
                ?>
            </div>
            <div class="card3user">
                <?php
                if (!empty($friendlistName)) {
                    $friendlistFileName = 'friendslist/' . $friendlistName . '.txt';
                    $friendlist = file_get_contents($friendlistFileName);

                    $divs = [];

                    $lines = explode("\n", $friendlist);

                    foreach ($lines as $line) {
                        $parts = explode(";", $line);
                        if (count($parts) === 2) {
                            $superuser = trim($parts[0]);
                            $note = trim($parts[1]);
                            $divs[] = ['superuser' => $superuser, 'note' => $note];
                        }
                    }

                    usort($divs, function ($a, $b) {
                        return $b['note'] - $a['note'];
                    });

                    foreach ($divs as $key => $user) {
                        $rank = sprintf("%02d.", $key + 1);
                        $superuser = $user['superuser'];
                        $note = $user['note'];
                        echo '<div class="card4">';
                        echo '<div class="card4-content">';
                        echo '<div class "card4-top">';
                        echo '<span class="card4-title">' . $rank . '</span>';
                        echo '<a href="user/user.php?user=' . $superuser . '"><h5>' . $superuser . '</h5></a>';
                        echo '</div>';
                        echo '<div class="card4-bottom">';
                        echo '<p>' . $note . '/20</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card4-image">';
                        echo '<svg width="48" viewBox="0 -960 960 960" height="48" xmlns="http://www.w3.org/2000/svg"><path d="m393-165 279-335H492l36-286-253 366h154l-36-255Zm-73 85 40-280H160l360-520h80l-40 320h240L400-80h-80Zm153-395Z"></path></svg>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<style>


a {
margin-top: 8.5px;
}


h5 {
  color: #000000;
font-size: 13px;
}

p {
margin-top: -25px;
color: #000000;
}
</style>



  
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(registration => {
                        console.log('Service Worker enregistré avec succès');
                    })
                    .catch(error => {
                        console.log('Échec de l'enregistrement du Service Worker', error);
                    });
            });
        }
    </script>




<?php
  $heure = date("Y-m-d H:i:s");

  // Récupérer le modèle de l'appareil et le navigateur de l'utilisateur
  $user_agent = $_SERVER['HTTP_USER_AGENT'];

  // Créer une chaîne de données à écrire dans le fichier
  $hohocunvraicouteaux = "Heure : $heure\n";
  $hohocunvraicouteaux .= "Nom d'utilisateur : $username\n";
  $hohocunvraicouteaux .= "Modèle de l'appareil et navigateur : $user_agent\n";

  // Spécifiez le chemin du fichier dans lequel vous souhaitez écrire les données
  $grossetepu = "/path/pronostattemp/log/phone-$username.txt"; // Assurez-vous d'ajouter l'extension .txt

  // Ouvrir le fichier en mode écriture (ou le créer s'il n'existe pas)
  $fifitamere = fopen($grossetepu, "a");

  // Écrire les données dans le fichier
  if ($fifitamere) {
    fwrite($fifitamere, $hohocunvraicouteaux);
    fclose($fifitamere);
  } else {
    echo " ";
  }
  ?>

  
  <h1>
        <?php
        // On ouvre le fichier en lecture seule
        $fichier = fopen('transfer.txt', 'r');

        // On lit la dernière ligne du fichier
        $ligne = fgets($fichier);

        // On ferme le fichier
        fclose($fichier);

        // On affiche la dernière ligne du fichier
        echo 'Dernière mise à jour : ' . $ligne;
        ?>
    </h1>


  

</body>

</html>





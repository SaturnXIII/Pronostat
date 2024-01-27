<!DOCTYPE html>
<html>
<head>
    <title>Modifier la Friendlist</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .success-message {
            color: white; /* Couleur du texte en blanc */
        }
    </style>
</head>
<body>
  <div class="card3">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="card3-inner">
<div class="inputfriends">
  <div class="friendlistelement">
  <h1>Classement: </h1>
  <h4>Friend List :</h4>
    <?php

        // Récupérer le nom de la friendlist depuis le fichier redirect.txt
        $friendlistName = ''; // Par défaut, vide s'il n'est pas trouvé
        $redirectFile = 'friendslist/redirect.txt';
        if (file_exists($redirectFile)) {
            $lines = file($redirectFile);
            foreach ($lines as $line) {
                $data = explode(';', $line);
                if (count($data) == 2 && trim($data[0]) == "gerard.tamere") {
                    $friendlistName = trim($data[1]);
                    break;
                }
            }
        }
    ?>

    <form method="post" action="">
        <input type="text" required="" autocomplete="on" name="new_friendlist" id="new_friendlist" value="<?php echo $friendlistName; ?>">
        <button type="submit">Modifier</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newFriendlist = $_POST['new_friendlist'];

        // Mettre à jour le contenu du fichier friendlist
        $friendlistFile = 'friendslist/redirect.txt';
        file_put_contents($friendlistFile, "gerard.tamere;$newFriendlist");

        // Vérifier si un fichier avec le nom de la friendlist existe, sinon le créer
        if (!empty($friendlistName)) {
            $friendlistFileName = 'friendslist/' . $friendlistName . '.txt';
            if (!file_exists($friendlistFileName)) {
                // Créer un nouveau fichier avec le nom de la friendlist
                touch($friendlistFileName);
            }
        }

        echo '<p class="success-message">La Friendlist pour gerard.tamere a été mise à jour avec le nouveau contenu.</p>';
    }
    ?>
<div class="card3user">
    <?php

    // Lire le contenu du fichier
    if (!empty($friendlistName)) {
        $friendlistFileName = 'friendslist/' . $friendlistName . '.txt';
        $friendlist = file_get_contents($friendlistFileName);

        // Divs pour stocker les utilisateurs triés par note
        $divs = [];

        // Séparer les lignes en utilisateurs et notes
        $lines = explode("\n", $friendlist);

        foreach ($lines as $line) {
            $parts = explode(";", $line);
            if (count($parts) === 2) {
                $superuser = trim($parts[0]);
                $note = trim($parts[1]);
                $divs[] = ['superuser' => $superuser, 'note' => $note];
            }
        }

        // Tri des utilisateurs par note (du meilleur au pire)
        usort($divs, function ($a, $b) {
            return $b['note'] - $a['note'];
        });

        // Générer les divs classées
        foreach ($divs as $key => $user) {
            $rank = sprintf("%02d.", $key + 1);
            $superuser = $user['superuser'];
            $note = $user['note'];
            echo '<div class="card4">';
            echo '<div class="card4-content">';
            echo '<div class="card4-top">';
            echo '<span class="card4-title">' . $rank . '</span>';
            echo '<p>' . $superuser . '</p>';
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
</div>
  </div>
</body>
</html>

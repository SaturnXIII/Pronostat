<!DOCTYPE html>
<html>
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="https://em-content.zobj.net/source/apple/354/butterfly_1f98b.png">
  <title>Utilisateur🎴</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    // Vérifiez si le paramètre "user" est présent dans l'URL
    if (isset($_GET['user'])) {
        $utilisateur = $_GET['user'];

        // Maintenant, intégrez le code HTML avec le nom d'utilisateur tel qu'il est spécifié dans l URL
        ?>
        <div class="container d-flex justify-content-center mt-5">
            <div class="card">
                <div class="top-container">
                    <img src="../img/account.png" class="img-fluid profile-image" width="70">
                    <div class="ml-3">
                        <h5 class="name"><?php echo $utilisateur; ?></h5>
                        <p class="mail"><?php echo $utilisateur . '@monlycee.net'; ?></p>
                      <img src="img/<?php echo $utilisateur; ?>.png" class="profile-image" width="500">
                    </div>
                </div>
                <!-- Le reste du code HTML reste inchangé -->




            </div>
        </div>

    <?php
    } else {
        echo "Veuillez spécifier un nom d'utilisateur dans l'URL (ex. index.php?user=nom_utilisateur).";
    }
    ?>
</body>
</html>

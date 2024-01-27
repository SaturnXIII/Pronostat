<!DOCTYPE html>
<html lang="en">
<head>
<style>
  body {
    background-color: #edf2f4;
  }
</style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <canvas id="myChart" width="100" height="100"></canvas>
    <?php
    // Chemin du fichier
    $nomFichier = '/home/prono-user/gerard.tamere-clear.txt';

    // Lecture du fichier ligne par ligne
    $lines = file($nomFichier, FILE_IGNORE_NEW_LINES);

    // Initialisation d'un tableau pour stocker les notes
    $notes = array();

    // Parcourir chaque ligne
    foreach ($lines as $line) {
        // Vérifier si la ligne contient "note :" et extraire la note
        if (preg_match('/note : (\d+)/', $line, $matches)) {
            $note = $matches[1];
            $notes[] = $note; // Ajouter la note au tableau
        }
    }

    // Inverser l'ordre des valeurs du tableau $notes
    $notes = array_reverse($notes);

    // Créer les données pour le graphique Chart.js
    $data = [
        "labels" => range(1, count($notes)), // Labels pour les notes
        "datasets" => [
            [
                "label" => "Notes",
                "backgroundColor" => "#c8b6ff",
                "fill" => true,
                "data" => $notes // Utilisez le tableau $notes pour les données
            ]
        ]
    ];

    $dataJSON = json_encode($data);
    ?>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var data = <?php echo $dataJSON; ?>;
        var options = {
            "title": {
                "display": true,
                "text": "Notes"
            },
            "legend": {
                "display": false
            },
            "scales": {
                "yAxes": [
                    {
                        "ticks": {
                            "beginAtZero": true
                        }
                    }
                ]
            }
        };
      // Réduisez la taille du graphique de 4 fois
      ctx.canvas.width /= 2;
      ctx.canvas.height /= 2;

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pulpo Azul - Confirmation de Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #007bff;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .details {
            margin-top: 20px;
        }
        .signature {
            margin-top: 20px;
            text-align: center;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Une nouvelle réservation a été effectuée pour une sortie en bateau :</h3> 
        <div class="details">
            <ul>
                <li><strong>Date de la sortie :</strong> {{$date}}</li>
                <li><strong>Créneau horaire :</strong> {{$hours}}</li>
                <li><strong>Nombre de personnes :</strong> {{$number_of_people}}</li>
                <li><strong>Nom du client :</strong> {{$name}}</li>
                <li><strong>Email du client :</strong> {{$email}}</li>
                <li><strong>Numéro de téléphone du client :</strong> {{$number}}</li>
            </ul>
        </div>
        <p>Merci de prendre en compte cette réservation et de vous assurer que tout est prêt pour la sortie en bateau.</p>
        <p class="signature">Cordialement,<br>Votre Équipe Pulpo Azul</p>
    </div>
</body>
</html>

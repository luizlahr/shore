<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kontakt E-Mail</title>
</head>

<body>
    <h4>Neue Nachricht von Shores Website</h4>
    <br>
    <br>
    Name: {{ $data->name }},
    <br>
    E-mail: {{ $data->email }},
    <br>
    Telefon: {{ $data->phone }}
    <br>
    Ich habe die Hinweise zum Datenschutz gelesen und erklären mich mit ihnen einverstanden.
</body>

</html>
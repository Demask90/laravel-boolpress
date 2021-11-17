<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mail</title>
    </head>
    <body>
        <div class="container">
            <p>Hai ricevuto un nuovo messaggio, ecco qui i dettagli:</p>
            <p>Nome: {{$lead->name}}</p>
            <p>Email: {{$lead->email}}</p>
            <p>Messaggio:</p>
            <p>{{$lead->message}}</p>
        </div>
    </body>
</html>

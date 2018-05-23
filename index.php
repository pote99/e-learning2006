<?php
    session_start();
    if (!isset($_SESSION['username']))
    //non esiste 'username'
    //non autenticato: redireziona alla form di login
    header("location: login.html");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Learning2006</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" />
    
</head>
<body>

    

</body>
</html>
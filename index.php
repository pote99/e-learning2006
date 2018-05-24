<?php
    session_start();
    if (!isset($_SESSION['username']))
    //non esiste 'username'
    //non autenticato: redireziona alla form di login
    header("location: login.html");

    if ($_SESSION['confermato']==0) {
        echo "prima di poter effetuare qualsiasi operazione devi confermarti, controlla la tua mail!<br>";
        
    }else{
        if ($_SESSION['ruolo']=="studente")
        {
           echo '<a href="query2.php">Area Studenti</a> <br>';
        }

        if ($_SESSION['ruolo']=="amministratore")
        {
           echo '<a href="query1.php">Area Amministratore</a> <br>';
           echo '<a href="query2.php">Area Studenti</a> <br>';
        }
    }
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

    <a href="logout.php">logout</a> <br>

</body>
</html>
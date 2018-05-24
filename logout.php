<?php

session_start();
$_SESSION = array();

if (!isset($_SESSION['username']))
    //non esiste 'username'
    //non autenticato: redireziona alla form di login
    header("location: login.html");

?>
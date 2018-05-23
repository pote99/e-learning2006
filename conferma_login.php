<?php


require 'connect.php';

session_start();
	//verifica se già autenticato
	if (isset($_SESSION['username']))// esiste 'username'
		//già autenticato: redireziona alla index.html
		header("location: index.php");
		//echo "user  settato";
	//se arrivo qui vuole dire che sono autenticato: mostro la pagina che mi include
	

if (!isset($_POST['username'])) 
		//header("Location: login.html");
		echo "post user non settato";
	else 
		$username=$_POST['username'];
	if (!isset($_POST['password'])) 
		//header("Location: login.html");
		echo "post pass non settato";
	else 
		$password=$_POST['password'];

 //estrae dalla banca dati un eventuale utente con queste credenziali
 $msg="SELECT CONCAT(t1.nome,' ',t1.cognome) AS utente,t2.descrizione AS ruolo, utente.confermato AS confermato
 FROM utente AS t1,gruppo AS t2
 WHERE t1.id_gruppo=t2.id_gruppo
 AND username='$username'
 AND password=MD5('$password')
 AND confermato=1";
 $query=mysqli_query($sock,$msg);
 if ($row_user=mysqli_fetch_assoc($query)) { //trovato accetta credenziali
 //crea le variabili di autenticazione di sessione
 $_SESSION['username']=$username;
 $_SESSION['utente']=$row_user['utente'];
 $_SESSION['ruolo']=$row_user['ruolo'];
 $_SESSION['confermato']=$row_user['confermato'];
 //echo "very nice";
 header("Location: index.php");
 }
 else { //credenziali rifiutate: rilancia la form di login
 //header("Location: login.html");
 echo "credenziali rifiutate: rilancia la form di login";
 }



?>
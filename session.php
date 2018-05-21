<?php
	//crea una sessione o riprende una sessione già aperta
	session_start();
	//verifica se già autenticato
	if (!isset($_SESSION['username']))//non esiste 'username'
		//non autenticato: redireziona alla form di login
		header("location: login.php");
	//se arrivo qui vuole dire che sono autenticato: mostro la pagina che mi include
	//estrae dalla banca dati un eventuale utente con queste credenziali
	$msg="SELECT CONCAT(t1.nome,' ',t1.cognome) AS utente, t2.descrizione AS ruolo
		  FROM utente AS t1, gruppo AS t2
		  WHERE t1.id_gruppo=t2.id_gruppo
				AND username='$username'
				AND password=MD5('$password')
				AND confermato=1";
	$query=mysql_query($msg,$sock);
	if ($row_user=mysql_fetch_assoc($query)) 
	{ //trovato accetta credenziali
		//crea le variabili di autenticazione di sessione
		$_SESSION['username']=$username;
		$_SESSION['utente']=$row_user['utente'];
		$_SESSION['ruolo']=$row_user['ruolo'];
	}
	else //credenziali rifiutate: rilancia la form di login
		header("Location: login.php");
?>
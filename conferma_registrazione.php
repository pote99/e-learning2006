<?php
	if (!isset($_GET['username'])) 
		die('manca username');
		else $username=$_GET['username'];
	if (!isset($_GET['codice_conferma'])) 
		die('manca codice conferma');
	else 
			$codice_conferma=$_GET['codice_conferma'];	//cerca utente in banca dati
	//verifica l’esistenza dei parametri di ingresso
	require 'connect.php';
	$msg="SELECT *
		  FROM utente
		  WHERE username='$username'
		  AND codice_conferma='$codice_conferma'";
	$query=mysql_query($msg,$sock);
	if($query==0) 
		die(mysql_error());	//se i dati non sono corretti abbandona
	if (mysql_num_rows($query)==0) 
		die('conferma di registrazione non valida');	//se i dati sono corretti estrae le informazioni sull’utente
	$row_utente=mysql_fetch_assoc($query);
	$nome=$row_utente['nome'];
	$cognome=$row_utente['cognome'];
	$email=$row_utente['email'];	//convalida l’utente
	$msg="UPDATE utente SET confermato=1 WHERE username='$username'";
	$query=mysql_query($msg,$sock);
	if($query==0) 
		die(mysql_error());	//invia un email all’indirizzo specificato
	$subject="conferma registrazione community";
	$mailmsg="Caro $nome $cognome,\r\nLa tua registrazione è stata completata\r\nCordiali Saluti,\r\nl'amministratore della community\n";
	$headers="From: webmaster@community\r\nReply-To: webmaster@communty\r\n";
	@mail($email,$subject,$mailmsg,$headers);
?>
<html>
	<head>
		<title>Conferma registrazione</title>
	</head>
	<body>
		<p>
			Grazie per la registrazione <b><?php echo $nome." ".$cognome ?></b> <br>
			Ora puoi accedere alle aree autenticate usando la tua username e password.
		</p>
		<p>
			<a href="index.php">indietro</a> <br>
		</p>
	</body>
</html>
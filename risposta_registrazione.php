<?php //verifica l’esistenza dei parametri di ingresso
	if (!isset($_POST['username'])) 
		die('manca username');
	else 
		$username=$_POST['username'];
	if (!isset($_POST['password'])) 
		die('manca password');
	else 
		$password=$_POST['password'];
	if (!isset($_POST['cognome'])) 
		die('manca cognome');
	else 
		$cognome=$_POST['cognome'];
	if (!isset($_POST['nome'])) 
		die('manca nome');
	else 
		$nome=$_POST['nome'];
	if (!isset($_POST['email'])) 
		die('manca email');
	else 
		$email=$_POST['email'];
	if (!isset($_POST['cod_comune'])) 
		die('manca cod_comune');
	else 
		$cod_comune=$_POST['cod_comune'];
	//if (!isset($_POST['codice_conferma'])) 
	//	die('manca codice_conferma');
	//else 
	//	$codice_conferma=$_POST['codice_conferma'];
	if (!isset($_POST['cod_istituto'])) 
		die('manca istituto');
	else 
		$cod_istituto=$_POST['cod_istituto'];
	//genera un codice casuale di conferma
	$codice_conferma=bin2hex(rand(-1E+18,+1E+18));
	require 'connect.php';
	$msg="INSERT INTO utente
		  (username, password, cognome, nome, email, cod_comune, cod_istituto,id_gruppo, confermato, codice_conferma)
		  VALUES
		  ('$username', MD5('$password'), '$cognome', '$nome', '$email', '$cod_comune', '$cod_istituto', 3, 0, '$codice_conferma')";
	$query=mysqli_query($msg,$sock);
	//in caso di duplicazione della chiave torna all’inserimento
	if($query==0) 
		header("location: richiesta_registrazione.php");
	//invia mail all’indirizzo fornito
	$subject="richiesta registrazione community";
	$mailmsg="Caro $nome $cognome,\r\nPer completare la registrazione percorri il seguente
			  link\r\n\http://localhost/e-learning2006/conferma_registrazione.php?username=$username&codice_conferma=$codice_conferma
			  \r\nCordiali Saluti,\r\nl'amministratore
			  della community\r\n";
	$headers="From: webmaster@community\r\nReply-To: webmaster@communty\r\n";
	@mail($email,$subject,$mailmsg,$headers);
?>
<html>
	<head>
		<title>risposta registrazione</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
		risposta registrazione
		Grazie per richiesta la registrazione 
		<b><?php echo $nome." ".$cognome?></b><br>
		Una mail contenente le istruzioni per completare la registrazione è stata
		mandata all'indirizzo 
		<b><?php echo $email ?></b>.<br>
		A presto!
	</body>
</html>
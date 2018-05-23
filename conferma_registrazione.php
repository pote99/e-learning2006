<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
	$query=mysqli_query($sock,$msg);
	if($query==0) 
		die(mysqli_error());	//se i dati non sono corretti abbandona
	if (mysqli_num_rows($query)==0) 
		die('conferma di registrazione non valida');	//se i dati sono corretti estrae le informazioni sull’utente
	$row_utente=mysqli_fetch_assoc($query);
	$nome=$row_utente['nome'];
	$cognome=$row_utente['cognome'];
	$email=$row_utente['email'];	//convalida l’utente
	$msg="UPDATE utente SET confermato=1 WHERE username='$username'";
	$query=mysqli_query($sock,$msg);
	if($query==0) 
		die(mysqli_error());	//invia un email all’indirizzo specificato
	$subject="conferma registrazione community";
	$mailmsg="Caro $nome $cognome,\r\nLa tua registrazione è stata completata\r\nCordiali Saluti,\r\nl'amministratore della community\n";
	//$headers="From: webmaster@community\r\nReply-To: webmaster@communty\r\n";
	//@mail($email,$subject,$mailmsg,$headers);
	$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
//$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only

$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "tls"; // sets the prefix to the server
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 587; // set the SMTP port for the GMAIL server
$mail->Username = "learning2006staff@gmail.com"; // GMAIL username
$mail->Password = "classe5d3"; // GMAIL password

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->From = "learning2006staff@gmail.com";
$mail->FromName = "E-Learning2006";
$mail->Subject = $subject;
$mail->MsgHTML($mailmsg);

$mail->AddAddress($email,"$nome $cognome");
$mail->IsHTML(true); // send as HTML


 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 }
	

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
<?php 
	require 'connect.php' //connessione alla banca dati
	require 'session.php' //verifica stato di autenticazione
	//accesso consentito solo agli amministratori
	if($_SESSION['ruolo']!='amministratore') die('riservato agli amministratori');
	$msg="SELECT t1.cognome, t1.nome, t3.descrizione AS comune, t5.descrizione AS modulo, t5.docente_studente AS docente
	      FROM utente AS t1, gruppo AS t2, comune AS t3, iscrizione AS t4, modulo AS t5
		  WHERE t1.id_gruppo=t2.id_gruppo 
		        AND t1.cod_comune=t3.cod_comune 
				AND t1.username=t4.username 
		        AND t4.id_modulo=t5.id_modulo
				AND t2.descrizione= 'docente'
		  ORDER BY t1.cognome,t1.nome,t5.descrizione";
	$query=mysql_query($msg,$sock);
	if($query==0) die(mysql_error());
?>
<html>
	<head>
		<title>query n.1</title>
	</head>
	<body>
		<?php //mostra dati utente autenticato
		echo $_SESSION['username']."-".$_SESSION['utente']."-".$_SESSION['ruolo']
		?>
		<table>
			<tr> <!-- riga statica di intestazione -->
				<td>cognome</td>
				<td>nome</td>
				<td>comune</td>
				<td>modulo</td>
				<td>solo&nbsp;docenti </td>
			</tr>
			<?php while($row_user=mysql_fetch_assoc($query)) { //riga dinamica ?>
				<tr>
					<td><?php echo stripslashes($row_user['cognome']) ?></td>
					<td><?php echo stripslashes($row_user['nome']) ?></td>
					<td><?php echo stripslashes($row_user['comune']) ?></td>
					<td><?php echo stripslashes($row_user['modulo']) ?></td>
					<td><?php echo (($row_user['docente']!=0)?'X':'&nbsp;') ?></td>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>
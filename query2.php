<?php 
	require 'connect.php' //connessione alla banca dati
	require 'session.php' //verifica stato di autenticazione
	//accesso consentito a tutti
	$msg="SELECT t1.username, t1.cognome, t1.nome, t4.descrizione AS modulo, t3.titolo, t3.descrizione AS riassunto, t5.descrizione AS tipo, t3.data
		  FROM utente AS t1, gruppo AS t2, documento AS t3, modulo AS t4, tipo AS t5
		  WHERE t1.id_gruppo=t2.id_gruppo 
				AND t1.username=t3.username 
				AND t3.id_modulo=t4.id_modulo 
				AND t3.id_tipo=t5.id_tipo 
				AND t2.descrizione= 'studente'
		  ORDER BY t1.cognome,t1.nome,t4.descrizione,t3.titolo";
	$query=mysql_query($msg,$sock);
?>
<html>
	<head>
		<title>query n.2</title>
	</head>
	<body>
		<?php //mostra dati utente autenticato
		echo $_SESSION['username']."-".$_SESSION['utente']."-".$_SESSION['ruolo']
		?>
		<table>
			<tr> <!-- riga statica di intestazione -->
				<td>username</td>
				<td>cognome</td>
				<td>modulo</td>
				<td>titolo</td>
				<td>riassunto</td>
				<td>tipo</td>
				<td>data</td>
			</tr>
			<?php while($row_user=mysql_fetch_assoc($query)) { //riga dinamica ?>
				<tr>
					<td><?php echo $row_user['username'] ?></td>
					<td><?php echo stripslashes($row_user['cognome']) ?></td>
					<td><?php echo stripslashes($row_user['nome']) ?></td>
					<td><?php echo stripslashes($row_user['modulo']) ?></td>
					<td><?php echo substr(stripslashes($row_user['riassunto']),0,80) ?></td>
					<td><?php echo stripslashes($row_user['tipo']) ?></td>
					<td><?php echo $row_user['data'] ?></td>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>
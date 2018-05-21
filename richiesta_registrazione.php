<?php //connessione ed estrazione delle tabelle di look-up
	require 'connect.php';
	$msg="SELECT *
		  FROM comune";
	$qcomune=mysqli_query($sock,$msg);
	$msg1="SELECT * 
		  FROM istituto";
	$qist=mysqli_query($sock,$msg1);
?>
<html>
	<head>
		<title>registrazione nuovo utente</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" media="screen"  />
			<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
	</head>
	<script type="text/javascript" src="./convalida.js"></script>
	<body>
		registrazione nuovo utente
		<form action="risposta_registrazione.php" method="POST" name="registra" onsubmit="return convalida(this)">
			username
			<input name="username" type="text"><br>
			password
			<input name="password" type="password"><br>
			ripeti password
			<input name="repeat" type="password"><br>
			cognome
			<input name="cognome" type="text" ><br>
			nome
			<input name="nome" type="text" ><br>
			email
			<input name="email" type="text"><br>
			comune <!-- casella a discesa di selezione del comune -->
			<select name="cod_comune" id="cod_comune"><br>
				<option value="0000">
					selezionare un comune
				</option>
				<?php while($row_comune=mysqli_fetch_assoc($qcomune)) { ?>
					<option value="<?php echo $row_comune['cod_comune'] ?>">
						<?php echo $row_comune['descrizione'] ?>
					</option>
				<?php } ?>
			</select>
			istituto <!-- casella a discesa di selezione dell’istituto -->
			<select name="cod_istituto" id="cod_istituto"><br>
				<option value="0000000000">selezionare un istituto</option>
				<?php while($row_ist=mysqli_fetch_assoc($qist)) { ?>
					<option value="<?php echo $row_ist['cod_istituto'] ?>">
						<?php echo $row_ist['descrizione'] ?>
					</option>
				<?php } ?>
			</select>
			<input type="submit" name="Submit" value="Invia" >
		</form>
	</body>
</html>
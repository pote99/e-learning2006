<?php
	//connette al SQL server sullo stesso host,
    //utente nobody, password ‘qwerty’
    
    //OK
	$sock=mysqli_connect('localhost','root','','e-learning');
	if(mysqli_connect_errno())
    {
        echo "Impossibile connettersi al DB.<br>";
        echo mysqli_connect_error();
        exit();
    }
	
?>

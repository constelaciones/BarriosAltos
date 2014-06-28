<?php
session_start();
include("conecta.php");
echo $_GET["username"];
echo $_GET["pass"];
echo $_GET["clave2"];
echo $_GET["mail"];

// verificamos si se han enviado ya las variables necesarias.
if (($_GET["username"])!= "") {
	$username = $_GET["username"];
	$clave = $_GET["pass"];
	$clave2 = $_GET["clave2"];
	$mail = $_GET["mail"];
	// Hay campos en blanco
	if($username==NULL || $clave==NULL || $clave2==NULL || $mail==NULL) {
		echo "Un campo está vacío.";
                echo "Tu registro no se ha podido realizar";
	}else{
		//Coinciden las contraseñas?
		if($clave!=$clave2) {
			echo "Las contraseñas no coinciden";
			echo "Tu registro no se ha podido realizar";
		}else{
			// Comprobamos si el nombre de nombre o la cuenta de correo ya existen
			$checkuser = mysql_query("SELECT nombre FROM usuari WHERE nombre='$username'");
			$username_exist = mysql_num_rows($checkuser);
			$checkmail = mysql_query("SELECT mail FROM usuari WHERE mail='$mail'");
			$mail_exist = mysql_num_rows($checkmail);
			if ($mail_exist>0|$username_exist>0) {
				echo "El nombre de usuarix o la cuenta de correo ya están en uso";
				//formRegistro();
			}else{
				$query = 'INSERT INTO usuari (nombre, clave, mail)
				VALUES (\''.$username.'\',\''.$clave.'\',\''.$mail.'\')';
				mysql_query($query) or die(mysql_error());
				echo 'El nombre '.$username.' ha sido registrado de manera satisfactoria.<br />';
				echo 'Haz login para comenzar <br />';
			}
		}
	}
}else{
	//formRegistro();
}
?>
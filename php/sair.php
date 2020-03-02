<?php

	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['nome']);
	unset($_SESSION['tabela']);
	unset($_SESSION['id']);
	setcookie('email', "", time() - 3600, '/');
	
	header('Location: ../index.php');
?>
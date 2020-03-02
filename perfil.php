<?php 
	session_start();
		
	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
	}

	if(isset($_SESSION['nome']))
	{
		if(isset($_POST['nome']))
		{
			include('php/connect.php');

			$conn = new connection();

			if($conn->connect('localhost', 'id9792570_contador_de_faltas', 'id9792570_plinio', '1PaM9qCz2OsN'))
			{
				$tables = $conn->getTables("{$_SESSION['email']}%");

				foreach ($tables as $table) {
					$conn->renameTable($table[0], "{$_POST['email']}:" . substr($table[0], -6, 6));
				}

				$conn->update('login', "NOME = \"{$_POST['nome']}\", EMAIL = \"{$_POST['email']}\", SENHA = \"{$_POST['senha']}\"", "ID = {$_SESSION['id']}");

				$_SESSION['nome'] = $_POST['nome'];
				$_SESSION['email'] = $_POST['email'];
			}
			else
			{
				include('php/database_connection_error.php');
			}
		}
			
	}			
	else
	{
		header('Location: index.php');
	}

	echo "
	<!DOCTYPE html>
	<html>
	<head>
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"css/perfil.css\">
		<title>perfil</title>
	</head>

	<body>";

	include('php/menu.php');

	echo "
		<div></div>

		<div class=\"form_div warned\">
			<span class=\"title\">Editar</span>
			
			<form class=\"form\" action=\"perfil.php\" method=\"POST\">
				<div class=\"inputs_1\">
					<input class=\"form_item\" type=\"text\" name=\"nome\" value=\"{$_SESSION['nome']}\">
					<span class=\"warning\">*nome Inválido</span>
					<input class=\"form_item\" type=\"text\" name=\"email\" value=\"{$_SESSION['email']}\">
					<span class=\"warning\">*email Inválido</span>
					<input class=\"form_item\" type=\"password\" name=\"senha\" placeholder=\"senha\">
					<input class=\"form_item\" type=\"password\" name=\"senha2\" placeholder=\"senha\">
					<span class=\"warning\">*as senhas não são iguais</span>
				</div>

				<div class=\"buttons_2\">
					<button class=\"form_button\" type=\"button\">salvar</button>
				</div>
			</form>
		</div>

	</body>
	<script type=\"text/javascript\" src=\"js/menu.js\"></script>
	<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
	<script type=\"text/javascript\" src=\"js/perfil.js\"></script>
	</html>";
?>
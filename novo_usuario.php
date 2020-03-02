<?php 
	session_start(); 

	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
	}

	include('php/connect.php');
	$conn = new connection();

	if(!$conn->connect())
	{
		include('php/database_connection_error.php');
	}
	else if(isset($_POST['criar_tabela']))
	{

		$data = (date('n') > 6 ? "2/".date('Y') : "1/".date('Y'));

		$_SESSION['tabela'] = $_SESSION['email'].":".$data;

		$conn->createTable($_SESSION['tabela'], "ID INT PRIMARY KEY", "MATERIAS TEXT", "FALTAS INT", "FALTAS_MAX INT");

		for($i = 0; $i < count($_POST['materias']); $i++)
		{
			if(!$conn->insert($_SESSION['tabela'], "ID, MATERIAS, FALTAS, FALTAS_MAX", $i + 1, $_POST['materias'][$i], 0, $_POST['faltas_max'][$i]))
			{
				include('php/database_connection_error.php');
			}
		}

		header('Location: main.php');
	}
	else if(isset($_SESSION['email']))
	{
		if(!$conn->existsTable("{$_SESSION['email']}%"))
		{

			echo"
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<meta charset=\"UTF-8\">
				<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\">
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/novo_usuario.css\"/>
			</head>

			<body>";

			include('php/menu.php');

			echo "
				<div></div>
				<div id=\"mensagem\">
					<p>Você ainda não tem uma tabela, vamos criar uma?</p>

					<button id=\"criar\">criar tabela</button>
				</div>

				<div class=\"form_div warned\" id=\"criar_tabela\">
					<form class=\"form\" action=\"novo_usuario.php\" method=\"post\">

						<div class=\"inputs_2\" id=\"inputs\">
							<span id=\"materia_label\">Materias</span>
						 	<span id=\"faltas_label\">Faltas max</span>

							<span id=\"nenhum\">nenhum</span>
						</div>

						<div class=\"buttons_1\">

					 		<button type=\"button\" class=\"form_button\" id=\"add\">add materia</button>

					 		<button type=\"button\" class=\"form_button\" id=\"rem\">rem materia</button>

					 		<button type=\"button\" class=\"form_button\" id=\"cancelar\">cancelar</button>

					 		<button type=\"button\" class=\"form_button\" id=\"salvar\">salvar</button>
				 		</div>

						<input type=\"hidden\" name=\"criar_tabela\"/>
					</form>
				</div>
			</body>
			<script type=\"text/javascript\" src=\"js/menu.js\"></script>
			<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
			<script type=\"text/javascript\" src=\"js/novo_usuario.js\"></script>
			</html>";
		}
		else
		{
			header('Location: main.php');
		}
	}
	else
	{
		header('Location: index.php');
	}
?>
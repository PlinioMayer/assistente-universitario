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
	else if(isset($_POST['atualizar_tabela']))
	{
		for($i = 0; $i < count($_POST['updates']); $i++)
		{
			$conn->update($_SESSION['tabela'], "FALTAS = {$_POST['updates'][$i]}", "ID = " . ($i + 1));
		}

		if(isset($_POST['nome']))
		{
			for($i = 0; $i < count($_POST['nome']); $i++)
			{
				$conn->insert($_SESSION['tabela'], 'ID, MATERIAS, FALTAS, FALTAS_MAX', $conn->autoIncrement($_SESSION['tabela'], 'ID'), $_POST['nome'][$i], $_POST['faltas'][$i], $_POST['faltasMax'][$i]);
			}
		}

		$materias = $conn->getRows($_SESSION['tabela'], '*');

		echo "
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<meta charset=\"utf-8\">
				<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/>
				<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\">
			</head>

			<body>";

		include('php/menu.php');

		echo "
				<div></div>
				<form id=\"tabela_materias\" method=\"post\" action=\"main.php\">
					<div id=\"titulo\" class=\"div_materia\">
						<span class=\"materias\">Materias</span>
						<span class=\"faltas\">Faltas</span>
						<span class=\"max\">Max</span>
					</div>";

				foreach($materias as $row)
				{
					echo "
					<div class=\"div_materia\">
						<input type=\"text\" readonly class=\"materias\" value=\"{$row['MATERIAS']}\" />
						<input name=\"updates[]\" type=\"text\" readonly class=\"faltas\" value=\"{$row['FALTAS']}\" />
						<span class=\"max\">{$row['FALTAS_MAX']}</span>
						<span class=\"mais\">+</span>
					</div>";
				}

		echo "
					<button type=\"button\" id=\"add\" class=\"form_button\">add</button>
					<button type=\"button\" id=\"atualizar\" class=\"form_button\">atualizar</button>
					<input type=\"hidden\" name=\"atualizar_tabela\"/>
				</form>
			</body>
			<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
			<script type=\"text/javascript\" src=\"js/main.js\"></script>
			<script type=\"text/javascript\" src=\"js/menu.js\"></script>
			</html>";
	}
	else if(isset($_SESSION['tabela']))
	{
		$materias = $conn->getRows($_SESSION['tabela'], '*');

		if(substr($_SESSION['tabela'], -6, 6) !== (date('n') > 6 ? "2/".date('Y') : "1/".date('Y')))
		{
			echo "
				<!DOCTYPE html>
				<html>
				<head>
					<title></title>
					<meta charset=\"utf-8\">
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/>
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\">
				</head>

				<body>";

			include('php/menu.php');

			echo "
					<div></div>
					<form class=\"disabled\" id=\"tabela_materias\" method=\"post\" action=\"main.php\">
						<div id=\"titulo\" class=\"div_materia\">
							<span class=\"materias\">Materias</span>
							<span class=\"faltas\">Faltas</span>
							<span class=\"max\">Max</span>
						</div>";

				foreach($materias as $row)
				{
					echo "
					<div class=\"div_materia\">
						<input type=\"text\" readonly class=\"materias\" value=\"{$row['MATERIAS']}\" />
						<input name=\"updates[]\" type=\"text\" readonly class=\"faltas\" value=\"{$row['FALTAS']}\" />
						<span class=\"max\">{$row['FALTAS_MAX']}</span>
					</div>";
				}

			echo "
					</form>
				</body>
				<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
				<script type=\"text/javascript\" src=\"js/main.js\"></script>
				<script type=\"text/javascript\" src=\"js/menu.js\"></script>
				</html>";
		}
		else
		{
			echo "
				<!DOCTYPE html>
				<html>
				<head>
					<title></title>
					<meta charset=\"utf-8\">
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/>
					<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\">
				</head>

				<body>";

			include('php/menu.php');

			echo "
					<div></div>
					<form id=\"tabela_materias\" method=\"post\" action=\"main.php\">
						<div id=\"titulo\" class=\"div_materia\">
							<span class=\"materias\">Materias</span>
							<span class=\"faltas\">Faltas</span>
							<span class=\"max\">Max</span>
						</div>";

				foreach($materias as $row)
				{
					echo "
					<div class=\"div_materia\">
						<input type=\"text\" readonly class=\"materias\" value=\"{$row['MATERIAS']}\" />
						<input name=\"updates[]\" type=\"text\" readonly class=\"faltas\" value=\"{$row['FALTAS']}\" />
						<span class=\"max\">{$row['FALTAS_MAX']}</span>
						<span class=\"mais\">+</span>
					</div>";
				}

			echo "
					<button type=\"button\" id=\"add\" class=\"form_button\">add</button>
					<button type=\"button\" id=\"atualizar\" class=\"form_button\">salvar</button>
					<input type=\"hidden\" name=\"atualizar_tabela\"/>
				</form>
			</body>
			<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
			<script type=\"text/javascript\" src=\"js/main.js\"></script>
			<script type=\"text/javascript\" src=\"js/menu.js\"></script>
			</html>";
		}
	}
	else
	{
		header('Location: historico.php');
	}
?>
<?php 
	session_start();
		
	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
	}

	include('php/connect.php');
	$conn = new connection();
	if(!$conn->connect("localhost", "id9792570_contador_de_faltas", "id9792570_plinio", "1PaM9qCz2OsN"))
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
	else if(isset($_POST['tabela']))
	{
		$_SESSION['tabela'] = $_SESSION['email'] . ":" . $_POST['tabela'];
		header('Location: main.php');
		
	}
	else if($conn->existsTable("{$_SESSION['email']}%"))
	{
		
		$tables = $conn->getTables("{$_SESSION['email']}%");

		$anos[0] = (int)substr($tables[0][0], -4, 4);
		$final_tables[0] = $tables[0][0];

		for($i = 1; $i < count($tables); $i++)
		{
			$ano = (int)substr($tables[$i][0], -4, 4);
			for($i2 = 0; $i2 < count($anos); $i2++)
			{
				if($ano < $anos[$i2])
				{
					array_splice($final_tables, $i2, 0, $tables[$i][0]);
					array_splice($anos, $i2, 0, $ano);
					break;
				}
				else if($ano === $anos[$i2])
				{
					if((int)substr($final_tables[$i2], -6, 1) === 1)
					{
						if($i2 === count($anos) - 1)
						{
							array_push($final_tables, $tables[$i][0]);
							array_push($anos, $ano);
							break;
						}
						else
						{
							array_splice($final_tables, $i2 + 1, 0, $tables[$i][0]);
							array_splice($anos, $i2 + 1, 0, $ano);
							break;
						}
					}
					else
					{
						array_splice($final_tables, $i2, 0, $tables[$i][0]);
						array_splice($anos, $i2, 0, $ano);
					}
				}
			}

			if($i2 === count($anos))
			{
				array_push($final_tables, $tables[$i][0]);
				array_push($anos, $ano);	
			}
		}

		echo "
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/historico.css\"/>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu.css\">
		</head>

		<body>";

		include('php/menu.php');

		echo "
			<form method=\"post\" action=\"historico.php\" id=\"post_form\">
				<input type=\"hidden\" name=\"tabela\" />
			</form>
			<div id=\"tabela_tabelas\">";

			if(substr($final_tables[count($final_tables) - 1], -6, 6) != (date('n') > 6 ? "2/".date('Y') : "1/".date('Y')))
			{
				echo "
				<input id=\"btn_criar_tabela\" type=\"text\" class=\"tabela\" value=\"Criar tabela de ".(date('n') > 6 ? "2/".date('Y') : "1/".date('Y'))."\" readonly/>";
				$i = count($final_tables) - 2;
			}
			else
			{
				$i = count($final_tables) - 1;
			}

			for(; $i >= 0; $i--)
			{
				echo "
				<input name=\"tabelas\" type=\"text\" class=\"tabela\" value=\"".substr($final_tables[$i], -6, 6)."\" readonly/>";
			}
		echo "

		</div>";

		echo "
			<div class=\"form_div warned\" id=\"criar_tabela\">
				<form class=\"form\" action=\"historico.php\" method=\"post\">

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
		<script type=\"text/javascript\" src=\"js/historico.js\"></script>
		</html>";
	}
	else
	{
		header('Location: novo_usuario.php');
	}
?>
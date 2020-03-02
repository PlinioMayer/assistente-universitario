<?php 
	session_start();

	if(isset($_POST['nome']))
	{
		include("php/connect.php");
		$is_new = true;

		$conn = new connection();

		if(!$conn->connect())
		{
			include('php/database_connection_error.php');
		}
		else
		{
			if($conn->tableSize("login") > 0)
			{
				if($conn->existsItem('login', 'EMAIL', $_POST['email']))
				{
					echo "
					<!DOCTYPE html>
					<html>
					<head>
						<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
						<meta charset=\"utf-8\">
						<title>Contador de Faltas</title>
						<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
						<link rel=\"stylesheet\" type=\"text/css\" href=\"css/cadastro.css\"/>
					</head>

					<body>
						<div class=\"form_div warned\">

							<h1>Cadastro</h1>

							<form method=\"post\" class=\"form\" action=\"cadastro.php\">
								<div class=\"inputs_1\">
								<input class=\"form_item\" type=\"text\" name=\"nome\" placeholder=\"nome\"/>
									<span id=\"nome_invalido\" class=\"warning\">*nome invalido</span>

									<input class=\"form_item\" type=\"email\" name=\"email\" value=\"{$_POST['email']}\" placeholder=\"email\"/>
									<span id=\"email_invalido\" class=\"warning\">*email invalido</span>
									<span style=\"display: inline-block;\" id=\"email_cadastrado\" class=\"warning\">*email já cadastrado</span>

									<input class=\"form_item\" type=\"password\" name=\"senha\" placeholder=\"senha\" />

									<input class=\"form_item\" type=\"password\" name=\"senha2\" placeholder=\"senha\" />
									<span id=\"senha_invalida\" class=\"warning\">*as senhas não são iguais</span>
								</div>

								<div class=\"buttons_2\">
									<button class=\"form_button\" id=\"cadastrar\" type=\"button\">Cadastrar</button>
								</div>
							</form>

						</div>
					</body>
					<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
					<script type=\"text/javascript\" src=\"js/cadastro.js\"></script>
					</html>";
				}
				else
				{
					$conn->insert("login", "ID, NOME, EMAIL, SENHA", $conn->autoIncrement('login', 'ID'), $_POST['nome'], $_POST['email'], $_POST['senha']);
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['nome'] = $_POST['nome'];

					header('Location: novo_usuario.php');
				}
			}
			else
			{
				$conn->insert("login", "ID, NOME, EMAIL, SENHA", $conn->autoIncrement('login', 'ID'), $_POST['nome'], $_POST['email'], $_POST['senha']);
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['nome'] = $_POST['nome'];

				header('Location: novo_usuario.php');
			}
		}
	}
	else
	{
		echo "
		<!DOCTYPE html>
		<html>
		<head>
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
			<meta charset=\"utf-8\">
			<title>Contador de Faltas</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/cadastro.css\"/>
		</head>

		<body>
			<div class=\"form_div warned\">

				<h1>Cadastro</h1>

				<form method=\"post\" class=\"form\" action=\"cadastro.php\">
					<div class=\"inputs_1\">
					<input class=\"form_item\" type=\"text\" name=\"nome\" placeholder=\"nome\"/>
						<span id=\"nome_invalido\" class=\"warning\">*nome invalido</span>

						<input class=\"form_item\" type=\"email\" name=\"email\" placeholder=\"email\"/>
						<span id=\"email_invalido\" class=\"warning\">*email invalido</span>
						<span id=\"email_cadastrado\" class=\"warning\">*email já cadastrado</span>

						<input class=\"form_item\" type=\"password\" name=\"senha\" placeholder=\"senha\" />

						<input class=\"form_item\" type=\"password\" name=\"senha2\" placeholder=\"senha\" />
						<span id=\"senha_invalida\" class=\"warning\">*as senhas não são iguais</span>
					</div>

					<div class=\"buttons_2\">
						<button class=\"form_button\" id=\"cadastrar\" type=\"button\">Cadastrar</button>
					</div>
				</form>

			</div>
		</body>
		<script type=\"text/javascript\" src=\"js/validateForm.js\"></script>
		<script type=\"text/javascript\" src=\"js/cadastro.js\"></script>
		</html>";
	}
?>
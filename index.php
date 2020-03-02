<?php 
	ob_start(); 
	session_start();

	if(isset($_SESSION['email']))
	{
		header('Location: main.php');
		exit();
	}

	if(isset($_COOKIE['email']))
	{
		$_SESSION['email'] = $_COOKIE['email'];
		header('Location: php/login_attempt.php');
		exit();
	}

	if(isset($_SESSION['email_errado']))
	{
		$email_warning = 'inline';
		$email_atual = $_SESSION['email_errado'];
		$senha_warning = 'none';
	}
	else
	{
		$email_warning = 'none';
		$email_atual = "";

		if(isset($_SESSION['senha_errada']))
		{
			$senha_warning = 'inline';
		}
		else
		{
			$senha_warning = 'none';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contador de Faltas</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

	<div id="header">
		<span>Contador de Faltas</span>
	</div>

	<form id="access-form" action="php/login_attempt.php" method="POST">
		<div class="div-input">
			<label for="email" class="input-span">Email</label>
			<input id="email" type="text" name="email" class="spanned-input" value=<?php echo "\"$email_atual\""; ?>>
		</div>
		<span style=<?php echo "\"display: {$email_warning};\""; ?> class="warning">*email não cadastrado</span>

		<div class="div-input">
			<label for="senha" class="input-span">Senha</label>
			<input id="senha" type="password" name="senha" class="spanned-input">
		</div>
		<span style=<?php echo "\"display: {$senha_warning};\""; ?> class="warning">*senha incorreta</span>

		<a id="esqueci" href="">Esqueci a senha</a>

		<label id="cookie-label"><input name="cookie" type="checkbox" id="cookie" value="manter" /> Me manter conectado</label>

		<button type="button" id="entrar">Entrar</button>
		<span id="cadastrar">Não possui cadastro? <a href="cadastro.php">Cadastrar</a></span>
	</form>
	<?php ob_end_flush(); ?>
</body>
<script type="text/javascript" src="js/validateForm.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</html>
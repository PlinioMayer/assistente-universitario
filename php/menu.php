<?php
	$nome_array = explode(' ', $_SESSION['nome']);

	$header_title = basename($_SERVER['REQUEST_URI'], '.php');

	if($header_title === 'novo_usuario' || $header_title === 'perfil')
	{
		$header_title = $nome_array[0];
	}
	else if($header_title === 'main')
	{
		$header_title = substr($_SESSION['tabela'], -6, 6);
	}

	echo "
	<div id=\"header\">
		<div id=\"menu_button\">
			<svg id=\"icon_1\" width=\"100%\" height=\"100%\">
			 	<rect x=\"20%\" y=\"15%\" width=\"60%\" height=\"10%\"/>

			 	<rect x=\"20%\" y=\"42.5%\" width=\"60%\" height=\"10%\"/>

			 	<rect x=\"20%\" y=\"70%\" width=\"60%\" height=\"10%\"/>
			</svg>

			<svg id=\"icon_2\" width=\"100%\" height=\"100%\">
				<line x1=\"15%\" x2=\"85%\" y1=\"15%\" y2=\"85%\" />
				<line x1=\"85%\" x2=\"15%\" y1=\"15%\" y2=\"85%\" />
			</svg>
		</div>

		<nav id=\"menu\">
			<span id=\"menu_title\">".$nome_array[0].' '.$nome_array[count($nome_array) - 1]."</span>
			<a class=\"menu_item\" href=\"main.php\">Main</a>
			<a class=\"menu_item\" href=\"perfil.php\">Perfil</a>
			<a class=\"menu_item\" href=\"historico.php\">Histórico</a>
			<a class=\"menu_item\" href=\"php/sair.php\">Sair</a>
		</nav>

		<h1 id=\"header_title\">".$header_title."</h1>

		<a id=\"sair\" href=\"php/sair.php\">Sair</a>

	</div>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>whatsapp backup</title>
	<link rel="stylesheet" type="text/css" href="css/form.css">

	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body{
			display: grid;
			align-items: center;
			justify-items: center;
			min-height: 100vh;
		}

		.form_div{
			width: 400px;
		}

		.form_item{
			line-height: 30px;
		}
	</style>
</head>
<body>
	<?php

		if(isset($_POST['nome']))
		{
			echo is_uploaded_file($_FILES['arquivo']['tmp_name']);
		}
		else
		{
			echo "
				<div class=\"form_div\">
					<span class=\"title\">Whatsapp Backup Reader</span>
					<form class=\"form\" enctype=\"multipart/form-data\" method=\"POST\" action=\"whatsappbackup.php\">
						<div class=\"inputs_1\">
							<input class=\"form_item\" type=\"text\" name=\"nome\" placeholder=\"Seu nome na conversa\">
							<input type=\"file\" name=\"arquivo\"/>
						</div>

						<div class=\"buttons_2\">
							<button class=\"form_button\" type=\"submit\">carregar</button>
						</div>
					</form>
				</div>";
		}
	?>
</body>
</html>
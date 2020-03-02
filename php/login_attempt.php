<?php 
	session_start();

	if(isset($_SESSION['email']))
	{
		include('connect.php');
		
		$conn = new connection();
		if(!$conn->connect("localhost", "id9792570_contador_de_faltas", "id9792570_plinio", "1PaM9qCz2OsN"))
		{
			include('database_connection_error.php');
		}

		if(!isset($_SESSION['tabela']))
		{
			if(!isset($_SESSION['nome']))
			{
				setcookie('email', $_SESSION['email'], time() + (30 * 24 * 60 * 60), '/');

				$query = $conn->getRows('login', '*', "EMAIL = '{$_SESSION['email']}'");
				$_SESSION['nome'] = $query[0]['NOME'];
				$_SESSION['id'] = $query[0]['ID'];
			}

			if($conn->existsTable("{$_SESSION['email']}%"))
			{
				if($conn->existsTable($_SESSION['email'].':'.(date('n') > 6 ? "2/".date('Y') : "1/".date('Y'))))
				{
					$_SESSION['tabela'] = $_SESSION['email'].':'.(date('n') > 6 ? "2/".date('Y') : "1/".date('Y'));
					header('Location: ../main.php');
					exit();
				}
				else
				{
					header('Location: ../historico.php');
					exit();
				}
			}
			else
			{
				header('Location: ../novo_usuario.php');
				exit();
			}
		}

		header('Location: ../main.php');
	}
	else if(isset($_POST['email']))
	{
		include("connect.php");
		
		$conn = new connection();

		if(!$conn->connect("localhost", "id9792570_contador_de_faltas", "id9792570_plinio", "1PaM9qCz2OsN"))
		{
			include('database_connection_error.php');
		}
		else if($conn->existsItem("login", "EMAIL", $_POST['email']))
		{
			$senha = $conn->getRows("login", "SENHA", "EMAIL = '{$_POST['email']}'");
			
			if($senha[0]['SENHA'] == $_POST['senha'])
			{
			    if(isset($_SESSION['email_errado']))
			    {
			        unset($_SESSION['email_errado']);
			        
			        if(isset($_SESSION['senha_errada']))
			        {
			            unset($_SESSION['senha_errada']);
			        }
			    }
			    
			    $query = $conn->getRows('login', '*', "EMAIL = '{$_POST['email']}'");
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['nome'] = $query[0]['NOME'];
				$_SESSION['id'] = $query[0]['ID'];
			    
				if(isset($_POST['cookie']))
				{
					setcookie('email', $_POST['email'], time() + (30 * 24 * 60 * 60), '/');
				}

				if($conn->existsTable("{$_POST['email']}%"))
				{
					if($conn->existsTable($_POST['email'].':'.(date('n') > 6 ? "2/".date('Y') : "1/".date('Y'))))
					{
						$_SESSION['tabela'] = $_POST['email'].':'.(date('n') > 6 ? "2/".date('Y') : "1/".date('Y'));
						header('Location: ../main.php');
						exit();
					}
					else
					{
						header('Location: ../historico.php');
						exit();
					}
				}
				else
				{
					header('Location: ../novo_usuario.php');
					exit();
				}
			}
			else
			{
				$_SESSION['email_errado'] = $_POST['email'];
				$_SESSION['senha_errada'] = true;

				header('Location: ../index.php');
				exit();
			}
		}
		else
		{
			$_SESSION['email_errado'] = $_POST['email'];

			header('Location: ../index.php');
			exit();
		}
	}
	else
	{
		header('Location: ../index.php');
		exit();
	}
?>
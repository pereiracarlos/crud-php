<?php
	error_reporting(1);

	// Conecta ao BD
	$conexao = new mysqli( "localhost", "root", "", "prova_php" );
			
	// Erro na conexão?
	if ( $conexao->connect_error == true ) {
		echo "Erro ao Conectar";
	}

	// Clicou em enviar?
	if ($_POST != NULL) {
		
		// Obtém os parâmetros
		$remetente = $_POST["remetente"];
		$destinatario = $_POST["destinatario"];
		$titulo = $_POST["titulo"];
		$mensagem = $_POST["mensagem"];
		
		// Cria comando SQL
		$sql = "INSERT INTO email (remetente, destinatario, titulo, mensagem) 
				VALUES ('$remetente', '$destinatario', '$titulo', '$mensagem')";
		
		// Executa no BD
		$retorno = $conexao->query( $sql );
		
		// Executou?
		if ( $retorno == true ) {
			echo "<script>
					alert('Cadastro realizado com sucesso!');
					location.href='listar.php';
				  </script>";
		// Deu erro..
		} else {
			echo "<script>
					alert('Erro ao cadastrar!');
				  </script>";
			
			echo $conexao->error;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sistema de Email</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
			.container{
				margin-top: 30px;
				box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);
				padding: 10px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Cadastrar</h1>
			<form method="POST">
				<input type="email" name="remetente" class="form-control" required placeholder="Remetente"><br>
				<input type="email" name="destinatario" class="form-control" required placeholder="Destinatario"><br>
				<input type="text" name="titulo" class="form-control" required placeholder="Titulo"><br>
				<textarea name="mensagem" placeholder="Mensagem" cols="161" rows="5"></textarea><br>
				<input type="submit" name="Enviar" class="btn btn-primary">
			</form>
		</div>
	</body>
</html>
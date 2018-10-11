<?php

	// Não exibe notificação e alerta
	error_reporting(1);

	// Conecta ao BD
	$conexao = new mysqli( "localhost", "root", "", "prova_php" );

	// Erro na conexão?
	if ( $conexao->connect_error == true ) {
		echo "Erro ao Conectar";
	}

	// Obter ID via GET
	$id = $_GET["id"];

	// Verifica se o ID não foi passado via GET
	if ( $id == NULL ) {
		echo "O ID não foi passado via GET!";
		exit;
	}

	// Criar comando SQL
	$sql = "SELECT * FROM email WHERE id = $id";
			
	// Executa no BD
	$retorno = $conexao->query( $sql );

	// Deu erro?
	if ( $retorno == false ) {
		echo $conexao->error;
	}

	// Obtém o registro
	$registro = $retorno->fetch_array();

	// obtem os campos do registro
	$id = $registro["id"];
	$remetente = $registro["remetente"];
	$destinatario = $registro["destinatario"];
	$titulo = $registro["titulo"];
	$mensagem = $registro["mensagem"];

	// Clicou em enviar?
	if ($_POST != NULL) {
		
		// Obtém os parâmetros
		$remetente = $_POST["remetente"];
		$destinatario = $_POST["destinatario"];
		$titulo = $_POST["titulo"];
		$mensagem = $_POST["mensagem"];
		
		// Cria comando SQL
		$sql = "UPDATE email SET remetente = '$remetente', destinatario = '$destinatario', titulo = '$titulo', mensagem = '$mensagem' 
		WHERE id = $id";
		
		// Executa no BD
		$retorno = $conexao->query( $sql );
		
		// Executou?
		if ( $retorno == true ) {
			echo "<script>
					alert('Registro atualizado com sucesso!');
					location.href='listar.php';
				  </script>";
		// Deu erro..
		} else {
			echo "<script>
					alert('Erro ao atualizar!');
				  </script>";
			echo $conexao->error;
		}	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Responder Email</title>
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
			.aa, h1{margin-left: 95px;}
		</style>
	</head>
	<body>
		<h1>Responder Email</h1>
		<br>
		<a href="listar.php" class="btn btn-danger aa">Voltar</a>
		<div class="container">
			<form method="POST">
				Remetente:
				<input type="email" name="remetente" class="form-control" required placeholder="Remetente" value="<?php echo $destinatario;?>"><br>
				Destinatário:
				<input type="email" name="destinatario" class="form-control" required placeholder="Destinatario" value="<?php echo $remetente;?>"><br>
				Título:
				<input type="text" name="titulo" class="form-control" required placeholder="Titulo" value="RES:<?php echo $titulo;?>"><br>
				Mensagem:
				<textarea name="mensagem" placeholder="Mensagem" cols="161" rows="5"><?php echo $mensagem;?></textarea><br>
				<input type="submit" name="Enviar" class="btn btn-primary">
			</form>
		</div>
	</body>
</html>
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
	$remetente = $registro["remetente"];
	$titulo = $registro["titulo"];
	$mensagem = $registro["mensagem"];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Exibir email</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
			li{list-style-type: none;}
			.aa, h1{margin-left: 40px;}
		</style>
	</head>
	<body>
		<br><BR>
		<h1>Dados do email</h1>
		<a href="listar.php" class="btn btn-primary aa">Voltar</a>
		<br><br>
		<ul>
			<li><strong>Remetente: </strong><?php echo $remetente; ?></li>
			<li><strong>Título: </strong><?php echo $titulo; ?></li>
			<li><strong>Mensagem: </strong><?php echo $mensagem; ?></li>
		</ul>
	</body>
</html>
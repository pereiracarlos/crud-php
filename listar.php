
<!DOCTYPE html>
<html>
	<head>
		<title>Listar Email</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
			.container{margin-top: 30px;}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Listar</h1>
			<a href="cadastrar.php" class="btn btn-primary">Voltar</a><br><br>
			<form class="form-inline">
				<input type="email" name="destinatario" class="form-control">
				<input type="submit" value="Listar Emails" class="btn">
			</form><br>
			<table class="table table-stripped">
				<tr>
					<th>Titulo</th>
					<th>Remetente</th>
					<th>Apagar</th>
					<th>Responder</th>
				</tr>
				<?php

					// Não exibe notificação e alerta
					error_reporting(1);

					// Conecta ao BD
					$conexao = new mysqli( "localhost", "root", "", "prova_php" );
					
					// Erro na conexão?
					if ( $conexao->connect_error == true ) {
						
						echo "Erro ao Conectar";
					
					}

					$user = $_GET["destinatario"];
					//echo $user;
					// Criar comando SQL
					$sql = "SELECT * FROM email WHERE destinatario='$user'";

					// Executa no BD
					$retorno = $conexao->query( $sql );

					// Deu erro?
					if ( $retorno == false ) {
						echo $conexao->error;
					}

					// percorre todos os registros
					while ( $registro = $retorno->fetch_array() ) {

						// obtem os campos do registro
						$id = $registro["id"];
						$titulo = $registro["titulo"];
						$remetente = $registro["remetente"];

						// imprimir registro na tabela
						echo "<tr>
								<td><a href='exibir.php?id=$id'>$titulo</a></td>
								<td>$remetente</td>
								<td>
									<a onclick=\"return confirm('Deseja Apagar?');\" href='apagar.php?id=$id' class='glyphicon glyphicon-trash'>
									</a>
								</td>
								<td><a href='responder.php?id=$id' class='glyphicon glyphicon-repeat'></a></td>
							</tr>";
					}
				?>
			</table>
		</div>
	</body>
</html>
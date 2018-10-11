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
	$sql = "DELETE FROM email 
			WHERE id = $id";
			
	// Executa no BD
	$retorno = $conexao->query( $sql );

	// Executou?
	if ( $retorno == true ) {
		
		echo "<script>
				alert('Registro deletado com sucesso!');
				location.href='listar.php';
			  </script>";
		
	// Deu erro..
	} else {

		echo "<script>
				alert('Erro ao deletar!');
			  </script>";
		
		echo $conexao->error;	
	}
?>
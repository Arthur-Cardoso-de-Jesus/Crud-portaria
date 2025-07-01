<?php
// verificar se o usuário está logado
session_start();

// conectar-se ao banco de dados
include("config.php");

// verificar se o usuário confirmou a exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["confirmacao"] == "sim") {
		// excluir o usuário do banco de dados
		$id = $_POST["id"];
		$sql = "DELETE FROM tbVisitas WHERE pkIdVisita=$id";

		if (mysqli_query($conn, $sql)) {

			echo "<script> alert('Visita excluída com sucesso.'); </script>";
			echo "<script> location.href='paginaVisita.php'; </script>";
		} else {
			echo "<script> alert('Erro ao excluir visita.')</script> " . mysqli_error($conn);
		}

		exit();
	} else {
		echo "<script> alert('A visita não foi excluída.'); </script>";
		echo "<script> location.href='paginaVisita.php'; </script>";
	}
}

// exibir a mensagem de confirmação
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css\excluirVisita.css">
	<title>Excluir visita</title>
</head>

<body>
	<div id="container">
		<form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<h1>Excluir visita</h1>
			<p>Tem certeza que deseja excluir essa visita?</p>
			<input id="id" type="hidden" name="id" value="<?php echo $_GET['id']  ?>">
			<div id="container-radio">
				<input class="radio" type="radio" name="confirmacao" value="sim">Sim
				<input class="radio" type="radio" name="confirmacao" value="nao" checked>Não
			</div>
			<input id="btnExcluir" type="submit" name="submit" value="Excluir">
			<input id="btnVoltar" type="button" value="Cancelar" onclick="location.href='paginaVisita.php'">
		</form>
	</div>
</body>

</html>
<?php
// verificar se o usuário está logado
session_start();


// conectar-se ao banco de dados
include("config.php");

// verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// atualizar os dados do usuário no banco de dados
	$id = $_POST["pkIdVisita"];
	$fkIdUsuario = $_POST['fkIdUsuario'];
	$motivo = $_POST['motivoVisita'];

	$sql = "UPDATE tbVisitas SET fkIdUsuario='$fkIdUsuario', motivoVisita='$motivo' WHERE pkIdVisita='$id'";

	if (mysqli_query($conn, $sql)) {
		echo "Visita atualizada com sucesso.";
	} else {
		echo "Erro ao atualizar visita: " . mysqli_error($conn);
	}
	header("Location: paginaVisita.php");
	// redirecionar de volta para a pagina de visitas
	exit();
} else {
	// exibir o formulário preenchido com os dados do usuário
	$id = $_GET["id"];
	$sql = "SELECT * FROM tbVisitas WHERE pkIdVisita=$id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$id = $row['pkIdVisita'];
	$fkIdUsuario = $row['fkIdUsuario'];
	$motivo = $row['motivoVisita'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css\editarVisita.css">
	<title>Editar visita</title>
</head>

<body>
	<form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<h1 id="titulo-formulario">Editar visita</h1>
		<!-- Abaixo pega o id via link  -->
		<input id="pkIdvisita" type="hidden" name="pkIdVisita" value="<?php echo $id  ?>">

		<label for="motivo">Id do visitante:</label>
		<input id="txtId" class="login" placeholder="Id do visitante" type="text" name="fkIdUsuario" value="<?php echo $fkIdUsuario; ?> " required>

		<label for="motivo">Motivo da visita:</label>
		<select id="motivoVisita" name="motivoVisita">
			<option value="Direção">Direção</option>
			<option value="Evento">Evento</option>
			<option value="Ginasio">Ginasio</option>
			<option value="Secretaria">Secretaria</option>
		</select>
		<div id="botoes">
			<input id="editar" type="submit" name="submit" value="Editar">
			<a href='paginaVisita.php'><input id="voltar" type="button" name="voltar"  value="Cancelar"></a>
		</div>
	</form>
</body>

</html>
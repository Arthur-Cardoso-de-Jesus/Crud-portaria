<?php
// verificar se o usuário está logado
session_start();


// conectar-se ao banco de dados
include("config.php");


//Diretorio do upload
$target_dir = "uploads/";

// verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// pega o nome original da imagem
	$nomeImagem = $target_dir .  basename($_FILES["imagem"]["name"]);

	// pega a data de hoje
	$today = date("-m-d-y");

	// modifica o nome da imgem com um id unico
	$_FILES["imagem"]["name"] = uniqid() . $today;


	// Caminho completo do arquivo no servidor
	$target_file = $target_dir . basename($_FILES["imagem"]["name"]);



	// Caminho completo do arquivo no servidor
	$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

	// atualizar os dados do usuário no banco de dados
	$id = $_POST["pkIdUsuario"];
	$nome = $_POST['nomeUsuario'];
	$numDocUsuario = $_POST['numDocUsuario'];
	$dataNascUsuario = $_POST['dataNascUsuario'];

	//identifica se imagem foi enviada ou se é nula.

	if ($_FILES['imagem']['tmp_name'] == '') {
		$sql = "UPDATE tbUsuarios SET nomeUsuario='$nome', numDocUsuario='$numDocUsuario', dataNascUsuario='$dataNascUsuario' WHERE pkidUsuario='$id'";
		$resultado = mysqli_query($conn, $sql);
		echo "Enviado com sucesso!";
	} else if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
		// Se o arquivo foi movido com sucesso, insira o caminho no BD
		$sql = "UPDATE tbUsuarios SET nomeUsuario='$nome', numDocUsuario='$numDocUsuario', dataNascUsuario='$dataNascUsuario', caminho='" . $target_file . "', nomeImg='"  . $nomeImagem .  "' WHERE pkidUsuario='$id'";

		$resultado = mysqli_query($conn, $sql);
		echo "A imagem foi carregada com sucesso!";
	} else {
		echo "Erro ao atualizar." . mysqli_error($conn);
	}

	// redirecionar de volta para o perfil do usuário
	header("Location: paginaUsuario.php");
	exit();
} else {
	// exibir o formulário preenchido com os dados do usuário
	$id = $_GET["id"];
	$sql = "SELECT * FROM tbUsuarios WHERE pkIdUsuario=$id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$nomeUsuario = $row['nomeUsuario'];
	$numDocUsuario = $row['numDocUsuario'];
	$dataNascUsuario = $row['dataNascUsuario'];
	$caminho = $row['caminho'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css\EditarUsuario.css">
	<title>Editar Usuario</title>
</head>

<body>
	<form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
		<h1 id="titulo-formulario">Editar usuario</h1>

		<input id="pkIdUsuario" type="hidden" name="pkIdUsuario" value="<?php echo $id  ?>">

		<input placeholder="Nome" type="text" name="nomeUsuario" value="<?php echo $nomeUsuario; ?>" required>
		<input placeholder="Numero Documento" type="type" name="numDocUsuario" value="<?php echo $numDocUsuario; ?>" required>
		<input placeholder="Data de nascimento" type="date" name="dataNascUsuario" value="<?php echo $dataNascUsuario; ?>" required>

		<img id="imagemAtual" src='<?php echo $caminho ?>'>

		<input type="file" name="imagem" id="imagem">


		<div id="botoes">
			<input id="editar" type="submit" name="submit" value="Editar">
			<a href='paginaUsuario.php'><input id="voltar" type="button" name="voltar" value="Cancelar"></a>
		</div>
	</form>
</body>

</html>
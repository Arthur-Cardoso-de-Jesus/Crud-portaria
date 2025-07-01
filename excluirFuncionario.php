<?php
session_start();

if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

// conectar-se ao banco de dados
include("config.php");


$id = $_SESSION['id'];
$nome = $_SESSION['nome'];


// verificar se o usuário confirmou a exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["confirmacao"] == "sim") {
        // excluir o funcionario do banco de dados
        $sql = "DELETE FROM tbFuncionarios WHERE pkIdFunc=$id";

        if (mysqli_query($conn, $sql)) {

            echo "<script> alert('Funcionário excluído com sucesso.'); </script>";
            echo "<script> location.href='LOGOUT.php'; </script>";
        } else {
            echo "Erro ao excluir usuario: " . mysqli_error($conn);
        }

        exit();
    } else {
        echo "<script> alert('O funcionário não foi excluído.'); </script>";
        echo "<script> location.href='paginaFuncionario.php'; </script>";
    }
} else {
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="css/excluirFuncionario.css">
    <title>Excluir funcionário</title>
</head>

<body>
    <div id="container">
        <form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Excluir conta de funcionário</h1>
            <p>Tem certeza que deseja excluir sua conta de funcionário?<php echo $nome ?>
            </p>
            <div id="container-radio">
                <input class="radio" type="radio" name="confirmacao" value="sim">Sim
                <input class="radio" type="radio" name="confirmacao" value="nao" checked>Não
            </div>
            <input id="btnExcluir" type="submit" name="submit" value="Excluir">
            <input id="btnVoltar" type="button" value="Cancelar" onclick="location.href='paginaFuncionario.php'">
        </form>
    </div>
</body>

</html>
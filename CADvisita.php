<?php
session_start();

if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

include("config.php");
// Pega os dados do form
$identificador = mysqli_real_escape_string($conn, $_POST['identificador']);
$motivo = mysqli_real_escape_string($conn, $_POST['motivo']);
$idFuncionario = $_SESSION['id'];

$sql = "SELECT nomeUsuario FROM tbUsuarios WHERE numDocUsuario = '$identificador';";
$res = $conn->query($sql) or die($conn->error);
$qtd = $res->num_rows;


if ($qtd > 0) {
    // Insere os dados no MySQL
    $query = "INSERT INTO `tbVisitas`(`fkIdUsuario`,`fkIdFuncionario`, `motivoVisita`) VALUES ('$id','$idFuncionario','$motivo')";
    $resultado = mysqli_query($conn, $query);
    echo "<script> alert('Visita adicionada.'); </script>";
    echo "<script> location.href='paginaVisita.php'; </script>";

    // Verifica se houve erro na inserção
    if (!$resultado) {
        die("Erro ao inserir os dados no MySQL: " . mysqli_error($conn));
    }

} else {
        echo "<script> alert('O usuário não existe.'); </script>";
        echo "<script> location.href='addVisita.php'; </script>";
}
// Fecha a conexão com o MySQL
mysqli_close($conn);

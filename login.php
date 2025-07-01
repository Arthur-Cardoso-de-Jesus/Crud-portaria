<?php
session_start();
if (empty($_POST) or (empty($_POST['usuario']) or (empty($_POST['senha'])))) {
    echo "<script> location.href='index.php;' </script>";
}
include("config.php");
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_md5 = md5($senha); // Criptografa a senha usando MD5
$sql = "select * from tbfuncionarios where usuarioFunc = '$usuario' and senhaFunc = '$senha_md5'";
$res = $conn->query($sql) or die($conn->error);
$row = $res->fetch_object();
$qtd = $res->num_rows;

if ($qtd > 0) {
    $_SESSION["id"] = $row->pkIdFunc;
    $_SESSION["usuario"] = $usuario;
    $_SESSION["nome"] = $row->nomeFunc;
    $_SESSION["senha"] = $row->senhaFunc;

    echo "<script> location.href='menu.php'; </script>";
} else {
    echo "<script> alert('Usuário e/ou senha incorreto(s)'); </script>";
    echo "<script> location.href='index.php'; </script>";
}

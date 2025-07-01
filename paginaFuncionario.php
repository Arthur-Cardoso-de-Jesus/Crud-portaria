<?php
session_start();

if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}
$id = $_SESSION['id'];
$nome = $_SESSION["nome"];
$usuario = $_SESSION["usuario"];
$senha = $_SESSION["senha"];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="css\paginaFuncionario.css">
    <title>Página funcionário</title>
</head>

<body>

    <div id="header">
        <div id="imagem">
            <h1>Portaria CSL</h1>
            <img>
        </div>
        <div id="menu">
            <a href="menu.php"><button class="btn-header">
                    <h3>Menu</h3>
                </button></a>
            <a href="paginaUsuario.php"><button class="btn-header">
                    <h3>Usuários</h3>
                </button></a>
            <a href="paginaVisita.php"><button class="btn-header">
                    <h3>Visitas</h3>
                </button></a>
        </div>
    </div>

    <div id="container">
        <table id="tabelaDados">
            <tr>
                <th colspan="2">
                    <h1>Seu perfil</h1>
                </th>
            </tr>
            <tr>
                <td>
                    <h2>Nome: <?php echo "$nome" ?></h2>
                </td>
                <td>
                    <h2>login: <?php echo "$usuario" ?></h2>
                </td>
            </tr>

        </table>
        <div id="botoes">
            <button onclick="location.href='editarFuncionario.php'" class='btn'>Editar</button>
            <button onclick="location.href='excluirFuncionario.php'"class='btn-excluir' >Excluir</button>
        </div>
    </div>

</body>

</html>
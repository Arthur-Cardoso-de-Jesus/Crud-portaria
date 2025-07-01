<?php

include("config.php");
session_start();
if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

$pagina= basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adicionarUsuario.css">
    <title>Adicionar usuário</title>
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

        <form id="formDados" action="CADusuario.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina  ?>">;
            <h1 id="titulo-formulario">Cadastro</h1>
            <input class="inputs" type="text" name="nome" id="nome" placeholder="Nome" required>
            <input class="inputs" type="number" name="numeroDocumento" id="numeroDocumento" placeholder="Numero do documento" min="0" required>
            <input class="inputs" type="date" name="dataNasc" id="dataNasc" placeholder="Data de Nascimento">

            <!-- <h1 id="titulo-formulario">Foto</h1>
            <video autoplay></video>
            <canvas></canvas>
            <button id="tirarFoto" type="button">Tirar foto</button>
            <a id="salvarFoto" href="#" download></a>
            <button id="Adicionar">Salvar</button>
            <script src="js\adicionarPessoa.js">
            </script> -->

            <input type="file" name="imagem" id="imagem" required>
            
            <div id="botoes">
                <input id="enviar" type="submit" value="Enviar">
                <input id="voltar" type="button" onclick="location.href='paginaUsuario.php'" name="voltar" value="Cancelar">
            </div>

        </form>

    </div>
</body>

</html>
<?php
session_start();
if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\paginaUsuario.css">
    <title>Usuários</title>
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

    <form action="paginaUsuario.php" method="$_GET" id="containerPesquisa">
        <div id="top">
            <a href="addUsuario.php"><button type="button" class="btnPaginas">
                    <h3>Adicionar Usuários</h3>
                </button></a>
        </div>
        <div id="bottom">
            <input class="inputs" type="text" name="txtPesquisa" id="txtPesquisa" placeholder="pesquisa">
            <button type="submit" name="btnPesquisar" id="btnPesquisar">
                <h3>Pesquisar</h3>
            </button>
        </div>
    </form>

    <div id="conteudo">

        <?php
        include("config.php");


        function data($dataNascimento)
        {
            $f = explode("-", $dataNascimento); //Gera um array com 0 = ano, 1 = mês, 2 = dia
            $g = $f[2] . "/" . $f[1] . "/" . $f[0]; //Isso é uma string. Formate-a como quiser
            return $g;
        }



        if (isset($_GET["txtPesquisa"])) {


            $pesquisa = $_GET["txtPesquisa"];


            if ($pesquisa == null) {
                $sql = "SELECT * FROM tbUsuarios";
                $res = $conn->query($sql) or die($conn->error);

                while ($row = mysqli_fetch_assoc($res)) {
                    $img = $row['caminho'];
                    echo "<div class='visitante'> <table id='tabela'>";
                    echo "<tr><th><h2>Foto</h2></th>
                          <th style='width:35%'><h2>Nome</h2></th>
                          <th><h2>Id</h2></th>
                          <th><h2>N.º do documento</h2></th>
                          <th><h2>Data de nascimento</h2></th></tr>";
                    echo "<tr><td> <img class='imagem' src= ".$img." </td>";
                    echo "<td> <h2>" . $row['nomeUsuario'] . "</h2></td>";
                    echo "<td> <h2>" . $row['pkIdUsuario'] . "</h2></td>";
                    echo "<td><h2>" . $row['numDocUsuario'] . "</h2></td>";
                    echo "<td> <h2>" . data($row['dataNascUsuario']) . "</h2></td></tr></table>";
                    echo "<div class='btnsVisita'>";
                    echo "<td><a href='editarUsuario.php?id=" . $row['pkIdUsuario'] . "'><button class='btn'>Editar</button></a>  <a href='excluirUsuario.php?id=" . $row['pkIdUsuario'] . "'><button class='btn-excluir'>Excluir</button></a></td>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                $sql = "SELECT * FROM tbUsuarios WHERE nomeUsuario LIKE '$pesquisa%' OR numDocUsuario LIkE '$pesquisa'";
                $res = $conn->query($sql) or die($conn->error);
                $qtd = $res->num_rows;


                if ($qtd > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['pkIdUsuario'];

                        echo "<div class='visitante'> <table id='tabela'>";
                        echo "<tr><th><h2>Foto</h2></th>
                          <th style='width:35%'><h2>Nome</h2></th>
                          <th><h2>Id</h2></th>
                          <th><h2>N.º do documento</h2></th>
                          <th><h2>Data de nascimento</h2></th></tr>";
                        echo "<tr><td><h2> <img class='imagem' src= " . $row['caminho'] . " </h2></td>";
                        echo "<td> <h2>" . $row['nomeUsuario'] . "</h2></td>";
                        echo "<td> <h2>" . $row['pkIdUsuario'] . "</h2></td>";
                        echo "<td><h2>" . $row['numDocUsuario'] . "</h2></td>";
                        echo "<td> <h2>" . $row['dataNascUsuario'] . "</h2></td></table>";
                        echo "<div class='btnsVisita'>";
                        echo "<td><a href='editarUsuario.php?id=" . $row['pkIdUsuario'] . "'><button class='btn'>Editar</button></a>  <a href='excluirUsuario.php?id=" . $row['pkIdUsuario'] . "'><button class='btn-excluir'>Excluir</button></a></td>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='visita'>";
                    echo "<h2>Nenhum item encontrado!</h2>";
                    echo "</div>";
                }
            }
        }


        ?>
    </div>

</body>

</html>
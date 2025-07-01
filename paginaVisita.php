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
    <link rel="stylesheet" href="css\paginaVisita.css">
    <title>Visitas</title>
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

    <form action="paginaVisita.php" method="$_GET" id="containerPesquisa">
        <div id="top">
            <a href="addVisita.php"><button type="button" class="btnPaginas">
                    <h3>Adicionar visita</h3>
                </button></a>
        </div>
        <div id="bottom">
            <input class="inputs" type="text" list="motivos" name="txtPesquisa" id="txtPesquisa" placeholder="pesquisar id ou motivo de visita">
            <datalist id="motivos">
                <option value="Direção"></option>
                <option value="Evento"></option>
                <option value="Ginasio"></option>
                <option value="Secretaria"></option>
            </datalist>

            <button type="submit" name="btnPesquisar" id="btnPesquisar">
                <h3>Pesquisar</h3>
            </button>

        </div>
    </form>

    <div id="conteudo">

        <?php

        include("config.php");

        
        function data($dataVisita){
            $f = explode("-", $dataVisita); //Gera um array com 0 = ano, 1 = mês, 2 = dia
            $g = $f[2]; //Isso é uma string. Formate-a como quiser
            return $g;
          }


        if (isset($_GET["txtPesquisa"])) {

            $pesquisa = $_GET["txtPesquisa"];

            //Verifica se a caixa de pesquisa está vazia.
            if ($pesquisa == null) {
                $sql = "SELECT  v.pkIdVisita, v.motivoVisita,v.fkIdUsuario, u.nomeUsuario, v.dataVisita, v.dataSaidaVisita
                FROM tbVisitas v
                JOIN tbusuarios u on v.fkIdUsuario = u.pkIdUsuario
                ORDER BY dataVisita DESC
                ";
                $res = $conn->query($sql) or die($conn->error);

                while ($row = mysqli_fetch_assoc($res)) {
                    
                    //Echo para criar as caixas com a informação.
                    echo "<div class='visitante'> <table id='tabela'>";
                    echo "<tr><th><h3> Id do usuario</h3></th>
                    <th><h3> Nome</h3></th>                    
                    <th><h3> Motivo</h3></th>
                    <th><h3> Entrada</h3></th>
                    <th><h3> Saida</h3></th>
                    <th><h3> Data</h3></th></tr>";
                    echo "<tr><td><h2>" . $row['fkIdUsuario'] . "</h2></td>";
                    echo "<td><h2>" .$row['nomeUsuario'] . "</h2></td>";
                    echo "<td><h2>" . $row['motivoVisita'] . "</h2></td>";
                    echo "<td><h2>" . date('H:i:s' ,strtotime($row['dataVisita'])) . "</h2></td>";
                    echo "<td><h2>" . date('H:i:s' ,strtotime($row['dataSaidaVisita'])) . "</h2></td>";
                    echo "<td><h2>" . date('d/m/Y' ,strtotime($row['dataVisita'])) . "</h2></td></tr></table>";
                    echo "<div class='btnsVisita'>";
                    echo "<td><a href='editarVisita.php?id=" . $row['pkIdVisita'] . "'><button class='btn'>Editar</button></a>  <a href='excluirVisita.php?id=" . $row['pkIdVisita'] . "'><button class='btn-excluir'>Excluir</button></a></td>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                $sql = "SELECT  v.pkIdVisita, v.motivoVisita,v.fkIdUsuario, u.nomeUsuario, v.dataVisita
                FROM tbVisitas v
                JOIN tbusuarios u on v.fkIdUsuario = u.pkIdUsuario 
                WHERE fkIdUsuario = '$pesquisa' OR motivoVisita = '$pesquisa'";
                $res = $conn->query($sql) or die($conn->error);
                $qtd = $res->num_rows;


                if ($qtd > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        
                        //Echo para criar as caixas com a informação.
                        echo "<div class='visitante'> <table id='tabela'>";
                        echo "<tr><th><h3> Id do usuario</h3></th>
                        <th><h3> Nome</h3></th>
                        <th><h3> Motivo</h3></th>
                        <th><h3> Data</h3></th></tr>";
                        echo "<tr><td><h2>" . $row['fkIdUsuario'] . "</h2></td>";
                        echo "<td><h2>" .$row['nomeUsuario'] . "</h2></td>";
                        echo "<td><h2>" . $row['motivoVisita'] . "</h2></td>";
                        echo "<td><h2>" . $row['dataVisita'] . "</h2></td></tr></table>";
                        echo "<div class='btnsVisita'>";
                        echo "<td><a href='editarVisita.php?id=" . $row['pkIdVisita'] . "'><button class='btn'>Editar</button></a>  <a href='excluirVisita.php?id=" . $row['pkIdVisita'] . "'><button class='btn-excluir'>Excluir</button></a></td>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='visita'>";
                    echo "<h3>Nenhum item encontrado!</h3>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>

</body>

</html>
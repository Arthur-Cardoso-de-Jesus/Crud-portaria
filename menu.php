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
    <link rel="stylesheet" href="css/menu.css">
    <title>Menu</title>
</head>

<body>
    <div id="header">
        <h1>Portaria CSL</h1>
        <div id="imagem">

            <img id="imgLogo" src="img\ULBRA-vector-logo-removebg-preview (1).png">
        </div>
    </div>


    <div id="container">
        <div id="esquerda">
            <button onclick="location.href='paginaFuncionario.php'" class="btn-container">
                <H1>Meu perfil</h1>
            </button>
            <button onclick="location.href='paginaUsuario.php'" class="btn-container">
                <h1>Usuários</h1>
            </button>
            <button onclick="location.href='paginaVisita.php'" class="btn-container">
                <h1>Visitas</h1>
            </button>
            <button onclick="location.href='logout.php'" class="btn-container">
                <h1>Sair</h1>
            </button>
        </div>
        <div id="direita">

            <fieldset>
                <legend>
                    <h1>Visitas ativas</h1>
                </legend>
                <div id="visita">


                    <?php

                    include("config.php");

                    $sql = "SELECT pkIdVisita FROM tbVisitas WHERE dataSaidaVisita IS NULL";
                    $res = $conn->query($sql) or die($conn->error);
                    $qtd = $res->num_rows;

                    if (!empty($qtd)) {

                        $sql = "SELECT v.pkIdVisita, v.dataVisita, u.nomeUsuario,  u.caminho
                        FROM tbVisitas v
                        JOIN tbUsuarios  u on v.fkIdUsuario=u.pkIdUsuario
                        WHERE v.dataSaidaVisita IS NULL";
                        $res = $conn->query($sql) or die($conn->error);

                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<div class='visitante'> <table id='tabela'>";
                            echo "<tr><th><h2>Foto</h2></th>
                            <th><h2>Id</h2></th>
                             <th style='width:35%'><h2>Nome</h2></th>
                             <th><h2>Data de Entrada</h2></th></tr>";
                            echo "<tr><td> <img class='retrato' src=" . $row['caminho'] . "  </td>";
                            echo "<td> <h2>" . $row['pkIdVisita'] . "</h2></td>";
                            echo "<td> <h2>" . $row['nomeUsuario'] . "</h2></td>";
                            echo "<td><h2>" . date('H:i:s | d/m/Y', strtotime($row['dataVisita'])) . "</h2></td></tr></table>";
                            echo "<div class='btnsVisita'>";
                            echo "<td><a href='CONFIRMACAOSAIDA.php?id=" . $row['pkIdVisita'] . "'><button class='btn'>Confirmar saida</button></a> </td>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div Class='visitante'>
                               <h3>Nenhuma visita ativa!</h3>
                               </div>";
                        echo "<style>#visita{ overflow-y: hidden;}
                                    fieldset{height:8em}    
                        </style>";   
                    }

                    ?>
                </div>
            </fieldset>
        </div>
    </div>
</body>

</html>
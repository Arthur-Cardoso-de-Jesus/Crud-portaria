<?php
session_start();
if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

include("config.php");

$back = "true";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\addVisita.css">




    <title>Adicionar visitas</title>
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

    <form id="containerPesquisa" action="CADvisita.php" method="post">
        <h1 id="titulo-formulario">Adicione a visita.</h1>
        <label for="identificador">Id do visitante:</label>

        <input type="text" name="identificador" id="id" placeholder="Procure pelo nome id ou numero de documento!"  onkeyup="javascript:load_data(this.value)" />
        <span id="search_result"></span>

        <label for="motivo">Motivo da visita:</label>
        <select id="motivo" name="motivo">
            <option value="Direção">Direção</option>
            <option value="Evento">Evento</option>
            <option value="Ginasio">Ginasio</option>
            <option value="Secretaria">Secretaria</option>
        </select>

        <div id="botoes">
            <input id="enviar" type="submit" value="Enviar">
            <input id="voltar" type="button" onclick="location.href='paginaVisita.php'" name="voltar" value="Cancelar">
            <input id="cadastrar" type="button" onclick='location.href="addUsuario.php"'   value="Novo Usuário">
       
        </div>

    </form>


</body>

</html>



<script>
    

function get_text(event)
{

    var string = event;
    

		document.getElementsByName('identificador')[0].value = string;;
	
        document.getElementById('search_result').innerHTML = '';

	};

    function padZerosToLength (value, minLength, padChar) {
    var iValLength= value.toString().length;
    return ((new Array((minLength + 1) - iValLength).join(padChar)) + value);
}
	

    function load_data(query) {

        if (query.length >= 2) {
            var form_data = new FormData();

            form_data.append('query', query);

            var ajax_request = new XMLHttpRequest();

            ajax_request.open('POST', 'process_data.php');

            ajax_request.send(form_data);

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    var response = JSON.parse(ajax_request.responseText);
                    console.log(response);
                    var html = '<div class="list-group">';

                    if (response.length > 0) {
                    
                        for (var count = 0; count < response.length; count++) {
                            html += '<a href="#" class="sugestoes" onclick="get_text(' + response[count].pkIdUsuario + ')" >' + response[count].nomeUsuario + '</a>';
                        }
                    } else {
                        html += '<a href="#" class="sugestoes">Nenhum cadastro encontrado!</a>';
                    }

                    html += '</div>';

                    document.getElementById('search_result').innerHTML = html;
                }
            }
        } else {
            document.getElementById('search_result').innerHTML = '';
        }
    }
</script>
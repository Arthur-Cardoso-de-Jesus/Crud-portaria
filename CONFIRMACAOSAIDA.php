<?php
// verificar se o usuário está logado
session_start();


// conectar-se ao banco de dados
include("config.php");

// verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // atualizar os dados do usuário no banco de dados
    $id = $_POST["pkIdVisita"];
    var_dump($id);
    $dataSaida = $_POST["time"];

    if (empty($dataSaida)) {
        $sql = "UPDATE tbVisitas SET dataSaidaVisita = CURRENT_TIMESTAMP WHERE pkIdVisita='$id'";
    } else {
        $sql = "UPDATE tbVisitas SET dataSaidaVisita='$dataSaida' WHERE pkIdVisita='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Visita atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar visita: " . mysqli_error($conn);
    }
    header("Location: menu.php");
    // redirecionar de volta para a pagina de visitas
    exit();
} else {
    $id = $_GET["id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\CONFIRMACAOSAIDA.css">
    <title>Confirmar saida.</title>
</head>

<body>
    <form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1 id="titulo-formulario">Confirmar horário de saida.</h1>

        <input id="pkIdvisita" type="hidden" name="pkIdVisita" value="<?php echo $id ?>">

        <label for="time">
            <h2>horário: </h2><h3>(Se o campo estiver nulo o horaio é colocado como o de agora.)</h3>
        </label>
        <input id="time" class="login" placeholder="Id do visitante" type="datetime-local" name="time">
        <div id="botoes">
            <input id="editar" type="submit" name="submit" value="Salvar">
            <a href='menu.php'><input id="voltar" type="button" name="voltar" value="Cancelar"></a>
        </div>
    </form>
</body>

</html>
<?php
session_start();
if (empty($_SESSION)) {
    echo "<script> location.href='index.php'; </script>";
}

include("config.php");

// Pega os dados da sessao para colocar nos inputs
$nomeFuncionario = $_SESSION['nome'];
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];

// Verifica se o formulario foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados do formulario
    $id = $_SESSION['id'];
    $nome = $_POST['nomeFunc'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $senhaConfirma = $_POST['senhaConfirma'];
    $senhaMd5 = md5($senha);

    // Verifica se a senha está igual e envia para o banco
    if(empty($senha)){
        $sql = "UPDATE tbFuncionarios SET nomeFunc='$nome', usuarioFunc='$usuario' WHERE pkIdFunc='$id'";
        $resultado = mysqli_query($conn,$sql);
        echo "Atualizado com sucesso!"; 
}else if ($senha == $senhaConfirma) {
        $sql = "UPDATE tbFuncionarios SET nomeFunc='$nome', usuarioFunc='$usuario', senhafunc='$senhaMd5' WHERE pkidfunc='$id'";
        $resultado = mysqli_query($conn, $sql);
        echo "Enviado com sucesso!";
    } else {
        echo "Erro ao atualizar." . mysqli_error($conn);
        
    }

    $_SESSION["usuario"] = $usuario;
    $_SESSION["nome"] = $nome;
    $_SESSION["senha"] = $senhaMd5;
    
    header("Location: paginaFuncionario.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="css\editarFuncionario.css">
    <title>Editar funcionário</title>
</head>

<body>
    <form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <h1 id="titulo-formulario">Editar usuario</h1>
        <input placeholder="Nome" type="text" name="nomeFunc" value="<?php echo $nomeFuncionario; ?>" required>
        <input placeholder="Usuario" type="type" name="usuario" value="<?php echo $usuario; ?>" required>
        <input placeholder="Senha" type="text" name="senha" >
        <input placeholder="Confirmar senha" type="text" name="senhaConfirma" >

        <div id="botoes">
            <input id="editar" type="submit" name="submit" value="Editar">
            <a href='paginaFuncionario.php'><input id="voltar" type="button" name="voltar" value="Cancelar"></a>
        </div>
    </form>

</body>

</html>
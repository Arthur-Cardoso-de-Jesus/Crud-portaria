<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\paginaCadastro.css">
    <title>Document</title>
</head>
<body>
    <div id="container">
<form id="formulario" action="CAD.php" method="post">
        <h1 id="titulo-formulario">Cadastro</h1>
        <input class="inputs" type="text" name="nome" id="nome" placeholder="Nome" required>
        <input class="inputs" type="text" name="usuario" id="usuario" placeholder="Usuario" required>
        <input class="inputs" type="password" name="senha" id="senha" placeholder="Senha" required>
       <button> Salvar </button>
    </form>
</div>
</body>
</html>
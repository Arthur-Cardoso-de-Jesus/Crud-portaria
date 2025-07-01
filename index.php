<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css";>
    <title>Inicio</title>
</head>
<body>
<div id="container">
    <form action="login.php" method="post"> 
        
        <h1>LOGIN</h1>
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
        
        <input type="password" id="senha" name="senha" placeholder="Senha" required>
        
        <button>ENTRAR</button>
        
        <p>Crie seu login <a href="paginaCadastro.php" id="cadastrar">AQUi</a></p>
    </form>
    </div>
</body>
</html>
<?php
include("config.php");

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Diretório para onde o arquivo será enviado
$target_dir = "uploads/";

// pega o nome original da imagem
$nomeImagem = $target_dir .  basename($_FILES["imagem"]["name"]);

// pega a data de hoje
$today = date("-m-d-y");

// modifica o nome da imgem com um id unico
$_FILES["imagem"]["name"] = uniqid() . $today;


// Caminho completo do arquivo no servidor
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);


// Obtém os dados do formulário
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$numeroDocumento = mysqli_real_escape_string($conn, $_POST['numeroDocumento']);
$dataNascimento =   $_POST['dataNasc'];
$pagina= mysqli_real_escape_string($conn, $_POST['pagina']);

// Verifica se houve erro na inserção
if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
    // Se o arquivo foi movido com sucesso, insira o caminho no BD
    $query = "INSERT INTO tbUsuarios (nomeUsuario, numDocUsuario, dataNascUsuario, nomeImg, caminho) VALUES ('$nome','$numeroDocumento','$dataNascimento','" . $nomeImagem . "','" . $target_file . "')";

    $resultado = mysqli_query($conn, $query);
    echo "A imagem foi carregada com sucesso!";
} else {
    echo "Erro ao fazer upload da imagem.";
};

// Fecha a conexão com o MySQL
$conn->close();

echo( $pagina);
// Redireciona para a página de sucesso
if($pagina == "addVisita.php"){
    echo "<script> location.href='addVisita.php'; </script>";
}else{
    echo "<script> location.href='paginaUsuario.php'; </script>";
}

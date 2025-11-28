<?php
$host = "localhost";
$usuario = "root";
$senha = ""; // vazio se não configurou senha no XAMPP
$banco = "hospital/cad"; // coloque o nome do seu banco

$conexao = new mysqli($host, $usuario, $senha, $banco);

// verificar se deu certo
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// opcional: mostrar mensagem de sucesso
// echo "Conectado com sucesso!";
?>

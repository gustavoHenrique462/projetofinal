<?php
include("includes/conexao.php");

// Verifica se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p style='color:red; font-weight:bold;'>ID inválido!</p>";
    exit;
}

$id = intval($_GET['id']);
?>

<h2>Tem certeza que deseja excluir este paciente?</h2>

<a href="index.php?page=delete_confirm&id=<?= $id ?>" class="btn-confirmar">Sim, excluir</a>

<a href="index.php?page=listar" class="btn-cancelar">Cancelar</a>


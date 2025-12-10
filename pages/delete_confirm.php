<?php
include("includes/conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?page=listar&erro=sem_id");
    exit;
}

$id = intval($_GET['id']);

$sql = $conn->prepare("DELETE FROM pacientes WHERE id = ?");
$sql->bind_param("i", $id);

if ($sql->execute()) {
    header("Location: index.php?page=listar&sucesso=excluido");
} else {
    header("Location: index.php?page=listar&erro=bd");
}
exit;
?>

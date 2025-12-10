<?php
include("includes/conexao.php");

// Verifica se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p style='color:red; font-weight:bold;'>ID inválido!</p>";
    exit;
}

$id = intval($_GET['id']);

// Buscar paciente no banco
$sql = $conn->prepare("SELECT * FROM pacientes WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();
$res = $sql->get_result();

if ($res->num_rows == 0) {
    echo "<p style='color:red; font-weight:bold;'>Paciente não encontrado.</p>";
    exit;
}

$row = $res->fetch_object();
?>

<!-- MENSAGENS DE ERRO / SUCESSO -->
<?php
if (isset($_GET['erro'])) {

    if ($_GET['erro'] == 'campos_vazios') {
        echo "<p style='color:red; font-weight:bold;'>Preencha todos os campos obrigatórios.</p>";
    }

    if ($_GET['erro'] == 'cpf_invalido') {
        echo "<p style='color:red; font-weight:bold;'>O CPF informado é inválido.</p>";
    }

    if ($_GET['erro'] == 'duplicado') {
        echo "<p style='color:red; font-weight:bold;'>Outro paciente já utiliza este CPF, RG ou Cartão SUS.</p>";
    }

    if ($_GET['erro'] == 'bd') {
        echo "<p style='color:red; font-weight:bold;'>Erro ao atualizar os dados.</p>";
    }
}

if (isset($_GET['sucesso'])) {
    echo "<p style='color:green; font-weight:bold;'>Dados atualizados com sucesso!</p>";
}
?>

<h1>Editar Paciente</h1>

<form action="?page=salvar" method="POST">

    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= $row->id ?>">

    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $row->nome ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" name="numero_telefone" value="<?= $row->telefone ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Endereço:</label>
        <input type="text" name="endereco" value="<?= $row->endereco ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>RG:</label>
        <input type="text" name="rg" value="<?= $row->rg ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>CPF:</label>
        <input type="text" name="cpf" value="<?= $row->cpf ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Cartão SUS:</label>
        <input type="text" name="cartao_sus" value="<?= $row->cartao_sus ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Senha (deixe em branco para manter a atual):</label>
        <input type="password" name="senha" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>

</form>

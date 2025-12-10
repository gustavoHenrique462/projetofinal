<style>
p {
    margin: 5px 0;
}
</style>

<?php
// EXIBIR MENSAGENS DE ERRO / SUCESSO ENVIADAS PELO salvar_user.php
if (isset($_GET['erro'])) {

    if ($_GET['erro'] == 'campos_vazios') {
        echo "<p style='color:red; font-weight:bold;'>Preencha todos os campos obrigatórios.</p>";
    }

    if ($_GET['erro'] == 'cpf_invalido') {
        echo "<p style='color:red; font-weight:bold;'>O CPF informado é inválido.</p>";
    }

    if ($_GET['erro'] == 'duplicado') {
        echo "<p style='color:red; font-weight:bold;'>Já existe um paciente cadastrado com este CPF, RG ou Cartão SUS.</p>";
    }

    if ($_GET['erro'] == 'bd') {
        echo "<p style='color:red; font-weight:bold;'>Erro ao salvar no banco de dados. Tente novamente.</p>";
    }
}

if (isset($_GET['sucesso'])) {
    echo "<p style='color:green; font-weight:bold;'>Paciente cadastrado com sucesso!</p>";
}
?>

<h1>Novo Paciente</h1>

<form action="?page=salvar" method="POST">

    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Número de Telefone:</label>
        <input type="text" 
               name="numero_telefone" 
               class="form-control" 
               oninput="maskTelefone(this)" 
               maxlength="15"
               placeholder="(00) 00000-0000"
               required>
    </div>

    <div class="mb-3">
        <label>Endereço:</label>
        <input type="text" name="endereco" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>RG:</label>
        <input type="text" 
               name="rg" 
               class="form-control" 
               oninput="maskRG(this)" 
               maxlength="12"
               placeholder="00.000.000-0"
               required>
    </div>

    <div class="mb-3">
        <label>CPF:</label>
        <input type="text" 
               name="cpf" 
               class="form-control" 
               oninput="maskCPF(this)" 
               maxlength="14"
               placeholder="000.000.000-00"
               required>
    </div>

    <div class="mb-3">
        <label>Cartão SUS:</label>
        <input 
            type="text" 
            name="cartao_sus" 
            class="form-control"
            oninput="maskSUS(this)"
            maxlength="18"
            placeholder="000 0000 0000 0000"
            required>
    </div>

    <div class="mb-3">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>

</form>




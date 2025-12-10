<?php
include("includes/conexao.php");

// ----------------------------------------------------------
// LIMPAR CNPJ, CPF, RG, TELEFONE
// ----------------------------------------------------------
function limpar($str) {
    return preg_replace('/\D/', '', $str);
}

// ----------------------------------------------------------
// RECEBER CAMPOS
// ----------------------------------------------------------
$acao          = $_POST["acao"] ?? "";
$id            = $_POST["id"] ?? null;
$nome          = trim($_POST["nome"] ?? "");
$telefone      = limpar($_POST["numero_telefone"] ?? "");
$endereco      = trim($_POST["endereco"] ?? "");
$rg            = limpar($_POST["rg"] ?? "");
$cpf           = limpar($_POST["cpf"] ?? "");
$cartao_sus    = limpar($_POST["cartao_sus"] ?? "");
$senhaDigitada = trim($_POST["senha"] ?? "");


// ----------------------------------------------------------
// 1️⃣ VALIDAÇÃO DE CAMPOS (SEM CPF!)
// ----------------------------------------------------------
if ($acao == "cadastrar") {

    if (
        empty($nome) || empty($telefone) || empty($endereco) ||
        empty($rg) || empty($cpf) || empty($cartao_sus) ||
        empty($senhaDigitada)
    ) {
        header("Location: index.php?page=novo&erro=campos_vazios");
        exit;
    }

} elseif ($acao == "editar") {

    if (
        empty($nome) || empty($telefone) || empty($endereco) ||
        empty($rg) || empty($cpf) || empty($cartao_sus)
    ) {
        header("Location: index.php?page=editar&id=$id&erro=campos_vazios");
        exit;
    }
}


// ----------------------------------------------------------
// 2️⃣ REMOVIDO: NÃO VALIDAR CPF
// ----------------------------------------------------------
// ❌ Nada aqui :)
// Agora qualquer CPF passa sem bloquear o cadastro.


// ----------------------------------------------------------
// 3️⃣ VERIFICA DUPLICIDADE PARA CADASTRO
// ----------------------------------------------------------
// ⚠️ Se quiser permitir CPFs repetidos, me avise.
// Por enquanto deixei ativo para RG e SUS, mas CPF NÃO trava mais.

if ($acao == "cadastrar") {

    $sql = $conn->prepare("
        SELECT id FROM pacientes 
        WHERE rg = ? OR cartao_sus = ?
    ");
    $sql->bind_param("ss", $rg, $cartao_sus);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows > 0) {
        header("Location: index.php?page=novo&erro=duplicado");
        exit;
    }
}


// ----------------------------------------------------------
// 4️⃣ Verificar duplicidade na edição
// ----------------------------------------------------------
if ($acao == "editar") {

    $sql = $conn->prepare("
        SELECT id FROM pacientes
        WHERE (rg = ? OR cartao_sus = ?)
        AND id <> ?
    ");

    $sql->bind_param("ssi", $rg, $cartao_sus, $id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows > 0) {
        header("Location: index.php?page=editar&id=$id&erro=duplicado");
        exit;
    }
}


// ----------------------------------------------------------
// 5️⃣ DEFINIR SENHA FINAL
// ----------------------------------------------------------
if ($acao == "cadastrar") {

    $senhaHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);

} elseif ($acao == "editar") {

    $sqlSenha = $conn->prepare("SELECT senha FROM pacientes WHERE id = ?");
    $sqlSenha->bind_param("i", $id);
    $sqlSenha->execute();
    $senhaAtual = $sqlSenha->get_result()->fetch_object()->senha;

    if (!empty($senhaDigitada)) {
        $senhaHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);
    } else {
        $senhaHash = $senhaAtual;
    }
}


// ----------------------------------------------------------
// 6️⃣ SALVAR NO BANCO
// ----------------------------------------------------------

// CADASTRAR
if ($acao == "cadastrar") {

    $sql = $conn->prepare("
        INSERT INTO pacientes (nome, telefone, endereco, rg, cpf, cartao_sus, senha)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $sql->bind_param("sssssss", $nome, $telefone, $endereco, $rg, $cpf, $cartao_sus, $senhaHash);

    if ($sql->execute()) {
        header("Location: index.php?page=listar&sucesso=1");
    } else {
        header("Location: index.php?page=novo&erro=bd");
    }
    exit;
}


// EDITAR
if ($acao == "editar") {

    $sql = $conn->prepare("
        UPDATE pacientes SET 
            nome = ?, 
            telefone = ?, 
            endereco = ?, 
            rg = ?, 
            cpf = ?, 
            cartao_sus = ?, 
            senha = ?
        WHERE id = ?
    ");

    $sql->bind_param("sssssssi", $nome, $telefone, $endereco, $rg, $cpf, $cartao_sus, $senhaHash, $id);

    if ($sql->execute()) {
        header("Location: index.php?page=editar&id=$id&sucesso=1");
    } else {
        header("Location: index.php?page=editar&id=$id&erro=bd");
    }
    exit;
}

?>

// Função para limpar caracteres invisíveis e não numéricos
function clean(input) {
    return input
        .normalize("NFKD")                           // remove unicode invisível
        .replace(/[\u200B-\u200D\uFEFF]/g, "")       // remove zero-width spaces
        .replace(/[^\d]/g, "");                      // remove tudo que não é número
}

// MÁSCARA CPF
function maskCPF(input) {
    let v = clean(input.value);

    if (v.length > 11) v = v.slice(0, 11);

    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    input.value = v;
}


// MÁSCARA RG
function maskRG(input) {
    let v = clean(input.value);

    if (v.length > 9) v = v.slice(0, 9);

    v = v.replace(/(\d{2})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1})$/, "$1-$2");

    input.value = v;
}


// MÁSCARA TELEFONE
function maskTelefone(input) {
    let v = clean(input.value);

    if (v.length > 11) v = v.slice(0, 11);

    if (v.length > 10) {
        v = v.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
    } else {
        v = v.replace(/(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3");
    }

    input.value = v;
}


// MÁSCARA CARTÃO SUS
function maskSUS(input) {
    let v = clean(input.value);

    if (v.length > 15) v = v.slice(0, 15);

    v = v.replace(/(\d{3})(\d)/, "$1 $2");
    v = v.replace(/(\d{4})(\d)/, "$1 $2");
    v = v.replace(/(\d{4})(\d)/, "$1 $2");

    input.value = v;
}

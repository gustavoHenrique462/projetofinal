<?php
// Arquivo principal do sistema

// Se existir 'page', carrega a página correspondente
$page = isset($_GET['page']) ? $_GET['page'] : null;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Hospitalar</title>

    <!-- Fonts + CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("includes/header.php"); ?>

<main>

<?php
// Controlador de páginas
switch ($page) {
    case "especialidades":
        include("pages/especialidades.php");
        break;

    case "convenios":   // ★★★ NOVA PÁGINA AQUI ★★★
        include("pages/convenios.php");
        break;

    case "novo":
        include("pages/pacientes_create.php");
        break;

    case "listar":
        include("pages/pacientes_list.php");
        break;

    case "editar":
        include("pages/pacientes_edit.php");
        break;

    case "delete":
        include("pages/pacientes_delete.php");
        break;

    case "salvar": 
        include("pages/salvar_user.php");
        break;

    case "delete_confirm":
        include("pages/delete_confirm.php");
        break;


    case "convenios":
    include("pages/convenios.php");
    break;


    default:
        echo "
        <div class='caixa-inicial'>
            <h1>Bem-vindo ao Sistema Hospitalar</h1>
            <p>Use o menu acima para navegar.</p>

            <br>

            <h2>Sobre o Hospital CAD</h2>
            <p>
                O Hospital CAD é uma instituição dedicada ao cuidado integral da saúde,
                oferecendo atendimento humanizado, estrutura moderna e profissionais altamente qualificados.
                Nossa atuação é guiada pelo compromisso com a excelência, responsabilidade social e inovação contínua.
            </p>

            <h3>Missão</h3>
            <p>
                Proporcionar cuidado humanizado, seguro e eficiente, promovendo saúde e qualidade de vida.
            </p>

            <h3>Visão</h3>
            <p>
                Ser referência regional em serviços hospitalares, reconhecido pela inovação, qualidade assistencial
                e compromisso com o bem-estar dos pacientes.
            </p>

            <h3>Valores</h3>
            <ul>
                <li><strong>Humanização:</strong> acolhimento e respeito em todos os atendimentos.</li>
                <li><strong>Excelência:</strong> melhoria contínua dos processos e serviços.</li>
                <li><strong>Ética:</strong> transparência e responsabilidade.</li>
                <li><strong>Segurança:</strong> cuidado prioritário ao paciente.</li>
                <li><strong>Compromisso Social:</strong> contribuição com a comunidade.</li>
                <li><strong>Inovação:</strong> busca constante por soluções modernas em saúde.</li>
            </ul>
        </div>
        ";
    break;
}
?>

</main>

<?php include("includes/footer.php"); ?>
<script src="js/mascaras.js?v=10"></script>

</body>
</html>

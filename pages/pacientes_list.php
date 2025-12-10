<?php
include("includes/conexao.php");

$sql = "SELECT * FROM pacientes";
$res = $conn->query($sql);

// Verifica se existe registro
$temRegistros = ($res->num_rows > 0);
?>

<!-- CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<h1 class="mb-4">Pacientes Cadastrados no Hospital CAD</h1>

<div class="table-responsive">
    <table id="tabelaPacientes" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($temRegistros) : ?>
                <?php while ($row = $res->fetch_object()) : ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $row->nome ?></td>
                        <td><?= $row->telefone ?></td>
                        <td><?= $row->endereco ?></td>
                        <td>
                            <a href="index.php?page=editar&id=<?= $row->id ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?page=delete&id=<?= $row->id ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Nenhum paciente cadastrado.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- JS DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?php if ($temRegistros) : ?>
<script>
$(document).ready(function() {
    $('#tabelaPacientes').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        pageLength: 10,
        ordering: true
    });
});
</script>
<?php endif; ?>

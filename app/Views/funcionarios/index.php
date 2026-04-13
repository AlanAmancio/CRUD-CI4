<?= $this->extend('layout/main'); ?>
<!-- Usa o layout principal (navbar, sidebar, footer, etc) -->

<?= $this->section('conteudo'); ?>
<!-- inicio da seção que será inserido dentro do main.php) -->

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Lista de Funcionários</h3>


        <a href="<?= base_url('funcionarios/new'); ?>" class="btn btn-primary btn-sm">
            Novo Funcionário
        </a>
        <!-- botão que leva para a rota /funcionarios/new (abre o formulario de cadastro) -->
    </div>


    <div class="card-body">

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-sucesso">
                <?= session()->getFlashdata('sucesso'); ?>
                <!-- exibe a mensagem de sucesso -->
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <!-- tabela que vai listar os funcionarios e os cargos -->
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>CPF</th>
                    <th>CBO</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th width="180">Ações</th>
                </tr>

                <!-- cabeçalho da tabela -->
            </thead>

            <tbody>
                <?php if (!empty($funcionarios)): ?>
                    <!-- verifica se existe funcionarios no array -->
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <!-- loop que percorre todos os funcionarios -->
                        <tr>
                            <td><?= $funcionario['fun_nome_completo'] ?></td>
                            <td><?= $funcionario['fun_cpf'] ?></td>
                            <td><?= substr($funcionario['cbo_codigo'], 0, 4) . '-' . substr($funcionario['cbo_codigo'], 4, 2); ?></td>
                            <td><?= $funcionario['cbo_descricao']; ?></td>
                            <td><?= $funcionario['fun_flg_status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                            <!-- mostra ativo ou inativo conforme o valor salvo -->

                            <td>
                                <a href="<?= base_url('funcionarios/edit/' . $funcionario['FuncionarioID']); ?>" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <a href="<?= base_url('funcionarios/delete/' . $funcionario['FuncionarioID']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja relamente excluir este funcionário?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum funcionário cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection(); ?>
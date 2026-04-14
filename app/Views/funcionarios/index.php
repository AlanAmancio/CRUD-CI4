<?= $this->extend('layout/main'); ?>
<!-- Usa o layout principal (navbar, sidebar, footer, etc) -->

<?= $this->section('conteudo'); ?>
<!-- inicio da seção que será inserido dentro do main.php) -->

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Lista de Funcionários cadastrados.</h3>


        <a href="<?= base_url('funcionarios/new'); ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>
            Novo Funcionário
        </a>
        <!-- botão que leva para a rota /funcionarios/new (abre o formulario de cadastro) -->

        <form action="<?= base_url('funcionarios'); ?>" method="get" class="d-flex align-items-center mr-3">
            <!-- Formulário de filtro por status -->

            <div class="input-group input-group-sm" style="width: 220px;">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-filter"></i>
                    </span>
                </div>

                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="1" <?= ($statusSelecionado === '1') ? 'selected' : ''; ?>>Ativos</option>
                    <option value="0" <?= ($statusSelecionado === '0') ? 'selected' : ''; ?>>Inativos</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-sm ml-2">
                Filtrar
            </button>

            <a href="<?= base_url('funcionarios'); ?>" class="btn btn-secondary btn-sm ml-2">
                Limpar
            </a>

        </form>

        <div id="tamanho-tabela-funcionarios"></div>
        <!-- Aqui entra o "mostrar X registros" do DataTable -->

        <div id="filtro-tabela-funcionarios" class="busca-com-icone"></div>
        <!-- Aqui entra o campo de pesquisa do DataTable -->


    </div>


    <section class=" card-body">

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-sucesso">
                <?= session()->getFlashdata('sucesso'); ?>
                <!-- exibe a mensagem de sucesso -->
            </div>
        <?php endif; ?>

        <table id="tabela-funcionarios" class="table table-bordered table-hover">
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
                            <td><?= formatarCpf($funcionario['fun_cpf']); ?></td>
                            <td><?= formatarCbo($funcionario['cbo_codigo']); ?></td>
                            <td><?= $funcionario['cbo_descricao']; ?></td>
                            <td><?= statusFuncionario($funcionario['fun_flg_status']); ?></td>
                            <!-- mostra ativo ou inativo conforme o valor salvo -->

                            <td>
                                <a href="<?= base_url('funcionarios/edit/' . encodeId($funcionario['FuncionarioID'])); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                    Editar
                                </a>

                                <a href="<?= base_url('funcionarios/delete/' . encodeId($funcionario['FuncionarioID'])); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja relamente excluir este funcionário?')"><i class="fas fa-trash"></i>
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

    </section>
</div>

<?= $this->endSection(); ?>
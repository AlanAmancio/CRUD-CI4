<?= $this->extend('layout/main'); ?>
<!-- Usa o layout principal (navbar, sidebar, footer, etc) -->

<?= $this->section('conteudo'); ?>
<!-- Início da seção que será inserida dentro do main.php -->


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Lista de Cargos cadastrados</h3>

        <a href=" <?= base_url('cargos/new'); ?>" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Novo Cargo
        </a>
        <!-- botão que leva para a rota /cargos/new (abre o formulário de cadastro) -->

        <div id="tamanho-tabela-cargos"></div>
        <!-- Aqui vai o "mostrar X registros" -->


        <div id="filtro-tabela-cargos" class="busca-com-icone"></div>
        <!-- campo de pesquisa do datatable -->

    </div>


    <div class=" card-body">

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-sucesso">
                <?= session()->getFlashdata('sucesso'); ?>
                <!-- Exibe a mensagem de sucesso -->
            </div>
        <?php endif; ?>

        <table id="tabela-cargos" class="table table-bordered table-hover">
            <!-- tabela que vai listar os cargos -->
            <thead>
                <tr>
                    <th>CBO</th>
                    <th>Descrição</th>
                    <th width="180">Ações</th>
                </tr>
                <!-- cabeçalho da tabela -->
            </thead>

            <tbody>
                <?php if (!empty($cargos)): ?>
                    <!-- verifica se existe cargos no array -->
                    <?php foreach ($cargos as $cargo): ?>
                        <!-- aqui é foda, é um loop que percorre todos os cargos -->
                        <tr>
                            <td><?= formatarCbo($cargo['cbo_codigo']) ?></td>
                            <!-- mostra o código do cargo e coloca o "-", usa o helper para formatar o CBO -->
                            <td><?= $cargo['cbo_descricao']; ?></td>
                            <!-- Mostra a descrição do cargo -->
                            <td>
                                <a href="<?= base_url('cargos/edit/' . encodeId($cargo['CBOID'])); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                    Editar
                                </a>
                                <!-- botão que leva para /cargos/edit/ID -->

                                <a href="<?= base_url('cargos/delete/' . encodeId($cargo['CBOID'])); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este cargo?')"><i class="fas fa-trash"></i>
                                    Excluir
                                </a>
                                <!-- botão que chama /cargos/delete/ID e pede confirmação -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- se não, caso não tenha cargos cadastrados -->
                    <tr>
                        <td colspan="3" class="text-center">Nenhum cargo cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
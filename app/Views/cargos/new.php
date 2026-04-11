<?= $this->extend('layout/main'); ?>
<!-- usa o layout principal (navbar, sidebar, footer) -->

<?= $this->section('conteudo'); ?>
<!-- inio da seção que será inserida dentro do main.php sera que coloca?-->

<div class="card">
    <div class="card-header">
        <h3 class="card=title">Novo Cargo</h3>
    </div>

    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <!-- verificar se existem erros de validação na parada, se existir ele mostra -->

            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                        <li><?= $erro; ?></li>
                        <!-- mostra cada erro em uma linha -->
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>

        <form action="<?= base_url('cargos/create'); ?>" method="post">
            <!-- Formulário que envia para a rota /cargos/create -->

            <?= csrf_field(); ?>
            <!-- segurança para o formulário -->

            <div class="form-group">
                <label for="cbo_codigo">CBO</label>

                <input
                    type="text"
                    name="cbo_codigo"
                    id="cbo_codigo"
                    class="form-control"
                    value="<?= old('cbo_codigo'); ?>">
                <!-- campo para digitar o código do cargo -->
                <!-- old('cbo_codigo') mantém o valor digitado se der erro -->
            </div>

            <div class="form-group">
                <label for="cbo_descricao">Descrição</label>

                <input
                    type="text"
                    name="cbo_descricao"
                    id="cbo_descricao"
                    class="form-control"
                    placeholder="Informe a descrição do CBO"
                    value="<?= old('cbo_descricao'); ?>">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Botão que envia o formulário -->

                <a href="<?= base_url('cargos'); ?>" class="btn btn-secondary">Voltar</a>
                <!-- Botão que volta para a listagem -->
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>
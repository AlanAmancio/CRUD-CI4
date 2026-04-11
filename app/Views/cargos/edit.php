<?= $this->extend('layout/main'); ?>
<!-- Usa o layout principal -->

<?= $this->section('conteudo'); ?>
<!-- inicio do conteudo -->


<div class="card">
    <div class="card-header">
        <h3 class="card-tittle">Editar Cargo</h3>
    </div>


    <div class="card-body">

        <?php if (session()->getFlashdata('errors')): ?>
            <!-- Verifica se existem erros de validação -->

            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                        <li><?= $erro; ?></li>
                        <!-- Mostra cada erro em uma linha -->
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('cargos/update/' . $cargo['CBOID']); ?>" method="post">
            <!-- Formulario que envia a rota  /cargos/update/ID -->

            <?= csrf_field() ?>
            <!-- proteção de segurança do formulário -->
            <div class="form-group">
                <label for="cbo_codigo">CBO</label>

                <input
                    type="text"
                    name="cbo_codigo"
                    id="cbo_codigo"
                    class="form-control"
                    value="<?= old('cbo_codigo', $cargo['cbo_codigo']); ?>">
                <!-- campo para digitar o código do cargo -->
                <!-- old('cbo_codigo') mantém o valor digitado se der erro -->
            </div>

            <div class="form-group">
                <label for="cbo_descricao">Descrição</label>

                <input
                    type="text"
                    name="cbo_descricao"
                    id="cbo-descricao"
                    class="form-control"
                    value="<?= old('cbo_descricao', $cargo['cbo_descricao']); ?>">
                <!-- Campo já preenchido com a descrição atual -->
                <!-- Se der erro, mantém o valor digitado -->

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <!-- botão que envia o formulário -->

                <a href="<?= base_url('cargos'); ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
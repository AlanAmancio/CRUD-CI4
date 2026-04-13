<?= $this->extend('layout/main'); ?>
<!-- layout principal -->

<?= $this->section('conteudo'); ?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cadastrar Novo Funcionario</h3>
    </div>
</div>

<div class="card-body">
    <?php if (session()->getFlashdata('errors')): ?>
        <!-- verificar se existem erros de validação, se existir ele mostra -->

        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                    <li><?= $erro; ?></li>
                    <!-- mostrar cada erro em uma linha -->
                <?php endforeach; ?>
            </ul>
        </div>

    <?php endif; ?>

    <form action="<?= base_url('funcionarios/create'); ?>" method="post">
        <!-- Formulário que envia para a rota /funcionarios/create -->

        <?= csrf_field(); ?>
        <!-- segurança para o formulário -->

        <div class="form-group">
            <label for="fun_codigo">Código</label>


            <input
                type="text"
                name="fun_codigo"
                id="cbo_codigo"
                class="form-control"
                value="<?= old('fun_codigo'); ?>">
            <!-- campo para digitar o código do funcionário -->
            <!-- old('fun_codigo') mantém o valor digitado se der erro -->
        </div>

        <div class="form-group">
            <label for="fun_cpf">CPF</label>

            <input
                type="text"
                name="fun_cpf"
                id="fun_cpf"
                class="form-control"
                value="<?= old('fun_cpf'); ?>">
        </div>

        <div class="form-group">
            <label for="fun_nome_completo">Nome Completo</label>

            <input
                type="text"
                name="fun_nome_completo"
                id="fun_nome_completo"
                class="form-control"
                value="<?= old('fun_nome_completo'); ?>">
        </div>

        <div class="form-group">
            <label for="fun_CBOID">Cargo</label>

            <select name="fun_CBOID" id="fun_CBOID" class="form-control">
                <option value="">Selecione um cargo</option>

                <?php foreach ($cargos as $cargo): ?>
                    <option value="<?= $cargo['CBOID']; ?>" <?= old('fun_CBOID') == $cargo['CBOID'] ? 'selected' : ''; ?>>
                        <?= $cargo['cbo_descricao']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <!-- io controller mandou um array chamando $cargos, a view vai percorrer esse array e criar uma <option> para cada cargo -->
        </div>

        <div class="form-group">
            <label for="fun_flg_status">Status</label>

            <select name="fun_flg_status" id="fun_flg_status" class="form-control">
                <option value="">Selecione o status</option>
                <option value="1" <?= old('fun_flg_status') == '1' ? 'selected' : ''; ?>>Ativo</option>
                <option value="0" <?= old('fun_flg_status') == '0' ? 'selected' : ''; ?>>Inativo</option>
            </select>
            <!-- select de status -->
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="<?= base_url('funcionarios'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </form>

</div>
</div>

<?= $this->endSection(); ?>
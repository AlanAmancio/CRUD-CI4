<?= $this->extend('layout/main'); ?>
<!-- Usa o layout principal -->

<?= $this->section('conteudo'); ?>
<!-- inicio do conteudo -->

<div class="card">
    <div class="card-header">
        <h3 class="card-tittle">Edição de Funcionário</h3>
    </div>

    <section class="card-body">

        <?php if (session()->getFlashdata('errors')): ?>
            <!-- verificar se existem erros de validação -->

            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                        <li><?= $erro; ?></li>
                        <!-- mostra cada erro em uma linha -->
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <form action="<?= base_url('funcionarios/update/' . encodeId($funcionario['FuncionarioID'])); ?>" method="post">
            <!-- formulario que envia a rota /funcionarios/update/ID -->

            <?= csrf_field() ?>
            <!-- proteção do formulario -->
            <div class="form-group">
                <label for="fun_codigo">Código</label>

                <input
                    type="text"
                    name="fun_codigo"
                    id="fun_codigo"
                    class="form-control"
                    value="<?= old('fun_codigo', $funcionario['fun_codigo']); ?>">
                <!-- campo código já preenchido -->
            </div>

            <div class="form-group">
                <label for="fun_cpf">CPF</label>

                <input
                    type="text"
                    name="fun_cpf"
                    id="fun_cpf"
                    class="form-control"
                    value="<?= old('fun_cpf', $funcionario['fun_cpf']); ?>">
                <!-- campo CPF já preenchido -->
            </div>

            <div class="form-group">
                <label for="fun_nome_completo">Nome Completo</label>

                <input
                    type="text"
                    name="fun_nome_completo"
                    id="fun_nome_completo"
                    class="form-control"
                    value="<?= old('fun_nome_completo', $funcionario['fun_nome_completo']); ?>">
                <!-- campo com o nome completo já preenchido -->
            </div>

            <div class="form-group">
                <label for="fun_CBOID">Cargo</label>

                <select name="fun_CBOID" id="fun_CBOID" class="form-control" class="form-control">
                    <option value="">Selecione um cargo</option>

                    <?php foreach ($cargos as $cargo): ?>
                        <option
                            value="<?= $cargo['CBOID']; ?>"
                            <?= old('fun_CBOID', $funcionario['fun_CBOID']) == $cargo['CBOID'] ? 'selected' : ''; ?>>
                            <?= $cargo['cbo_descricao']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <!-- Select de cargos com o cargo atual selecionado -->
            </div>

            <div class="form-group">
                <label for="fun_flg_status">Status</label>

                <select name="fun_flg_status" id="fun_flg_status" class="form-control">
                    <option value="">Selecione o status</option>
                    <option value="1" <?= old('fun_flg_status', $funcionario['fun_flg_status']) == '1' ? 'selected' : ''; ?>>
                        Ativo
                    </option>
                    <option value="0" <?= old('fun_flg_status', $funcionario['fun_flg_status']) == '0' ? 'selected' : ''; ?>>
                        Inativo
                    </option>
                </select>
                <!-- select de status com o valor atual selecionado -->
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="<?= base_url('funcionarios'); ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </section>


</div>

<?= $this->endSection(); ?>
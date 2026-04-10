<?= $this->include('layout/head'); ?>
<?= $this->include('layout/navbar'); ?>
<?= $this->include('layout/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1><?= $titulo ?? 'Sistema'; ?></h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?= $this->renderSection('conteudo'); ?>
        </div>
    </section>

</div>

<?= $this->include('layout/footer'); ?>
<?= $this->include('layout/scripts'); ?>
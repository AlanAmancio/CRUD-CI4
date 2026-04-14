<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>



<script>
    // inicializa o DataTable da tabela de cargos
    $(document).ready(function() {

        // só executa esse código quando a pagina estiver totalmente carregada
        const tabelaCargos = $('#tabela-cargos').DataTable({
            language: {
                decimal: "",
                emptyTable: "Nenhum registro encontrado",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 até 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros no total)",
                infoPostFix: "",
                thousands: ".",
                lengthMenu: "Mostrar _MENU_ registros",
                loadingRecords: "Carregando...",
                processing: "Processando...",
                search: "Pesquisar:",
                zeroRecords: "Nenhum registro encontrado",
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior"

                },
                aria: {
                    sortAscending: ": ativar para ordenar a coluna de forma crescente",
                    sortDesceding: ": ativar para ordenar coluna de forma decrescente"
                }
            }
        });


        // move o "mostrar X registros"
        $('#tabela-cargos_length').appendTo('#tamanho-tabela-cargos');


        // move o campo de pesquisa gerado pelo datatable para dentro da div personalizada
        $('#tabela-cargos_filter').appendTo('#filtro-tabela-cargos');

        // Remove o texto "Pesquisar:" e deixa apenas o input
        $('#filtro-tabela-cargos label').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();

        // Adiciona um placeholder no campo de pesquisa
        $('#filtro-tabela-cargos input').attr('placeholder', 'Pesquisar cargo...');

        // ===================================================================================================================================================

        // Inicializa o DataTable da tabela de funcionários
        const tabelaFuncionarios = $('#tabela-funcionarios').DataTable({
            language: {
                decimal: "",
                emptyTable: "Nenhum registro encontrado",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 até 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros no total)",
                infoPostFix: "",
                thousands: ".",
                lengthMenu: "Mostrar _MENU_ registros",
                loadingRecords: "Carregando...",
                processing: "Processando...",
                search: "Pesquisar:",
                zeroRecords: "Nenhum registro encontrado",
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior"
                },
                aria: {
                    sortAscending: ": ativar para ordenar a coluna de forma crescente",
                    sortDescending: ": ativar para ordenar a coluna de forma decrescente"
                }
            }
        });

        // move o "mostrar X registros"
        $('#tabela-funcionarios_length').appendTo('#tamanho-tabela-funcionarios');


        // move o campo de pesquisa gerado pelo datatabel para dentro da div igual o de cima
        $('#tabela-funcionarios_filter').appendTo('#filtro-tabela-funcionarios');

        // Remove o texto "Pesquisar:" e deixa apenas o input
        $('#filtro-tabela-funcionarios label').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();

        // Adiciona um placeholder no campo de pesquisa
        $('#filtro-tabela-funcionarios input').attr('placeholder', 'Pesquisar funcionário...');

    });
</script>

</div>
</body>

</html>
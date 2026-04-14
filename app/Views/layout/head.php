<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $titulo ?? 'Sistema'; ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">

    <style>
        /* Área superior da tabela: botão novo + busca */
        .area-superior-tabela {
            gap: 10px;
        }

        /* Remove margem padrão do campo de busca do DataTable */
        .dataTables_filter {
            margin-bottom: 0 !important;
        }

        /* Deixa o label do DataTable mais limpo */
        .dataTables_filter label {
            margin-bottom: 0;
            font-weight: normal;
        }

        /* Ajusta o input de pesquisa */
        .dataTables_filter input {
            margin-left: 8px !important;
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 4px 8px;
        }

        .area-superior-tabela {
            gap: 10px;
        }

        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 0 !important;
        }

        .dataTables_length label,
        .dataTables_filter label {
            margin-bottom: 0;
            font-weight: normal;
        }

        .dataTables_filter input {
            margin-left: 8px !important;
            border-radius: 4px;
            padding: 4px 8px;
        }

        /* Área superior da tabela */
        .area-superior-tabela {
            gap: 10px;
        }

        /* Remove margens ruins do DataTable */
        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 0 !important;
        }

        /* Ajusta labels do DataTable */
        .dataTables_length label,
        .dataTables_filter label {
            margin-bottom: 0;
            font-weight: normal;
        }

        /* Container da busca com ícone */
        .busca-com-icone {
            position: relative;
        }

        /* Adiciona a lupa antes do input */
        .busca-com-icone::before {
            content: "\f002";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        /* Ajusta o input da busca */
        .busca-com-icone input {
            padding-left: 30px !important;
            border-radius: 4px;
        }

        /* Remove margem lateral estranha do DataTable */
        .dataTables_filter input {
            margin-left: 0 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
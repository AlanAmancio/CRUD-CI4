<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo / Nome do sistema -->
    <a href="<?= base_url('/'); ?>" class="brand-link">
        <span class="brand-text font-weight-light ml-2">Cadastro RH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('/'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Cargos -->
                <li class="nav-item">
                    <a href="<?= base_url('cargos'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Cargos</p>
                    </a>
                </li>

                <!-- Funcionários -->
                <li class="nav-item">
                    <a href="<?= base_url('funcionarios'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Funcionários</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
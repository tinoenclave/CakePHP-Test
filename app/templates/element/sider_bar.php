<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/img/88872432.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BetaMind-Inc</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php $user = $this->request->getAttribute('identity') ?>
        <?php if ($user): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="javascript:;" class="d-block">
                        <?= $user->email ?>
                    </a>
                    <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => "d-block"]); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => "d-block"]); ?>
                    <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'add'], ['class' => "d-block"]); ?>
                </div>
            </div>
        <?php endif ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
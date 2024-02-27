<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <?= $this->Html->css([
        'plugins/fontawesome-free/css/all.min',
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min',
        'adminlte.min',
        'common',
    ]) ?>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => "nav-link"]); ?>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'index'], ['class' => "nav-link"]); ?>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php echo $this->element('sider_bar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->fetch('content') ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024.</strong> Coding Test - CakePHP.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <?= $this->Html->script([
        'plugins/jquery/jquery.min',
        'plugins/jquery-ui/jquery-ui.min',
        'plugins/moment/moment.min',
        'plugins/bootstrap/js/bootstrap.bundle.min',
        'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min',
        'adminlte.min'
    ]) ?>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
</body>

</html>
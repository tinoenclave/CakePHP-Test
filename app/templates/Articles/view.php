<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>&nbsp</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Article Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <div class="text-muted">
                            <p class="text-sm"><?= __('Id') ?>
                                    <b class="d-block"><?= h($article->id) ?></b>
                                </p>
                                <p class="text-sm"><?= __('Title') ?>
                                    <b class="d-block"><?= h($article->title) ?></b>
                                </p>
                                <p class="text-sm"><?= __('Body') ?>
                                    <b class="d-block"><?= h($article->body) ?></b>
                                </p>
                                <p class="text-sm"><?= __('Created At') ?>
                                    <b class="d-block"><?= h($article->created_at) ?></b>
                                </p>
                                <p class="text-sm"><?= __('Updated At') ?>
                                    <b class="d-block"><?= h($article->updated_at) ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?= $this->Html->link(__('Close'), ['action' => 'index'], ['class' => 'btn btn-block btn-success btn float-right', 'style' => 'width: 200px']) ?>
                    </div>
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
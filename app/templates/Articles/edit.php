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
                    <li class="breadcrumb-item active">Edit Article</li>
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
                        <h3 class="card-title">Edit Article</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= $this->Form->create($article, ['role' => "form"]) ?>
                        <div class="card-body">
                            <?php $flashRender = $this->Flash->render(); ?>
                            <?php if ($flashRender): ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    <?= $flashRender ?>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">(*)</span></label>
                                <?php echo $this->Form->control('title', ['label' => false, 'class' => 'form-control', 'required ' => true, 'id' => 'title']); ?>
                                <p class="text-muted">Note: (Title cannot be empty, the minimum length is 10, and the
                                    maximum is 255 characters)</p>
                            </div>
                            <div class="form-group">
                                <label for="body">Body <span class="text-danger">(*)</span></label>
                                <?= $this->Form->control('body', ['label' => false, 'class' => 'form-control', 'required ' => true, 'id' => 'body', 'type' => 'textarea', 'escape' => false]) ?>
                                <p class="text-muted">Note: (Body cannot be empty, the minimum length is 10)</p>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Article</button>
                            <?= $this->Html->link(__('Close'), ['action' => 'index'], ['class' => 'btn btn-block btn-success btn float-right', 'style' => 'width: 200px']) ?>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
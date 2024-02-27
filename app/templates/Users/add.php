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
                    <li class="breadcrumb-item active">Register</li>
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
                        <h3 class="card-title">Register</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="">
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
                                <label for="email">Email address <span class="text-danger">(*)</span></label>
                                <input type="email" name="email" required=true class="form-control" id="email"
                                    placeholder="Enter email">
                                <p class="text-muted">Note: (Email cannot be empty)</p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">(*)</span></label>
                                <input type="password" required=true name="password" class="form-control" id="password"
                                    placeholder="Password">
                                <p class="text-muted">Note: (Password cannot be empty, the minimum length is 5, and the maximum is 255 characters)</p>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Articles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Articles</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php $flashRender = $this->Flash->render(); ?>
                <?php $currentUser = $this->request->getAttribute('identity') ?>
                <?php if ($flashRender): ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        <?= $flashRender ?>
                    </div>
                <?php endif ?>
                <div class="card">
                    <?php if($this->request->getAttribute('identity')):?>
                        <div class="card-header">
                            <?= $this->Html->link(__('Add Article'), ['action' => 'add'], ['class' => 'btn btn-block btn-success btn float-right', 'style' => 'width: 200px']) ?>
                        </div>
                    <?php endif ?>
                    <?php $paginatorInformation = $this->Paginator->params(); ?>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        <?= $this->Paginator->sort('id') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('title') ?>
                                    </th>
                                    <th>By</th>
                                    <th>
                                        <?= $this->Paginator->sort('created_at') ?>
                                    </th>
                                    <th>
                                        <?= __('Actions') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($paginatorInformation['count'] > 0): ?>
                                    <?php foreach ($articles as $article): ?>
                                        <tr>
                                            <td>
                                                <?= $this->Number->format($article->id) ?>
                                            </td>
                                            <td>
                                                <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
                                            </td>
                                            <td>
                                                <?= h($article->user->email) ?>
                                            </td>
                                            <td>
                                                <?= h($article->created_at) ?>
                                            </td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                                                <?php if($this->request->getAttribute('identity')):?>
                                                    <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
                                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="6">Article List is Empty</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <?php if ($paginatorInformation['pageCount'] > 1): ?>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <?= $this->Paginator->first('<< ' . __('first')) ?>
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                                <?= $this->Paginator->last(__('last') . ' >>') ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
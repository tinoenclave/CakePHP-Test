<h1>Articles</h1>
<?php if($this->request->getAttribute('identity')):?>
<?= $this->Html->link('Add Article', ['action' => 'add']) ?>
<?php endif ?>
<table>
    <tr>
        <th>Title</th>
        <th>By</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td><?= h($article->user->email) ?></td>
        <td><?= h($article->created_at) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
            <?php if($this->request->getAttribute('identity')):?>
                <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>

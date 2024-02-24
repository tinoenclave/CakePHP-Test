<h1>Articles</h1>
<table>
    <tr>
        <th>Title</th>
        <th>By</th>
        <th>Created At</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
        </td>
        <td><?= $article->user->email ?></td>
        <td><?= $article->created_at->format(DATE_RFC850) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

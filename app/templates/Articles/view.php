<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created: <?= $article->created_at->format(DATE_RFC850) ?></small></p>
<?php if($this->request->getAttribute('identity')):?>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?></p>
<?php endif ?>
<?php
namespace App\Controller;

use Cake\View\JsonView;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find('all', ['contain' => ['Users']]));
        $this->set(compact('articles'));
        $this->viewBuilder()->setOption('serialize', 'articles');
    }
}
<?php
namespace App\Controller;

use Cake\View\JsonView;
use Exception;
use Cake\Http\Exception\NotFoundException;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }


    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 10
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
        $this->viewBuilder()->setOption('serialize', 'articles');
    }

    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Users'],
        ]);
        $this->set(compact('article'));
        $this->viewBuilder()->setOption('serialize', 'article');
    }

    public function add()
    {
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            return $this->redirect('/articles');
        }

        $article = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = $user->id;
            $result = $this->Articles->save($article);
            if ($this->request->isJson() || $this->request->accepts('application/json')) {
                $this->viewBuilder()->setOption('serialize', 'article');
            } else {
                if ($result) {
                    $this->Flash->success(__('Your article has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Unable to add your article.'));
                }
            }
        }

        $this->set('article', $article);
    }

    public function edit($id)
    {
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

        try {
            $user = $this->Authentication->getIdentity();

            if (!$user) {
                return $this->redirect('/articles');
            }

            $article = $this->Articles->get($id);

            if ($user->id !== $article->user_id) {
                return $this->redirect(['action' => 'index']);
            }

            if ($this->request->is(['post', 'put'])) {
                $this->Articles->patchEntity($article, $this->request->getData());
                $result = $this->Articles->save($article);

                if ($isRequestJson) {
                    $this->viewBuilder()->setOption('serialize', 'article');
                } else {
                    if ($result) {
                        $this->Flash->success(__('Your article has been updated.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Unable to update your article.'));
                    }
                }
            }

            $this->set('article', $article);
        } catch (Exception $e) {
            if (!$isRequestJson) {
                throw new NotFoundException(__('Article not found'));
            }
        }
    }

    public function delete($id)
    {
        $id = 58;
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

        try {
            $user = $this->Authentication->getIdentity();

            if (!$user) {
                return $this->redirect('/articles');
            }

            $article = $this->Articles->get($id);

            if ($user->id !== $article->user_id) {
                return $this->redirect(['action' => 'index']);
            }

            $this->request->allowMethod(['post', 'delete']);
            
            $result = $this->Articles->delete($article);

            if ($this->request->isJson() || $this->request->accepts('application/json')) {
                $article = [
                    'id' => $article->id,
                    'message' => __('The {0} article has been deleted.', $article->title),
                ];
                $this->viewBuilder()->setOption('serialize', 'article');
            } else {
                if ($result) {
                    $this->Flash->success(__('The {0} article has been deleted.', $article->title));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Unable to delete your article.'));
                }
            }

            $this->set('article', $article);
        } catch (Exception $e) {
            if (!$isRequestJson) {
                throw new NotFoundException(__('Unable to delete your article.'));
            }
        }
    }
}
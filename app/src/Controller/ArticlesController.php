<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\View\JsonView;
use Exception;
use Cake\Http\Exception\NotFoundException;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @property \App\Model\Table\LikesTable $Likes
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
        if ($this->request->is('get')) {
            $this->paginate = [
                'contain' => [
                    'Users' => [
                        'fields' => ['email']
                    ],
                    'Likes' => function($query){
                        return $query->select(['Likes.article_id', 'like_count' => $query->func()->count('Likes.article_id')])
                        ->group(['Likes.article_id']);
                    }
                ],
                'limit' => $this->page
            ];

            $articles = $this->paginate($this->Articles);
            $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

            if ($isRequestJson) {
                $result = [
                    "status" => "success",
                    "data" => $articles,
                    "message" => "List of articles"
                ];
                $articles = $result;
                $this->viewBuilder()->setOption('serialize', 'articles');
            }

            $this->set(compact('articles'));
        }
    }

    public function view($id = null)
    {
        if ($this->request->is('get')) {
            $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

            $article = $this->Articles->get($id, [
                'contain' => [
                    'Users' => [
                        'fields' => ['email']
                    ],
                    'Likes' => function($query){
                        return $query->select(['Likes.article_id', 'like_count' => $query->func()->count('Likes.article_id')])
                        ->group(['Likes.article_id']);
                    }
                ],
            ]);

            if ($isRequestJson) {
                $result = [
                    "status" => "success",
                    "data" => $article,
                    "message" => "Article detail #{$id}"
                ];

                $article = $result;

                $this->viewBuilder()->setOption('serialize', 'article');
            }

            $this->set(compact('article'));
        }
    }

    public function add()
    {
        $user = $this->Authentication->getIdentity();
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

        if (!$user) {
            if(!$isRequestJson) {
                return $this->redirect('/articles');
            }
        } else {
            $article = $this->Articles->newEmptyEntity();

            if ($this->request->is('post')) {
                $article = $this->Articles->patchEntity($article, $this->request->getData());
                $article->user_id = $user->id;
                $saveArticleResult = $this->Articles->save($article);

                if ($isRequestJson) {
                    if($saveArticleResult) {
                        $result = [
                            "status" => "success",
                            "data" => $article,
                            "message" => "Your article has been saved."
                        ];
                    } else {
                        $result = [
                            "status" => "error",
                            "data" => $article,
                            "message" => "Unable to add your article."
                        ];
                    }

                    $article = $result;
                    $this->viewBuilder()->setOption('serialize', 'article');
                } else {
                    if ($saveArticleResult) {
                        $this->Flash->success(__('Your article has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Unable to add your article.'));
                    }
                }
            }

            $this->set('article', $article);
        }
    }

    public function edit($id)
    {
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

        try {
            $user = $this->Authentication->getIdentity();

            if (!$user) {
                if(!$isRequestJson) {
                    return $this->redirect('/articles');
                }
            } 

            $article = $this->Articles->get($id);

            if ($user->id !== $article->user_id) {
                if (!$isRequestJson) {
                    return $this->redirect(['action' => 'index']);
                }
            }

            if ($this->request->is(['post', 'put'])) {
                $this->Articles->patchEntity($article, $this->request->getData());

                if ($isRequestJson) {
                    if ($user->id !== $article->user_id) {
                        $result = [
                            "status" => "error",
                            "data" => null,
                            "message" => "Unable to update your article."
                        ];

                        $article = $result;
                    } else{
                        $saveArticleResult = $this->Articles->save($article);

                        if($saveArticleResult) {
                            $result = [
                                "status" => "success",
                                "data" => $article,
                                "message" => "Your article has been updated."
                            ];
                        } else {
                            $result = [
                                "status" => "error",
                                "data" => $this->request->getData(),
                                "message" => "Unable to update your article."
                            ];
                        }

                        $article = $result;
                    }

                    $this->viewBuilder()->setOption('serialize', 'article');
                } else {
                    $saveArticleResult = $this->Articles->save($article);

                    if ($saveArticleResult) {
                        $this->Flash->success(__('Your article has been updated.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Unable to update your article.'));
                    }
                }
            }

            $this->set('article', $article);
        } catch (Exception $e) {
            throw new NotFoundException(__('Unable to update your article.'));
        }
    }

    public function delete($id)
    {
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
        
        try {
            $user = $this->Authentication->getIdentity();

            if (!$user) {
                if(!$isRequestJson) {
                    return $this->redirect('/articles');
                }
            }

            $article = $this->Articles->get($id);

            if ($user->id !== $article->user_id) {
                if(!$isRequestJson) {
                    return $this->redirect('/articles');    
                }
            }

            $this->request->allowMethod(['post', 'delete']);

            if ($isRequestJson) {
                if ($user->id !== $article->user_id) {
                    $result = [
                        "status" => "error",
                        "data" => null,
                        "message" => "Unable to delete your article."
                    ];

                    $article = $result;      
                } else {
                    $deleteArticleResult = $this->Articles->delete($article);

                    if($deleteArticleResult) {
                        $result = [
                            "status" => "success",
                            "data" => $article,
                            "message" => __('The {0} article has been deleted.', $article->title)
                        ];
                    } else {
                        $result = [
                            "status" => "error",
                            "data" => null,
                            "message" => __('Unable to delete your article.')
                        ];
                    }

                    $article = $result;
                }

                $this->viewBuilder()->setOption('serialize', 'article');
            } else {
                $deleteArticleResult = $this->Articles->delete($article);

                if ($deleteArticleResult) {
                    $this->Flash->success(__('The {0} article has been deleted.', $article->title));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Unable to delete your article.'));
                }
            }

            $this->set('article', $article);
        } catch (Exception $e) {
            throw new NotFoundException(__('Unable to delete your article.'));
        }
    }

    public function like($articleId = null) {
        try {
            $this->request->allowMethod(['post', 'get']);
            $user = $this->Authentication->getIdentity();

            $queryLike = $this->Articles->Likes->find('all')->where([
                'user_id' => $user->id,
                'article_id' => $articleId
            ])->first();

            if($queryLike) {
                $result = [
                    "status" => "error",
                    "data" => [
                        'user_id' => $user->id,
                        'article_id' => $articleId
                    ],
                    "message" => "You liked the article."
                ];
            } else {
                $likeArticle = $this->Articles->Likes->newEmptyEntity();
                $likeArticle->user_id = $user->id;
                $likeArticle->article_id = $articleId;
                $likeResult = $this->Articles->Likes->save($likeArticle);

                if($likeResult) {
                    $result = [
                        "status" => "success",
                        "data" => $likeArticle,
                        "message" => "You liked article #{$articleId}."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "data" => $likeArticle,
                        "message" => "Unable to like article #{$articleId}."
                    ];
                }
            }
            
            $this->viewBuilder()->setOption('serialize', 'result');
            $this->set('result', $result);
        } catch (Exception $e) {
            throw new NotFoundException(__('Unable to like your article.'));
        }
    }
}

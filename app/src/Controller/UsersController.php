<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;

        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $userIdentity = $this->Authentication->getIdentity();
            if($isRequestJson) {
                $user = $userIdentity->getOriginalData();
                $user->token = $this->generateToken();
                $user = $this->Users->save($user);
                $user = $this->Users->get($user->id);
                $this->viewBuilder()->setOption('serialize', ['user']);
                $this->set(compact('user'));
            } else {
                // redirect to /articles after login success
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Articles',
                    'action' => 'index',
                ]);

                return $this->redirect($redirect);
            }
        } else {
            if($isRequestJson) {
                $result = [
                    "status" => "error",
                    "data" => null,
                    "message" => "User not found."
                ];

                $user = $result;
                $this->viewBuilder()->setOption('serialize', 'user');
                $this->set(compact('user'));
            }
        }
    }

    private function generateToken(int $length = 36, string $expiration = '+6 hours')
    {
        $random = base64_encode(Security::randomBytes($length));
        $cleaned = preg_replace('/[^A-Za-z0-9]/', '', $random);
        return $cleaned;
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Authentication->getIdentity();
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
        
        if(!$user) {
            if(!$isRequestJson) {
                return $this->redirect('/users/login');
            } else {
                $result = [
                    "status" => "error",
                    "data" => null,
                    "message" => "User not authenticated"
                ];
                $users = $result;
                $this->viewBuilder()->setOption('serialize', 'users');
            }
        } else {
            $this->paginate = [
                'limit' => 10
            ];
    
            $users = $this->paginate($this->Users);
    
            if($isRequestJson) {
                $result = [
                    "status" => "success",
                    "data" => $users,
                    "message" => "List of Users"
                ];
                $users = $result;
                $this->viewBuilder()->setOption('serialize', 'users');
            } else {
    
            }
        }

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles'],
        ]);

        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
        
        if($isRequestJson) {
            $result = [
                "status" => "success",
                "data" => $user,
                "message" => "User detail #{$id}"
            ];

            $user = $result;
            $this->viewBuilder()->setOption('serialize', 'user');
        }

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
            $saveUserResult = $this->Users->save($user);

            if($isRequestJson) {
                if($saveUserResult) {
                    $result = [
                        "status" => "success",
                        "data" => $user,
                        "message" => "The user has been saved."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "data" => $user,
                        "message" => "The user could not be saved. Please, try again."
                    ];
                }
                
                $user = $result;
                $this->viewBuilder()->setOption('serialize', 'user');
            } else {
                if($saveUserResult) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Authentication->getIdentity();
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $saveUserResult = $this->Users->save($user);

            if($isRequestJson) {
                if($saveUserResult) {
                    $result = [
                        "status" => "success",
                        "data" => $user,
                        "message" => "The user has been saved."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "data" => $user,
                        "message" => "The user could not be saved. Please, try again."
                    ];
                }
                
                $user = $result;
                $this->viewBuilder()->setOption('serialize', 'user');
            } else {
                if($saveUserResult) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
        $user = $this->Users->get($id);
        $saveUserResult = $this->Users->delete($user);

        if($isRequestJson) {
            if($saveUserResult) {
                $result = [
                    "status" => "success",
                    "data" => $user,
                    "message" => "The user has been deleted."
                ];
            } else {
                $result = [
                    "status" => "error",
                    "data" => $user,
                    "message" => "The user could not be deleted. Please, try again."
                ];
            }

            $user = $result;
            $this->viewBuilder()->setOption('serialize', 'user');
        } else {
            if($saveUserResult) {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        }

        $this->set(compact('user'));
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $isRequestJson = $this->request->isJson() || $this->request->accepts('application/json') ? true : false;
            $userIdentity = $this->Authentication->getIdentity();
            $user = $userIdentity->getOriginalData();
            $user->token = "";
            $user = $this->Users->save($user);

            if($isRequestJson) {
                $this->set(compact('user'));
                $this->viewBuilder()->setOption('serialize', ['user']);
                $this->Authentication->logout();
            } else {
                $this->Authentication->logout();
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }
    }
}

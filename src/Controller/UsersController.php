<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Guilds']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
        
        if (!$this->Auth->user()) {
            return $this->redirect(['action' => 'login']);
        }
        else { $this->direct(); }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Guilds', 'Attendances']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Users->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('user', 'guilds'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Users->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('user', 'guilds'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

		public function login()
		{
				if ($this->request->is('post')) {
				    $user = $this->Auth->identify();
				    if ($user) {
				        $this->Auth->setUser($user);
                        $this->Flash->success(__('Sisäänkirjautuminen onnistui'));
				        return $this->redirect($this->Auth->redirectUrl());
				    }
				    $this->Flash->error(__('Väärä käyttäjätunnus tai salasana, yritä uudelleen'));
				}
		}

		public function logout()
		{
				return $this->redirect($this->Auth->logout());
		}
        
        public function direct() {
            if ($this->Auth->user('role') == 'admin') {
                return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
            }
            else {
                return $this->redirect(['controller' => 'Events', 'action' => 'index']);
            }
        }
        
        public function me() {
            
        }
}

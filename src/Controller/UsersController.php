<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

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
    
    public function beforeFilter(Event $event) {
        if ($this->request->action == 'login' || $this->request->action == 'logout'|| $this->request->action == 'index' || $this->request->action == 'settings') {
            $this->Auth->Allow();
        }
        if (parent::isAdmin()) {
            $this->Auth->Allow();
        }
    }
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Guilds']
        ];
        $guild_id=$this->Auth->user('guild_id');
        $users = TableRegistry::get('Users');
		$users_query= $users->find('all');
		$general=1;
		$allowed_users=array();
		$data=$users_query->toArray();
		if($this->Auth->user('TF') ==1){
			foreach($data as $allowed_user){
				if($allowed_user->TF == 1){
					array_push($allowed_users, $allowed_user);
				}
			}	
		}else{
			foreach($data as $allowed_user){
				if($allowed_user->guild_id == $guild_id || $this->Auth->user('guild_id') == $general){
					array_push($allowed_users, $allowed_user);
				}
			}
		}
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
        $this->set('allowed_users', $allowed_users);
        
        if (!$this->Auth->user()) {
            return $this->redirect(['action' => 'login']);
        }
        //else { $this->direct(); }
        else if ($this->Auth->user('role') != 'admin') {
            return $this->redirect(['controller' => 'Events', 'action' => 'index']);
        }
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
        $guilds = $this->Users->Guilds->find('list', ['limit' => 15]);
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

    public function login()  {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Sisäänkirjautuminen onnistui'));
                //return $this->redirect($this->Auth->redirectUrl());
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Väärä käyttäjätunnus tai salasana, yritä uudelleen'));
        }
    }

    public function logout() {
        // return $this->redirect($this->Auth->logout());
        $this->Auth->logout();
        $this->redirect(['action' => 'login']);
    }
        
    public function direct() {
        if (!$this->Auth->user('role') == 'admin') {
            return $this->redirect(['controller' => 'Events', 'action' => 'index']);
        }
    }
    
    public function settings() {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is('post')) {
            $pw = $this->request->data('new-password');
            if ($this->Auth->identify() && $pw == $this->request->data('new-password2') && strlen($pw) > 5 && strlen($pw) < 21) {
                $user->set('password', $pw);            //_setPassword($this->request->data('new-password'));  //('password', $this->request->data('new-password'));
                $this->Users->save($user);
                $this->Flash->success(__('Salasana vaihdettu'));
            }
            else {
                $this->Flash->error(__('Salasanan vaihto ei onnistunut. Yritä uudestaan'));            
            }
        }
    }
    
    
    
    /*public function isAuthorized($user) {
        
        if ($this->request->action == 'login' || $this->request->action == 'logout') {
            return true;
        }
        else {
            return parent::isAuthorized($user);
        }
        /*switch ($this->request->action) {
            case 'login':
            case 'logout':
                return true;
            case 'settings':
                return isset($user) ? true : false;
            default:
                return isset($user['role']) && $user['role'] == 'admin' ? true: false;
        }
        /*
        if (in_array($this->request->action, ['login', 'logout'])) {
            return true;
        }
        
        else if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        else { return false; }
        
    }*/
}

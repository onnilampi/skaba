<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Guilds Controller
 *
 * @property \App\Model\Table\GuildsTable $Guilds
 */
class GuildsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('guilds', $this->paginate($this->Guilds));
        $this->set('_serialize', ['guilds']);
    }

    /**
     * View method
     *
     * @param string|null $id Guild id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guild = $this->Guilds->get($id, [
            'contain' => ['Events', 'Users']
        ]);
        $this->set('guild', $guild);
        $this->set('_serialize', ['guild']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guild = $this->Guilds->newEntity();
        if ($this->request->is('post')) {
            $guild = $this->Guilds->patchEntity($guild, $this->request->data);
            if ($this->Guilds->save($guild)) {
                $this->Flash->success(__('The guild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guild could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('guild'));
        $this->set('_serialize', ['guild']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Guild id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guild = $this->Guilds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guild = $this->Guilds->patchEntity($guild, $this->request->data);
            if ($this->Guilds->save($guild)) {
                $this->Flash->success(__('The guild has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guild could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('guild'));
        $this->set('_serialize', ['guild']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Guild id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guild = $this->Guilds->get($id);
        if ($this->Guilds->delete($guild)) {
            $this->Flash->success(__('The guild has been deleted.'));
        } else {
            $this->Flash->error(__('The guild could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function me() {
        $this->paginate = [ 
			'contain' => ['Attendances', 'Users']
		];
		$user_id = $this->Auth->user('id');
		$guild = $this->Auth->user('guild_id');	
		$query = $this->Guilds->Users->find('all')
			->where(['guild_id =' => $guild]);
		$data = $query->toArray();
		$results = array();
		$points = array();
		$query = ClassRegistry::init('Attendances')->find('all');
		$attendance_data= $query->toArray();
		foreach ($data as $users) {
			array_push($results, $this->Guilds->Users->get($users->id));
			$attendances = 
			
		}
			/*
		$connection = ConnectionManager::get('default');
		$result = $connection->query('SELECT * FROM Events WHERE id = (SELECT event_id FROM Attendances WHERE user_id = ' . $user_id . ')');
			*/
		$this->set('results', $results);
		$this->set('points', $points);
    }
    
    public function all() {
        
    }
}

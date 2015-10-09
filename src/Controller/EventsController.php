<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Attendance;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
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
        $guild_id=$this->Auth->user('guild_id');
        $general = 1;
        $tf = 14;
        if($this->Auth->user('TF') == 1){
			$query = $this->Events->find('all')
			->where(['guild_id' => $tf])
			->orWhere(['guild_id' => $guild_id])
			->orWhere(['guild_id' => $general]);
		}else if($this->Auth->user('guild_id') == $general){
			$query = $this->Events->find('all');
		}else{
			$query = $this->Events->find('all')
			->where(['guild_id' => $guild_id])
			->orWhere(['guild_id' => $general]);
		}
        $this->set('events', $this->paginate($query));
        $this->set('_serialize', ['events']);
        if (!$this->Auth->user('role') == 'admin') {
            return $this->redirect(['action' => 'attend']);
        }
    }
    
    public function beforeFilter(Event $event) {
        if ($this->request->action == 'attend') {
            $this->Auth->Allow();
        }
        else if (!parent::isAdmin()) {
            $this->redirect(['action' => 'attend']);
        }
    }    

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        $event = $this->Events->get($id, [
            'contain' => ['Guilds', 'Attendances']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Events->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('event', 'guilds'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $guilds = $this->Events->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('event', 'guilds'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    
    public function attend(){
         $this->paginate = [
            'contain' => ['Guilds']
        ];
        $att = TableRegistry::get('Attendances');
        $user_id = $this->Auth->user('id');	
        $query = $att->find('all')
			->where(['user_id =' => $user_id])
			->distinct(['event_id']);
		$att_array = array();
		$att_array = $query->toArray();
		$attended_events = array();
		foreach($att_array as $attended_event){
			array_push($attended_events, intval($attended_event->event_id));
		}
		//var_dump($attended_events);
		$guild = $this->Auth->user('guild_id');
		$general = 1;
		$tf = 14;
		if($this->Auth->user('TF')==1)
		{
			$query = $this->Events->find('all')
				->where(['guild_id =' => $guild])
				->orWhere(['guild_id =' => $general])
				->orWhere(['guild_id =' => $tf]);
		}else{
			$query = $this->Events->find('all')
				->where(['guild_id =' => $guild])
				->orWhere(['guild_id =' => $general]);
		}
        $data = $query->toArray();
        $results = array();
        foreach ($data as $event) {
            array_push($results, $this->Events->get($event->id));
        }
		$this->set('results', $results);
		$this->set('attended_events', $attended_events); 
        /*
        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']); 
        
        if ($this->request->is('post')) {
            $new_attendance = new Attendance([
                event_id =
            ]);
        */
    }
}

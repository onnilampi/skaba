<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 */
class AttendancesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    
    public function beforeFilter(Event $event) {
        if ($this->request->action == 'me') {
            $this->Auth->Allow();
        }
        else if (!parent::isAdmin()) {
            $this->redirect(['action' => 'me']);
        }
    }    
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users']
        ];
        $this->set('attendances', $this->paginate($this->Attendances));
        $this->set('_serialize', ['attendances']);
    }

    /**
     * View method
     *
     * @param string|null $id Attendance id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => ['Events', 'Users']
        ]);
        $this->set('attendance', $attendance);
        $this->set('_serialize', ['attendance']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /* $attendance = $this->Attendances->newEntity();
        $attendance->set([
            'user_id' => $this->Auth->user('id'),
            'created' => new DateTime('now')
        ]); */
        if ($this->request->is('post')) {
            // $attendance = $this->Attendances->patchEntity($attendance, $this->request->data);
            $attendance = $this->Attendances->newEntity();
            $attendance->set([
                'user_id' => $this->Auth->user('id'),
                'created' => new \DateTime($now),
                'event_id' => $this->request->data('event-id')
            ]);
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));
                return $this->redirect(['controller' => 'events', 'action' => 'attend']);
            } else {
                $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
            }
        }
        /* $events = $this->Attendances->Events->find('list', ['limit' => 200]);
        $users = $this->Attendances->Users->find('list', ['limit' => 200]);
        $this->set(compact('attendance', 'events', 'users'));
        $this->set('_serialize', ['attendance']); */ 
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->data);
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
            }
        }
        $events = $this->Attendances->Events->find('list', ['limit' => 200]);
        $users = $this->Attendances->Users->find('list', ['limit' => 200]);
        $this->set(compact('attendance', 'events', 'users'));
        $this->set('_serialize', ['attendance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get($id);
        if ($this->Attendances->delete($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function verify($id=null){
		//if($id!=null){
		$this->request->allowMethod('post');
		$attendance = $this->Attendances->get($id);
		
		$attendance->set('verified', new \DateTime($now));
		if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been verified.'));
                //return $this->redirect(['controller' => 'attendances', 'action' => 'verify']);
        } else {
                $this->Flash->error(__('The attendance could not be verified. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
	}
	
	public function unverify($id=null){
		//if($id!=null){
		$this->request->allowMethod('post');
		$attendance = $this->Attendances->get($id);
		
		$attendance->set('verified', null);
		if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been unverified.'));
                //return $this->redirect(['controller' => 'attendances', 'action' => 'verify']);
        } else {
                $this->Flash->error(__('The attendance could not be unverified. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
	}

    public function me() 
    {
	$this->paginate = [ 
		'contain' => ['Events']
	];
	$user_id = $this->Auth->user('id');	
        $query = $this->Attendances->find('all')->where(['user_id =' => $user_id]);
        $data = $query->toArray();
        $results = array();
        foreach ($data as $event) {
            array_push($results, $this->Attendances->Events->get($event->event_id));
        }
        /*
	$connection = ConnectionManager::get('default');
	$result = $connection->query('SELECT * FROM Events WHERE id = (SELECT event_id FROM Attendances WHERE user_id = ' . $user_id . ')');
        */
	$this->set('results', $results);
        

    }
    
    public function count_points($id=null){
	$this->paginate = [ 
		'contain' => ['Events']
	];
	$user_id = $this->Auth->user('id');
	$query = $this->Attendances->find('all')
		->where(['user_id =' => $user_id]);
	$data = $query->toArray();
	$points=array();
	foreach ($data as $point) {
		$points=$points+$this->Attendances->Events->get($event->event_id);
	}
	return $points;
	
	}
}


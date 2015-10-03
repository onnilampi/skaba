<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

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
        $guild_id=$this->Auth->user('guild_id');
        $general = 1;
        $events = TableRegistry::get('Events');
		$events_query= $events->find('all');
		$users = TableRegistry::get('Users');
		$users_query= $users->find('all');
		$allowed_users=array();
		$data=$users_query->toArray();
		if($this->Auth->user('TF') == 1){
			$query = $this->Attendances->find('all')->where(['Users.TF' => 1]);
			/*foreach($data as $allowed_user){
				if($allowed_user->TF == 1){
					array_push($allowed_users, $allowed_user);
				}
			}*/
		}else if($this->Auth->user('guild_id') == $general){
			$query = $this->Attendances->find('all');
		
		}else{
			$query = $this->Attendances->find('all')->where(['Users.guild_id' => $guild_id]);
			/*foreach($data as $allowed_user){
				if($allowed_user->guild_id == $guild_id || $this->Auth->user('guild_id') == $general){
					array_push($allowed_users, $allowed_user);
				}
			}*/
		}
        $this->set('attendances', $this->paginate($query));
        $this->set('_serialize', ['attendances']);
        $this->set('users', $users);
        $this->set('events', $events);
        $this->set('allowed_users', $allowed_users);
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
        if ($this->request->is('post')) {
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
        $query = $this->Attendances->find('all')
			->where(['user_id =' => $user_id])
			->where(['verified IS NOT' => 'NULL']);
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
    
    public function count_points($id){
	$this->paginate = [ 
		'contain' => ['Events']
	];
	$attendances = TableRegistry::get('Attendances');
	$query = $attendances->find()
		->select(['event_id', 'user_id']);
	$data = $query->toArray();
	$points=0;
	foreach ($data as $point) {
		//$points=$points+$this->Attendances->Events->get($event->event_id);
	}
	return $points;
	
	}
}


<?php
namespace App\Controller;
use Cake\ORM\Table;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
            $this->Flash->success(cakephp__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
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
}


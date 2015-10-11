<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
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
    
    public function beforeFilter(Event $event) {
        if ($this->request->action == 'me' || $this->request->action == 'all') {
            $this->Auth->Allow();
        }
        else if (!parent::isAdmin()) {
            $this->redirect(['action' => 'me']);
        }
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
		$general = 1;
		$TF = 14;
		$guild = $this->Auth->user('guild_id');	
		$query = $this->Guilds->Users->find('all')
			->where(['guild_id =' => $guild])
			->order(['realName' => 'DESC']);
		$data = $query->toArray();
		$attendances = TableRegistry::get('Attendances');
		$events = TableRegistry::get('Events');
		
		//Al points
		$events_query= $events->find('all')->where(['guild_id' => $general]);
		$results = array();
		$points = array();
		foreach ($data as $users) {
			$points_user_guild=0;
			$points_user_general=0;
			array_push($results, $this->Guilds->Users->get($users->id));
			$attendances_query= $attendances->find()->where(['user_id =' => $users->id])->where(['verified IS NOT' => 'NULL']);
			$size = $attendances->find()->where(['user_id =' => $users->id])->count();
			if($size != 0){
				$att_data=$attendances_query->toArray();
				foreach($att_data as $att){
					$ev_data = $events_query->toArray();
					foreach($ev_data as $ev){
						if($ev->id == $att->event_id){
							$points_user_guild=$points_user_guild+ $ev->points;
						}
					}
				}
			}array_push($points, $points_user_guild);	
		}
		
		//Guild's points
		$events_query= $events->find('all')->where(['guild_id' => $guild]);
		$results_g = array();
		$points_g = array();
		$guils_event_ids = array();
		foreach ($data as $users) {
			$points_user_guild_g=0;
			array_push($results_g, $this->Guilds->Users->get($users->id));
			$attendances_query= $attendances->find()->where(['user_id =' => $users->id])->where(['verified IS NOT' => 'NULL']);
			$size = $attendances->find()->where(['user_id =' => $users->id])->count();
			if($size != 0){
				$att_data=$attendances_query->toArray();
				foreach($att_data as $att){
					$ev_data = $events_query->toArray();
					foreach($ev_data as $ev){
						if($ev->id == $att->event_id){
							$points_user_guild_g=$points_user_guild_g + $ev->points;
						}
					}
				}
			}array_push($points_g, $points_user_guild_g);	
		}
		
		//General points
		
		/*if($this->Auth->user('TF')){
			//TF points
			echo "penis";
			$query = $this->Guilds->Users->find('all')
				->where(['guild_id =' => $TF])
				->order(['realName' => 'DESC']);
			$data = $query->toArray();
			$events_query= $events->find('all')->where(['guild_id' => $TF]);
			$results_tf = array();
			$points_tf = array();
			$guils_event_ids = array();
			//foreach($events_query as $event)
			foreach ($data as $users) {
				$points_user_guild_g=0;
				array_push($results_tf, $this->Guilds->Users->get($users->id));
				$attendances_query= $attendances->find()->where(['user_id =' => $users->id])->where(['verified IS NOT' => 'NULL']);
				$size = $attendances->find()->where(['user_id =' => $users->id])->count();
				if($size != 0){
					$att_data=$attendances_query->toArray();
					foreach($att_data as $att){
						$ev_data = $events_query->toArray();
						var_dump($ev_data);
						foreach($ev_data as $ev){
							echo $ev->title;
							if($ev->id == $att->event_id){
								$points_user_guild_g=$points_user_guild_g + $ev->points;
							}
						}
					}
				}array_push($points_tf, $points_user_guild_g);	
			}
			$this->set('taffa', $this->Auth->user('TF'));
			$this->set('results_tf', $results_tf);
			$this->set('points_tf', $points_tf);
			echo $this->Auth->user('TF');
		}*/
		$this->set('results', $results);
		$this->set('points', $points);
		$this->set('results_g', $results_g);
		$this->set('points_g', $points_g);
    }
    
    public function all() {
        
    }
}

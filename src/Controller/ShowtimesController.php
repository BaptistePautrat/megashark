<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;


/**
 * Showtimes Controller
 *
 *
 * @method \App\Model\Entity\Showtime[] paginate($object = null, array $settings = [])
 */
class ShowtimesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // a tester
        $showtimes = $this-> paginate = [
         'contain' => ['Movies','Rooms']
        ];
        
    
    $showtimes = $this->paginate($this->Showtimes);
        $this->set(compact('showtimes'));
        $this->set('_serialize', ['showtimes']);
        //$this->set('showtimes', $this->paginate($this->Showtimes));
        
        
        /*
        $showtimes = $this->paginate($this->Showtimes);

        $this->set(compact('showtimes'));
        $this->set('_serialize', ['showtimes']);
        */
    }

    /**
     * View method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $showtime = $this->Showtimes->get($id, [
            'contain' => []
        ]);

        $this->set('showtime', $showtime);
        $this->set('_serialize', ['showtime']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   //Ici modifie
        $rooms = $this->Showtimes->Rooms->find('list');
        $movies =$this->Showtimes->Movies->find('list');
        $showtime = $this->Showtimes->newEntity();
        if ($this->request->is('post')) { 
            $showtime = $this->Showtimes->patchEntity($showtime, $this->request->getData());
            if ($this->Showtimes->save($showtime)) {
                $this->Flash->success(__('The showtime has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The showtime could not be saved. Please, try again.'));
        }
        //showtimes
          $movies = $this->Showtimes->Movies->find('list', ['limit' => 200]);
        $rooms = $this->Showtimes->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('rooms', 'showtime','movies'));
        $this->set('_serialize', ['rooms']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $showtime = $this->Showtimes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $showtime = $this->Showtimes->patchEntity($showtime, $this->request->getData());
            if ($this->Showtimes->save($showtime)) {
                $this->Flash->success(__('The showtime has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The showtime could not be saved. Please, try again.'));
        }
        $movies = $this->Showtimes->Movies->find('list', ['limit' => 200]);
        $rooms = $this->Showtimes->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('showtime'));
        $this->set('_serialize', ['showtime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $showtime = $this->Showtimes->get($id);
        if ($this->Showtimes->delete($showtime)) {
            $this->Flash->success(__('The showtime has been deleted.'));
        } else {
            $this->Flash->error(__('The showtime could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function planning()
    {
        $planning = $this->Showtimes->newEntity();
       $rooms = $this->Showtimes->Rooms->find('list', ['limit' => 200]);
       
       $this->set('rooms', $rooms);
       $this->set('planning', $planning);
      
        $time= new Time('monday this week ');
        $timeEnd = new Time();
        $timeEnd->modify('monday next week ');
        $showtimess =$this->Showtimes->find()
            ->where(['room_name' => $rooms, 'start >' => $time, 'start <' =>$timeEnd])
            ->contain(['Rooms','Movies']);
            
        $movies = array();   
        foreach ($showtimess as $showtime){
            if($showtime->start->format('N') == 0)
                $movies[6][] = $showtime;
            else
                $movies[$showtime->start->format('N')-1][] = $showtime;
        }
       // $this->set('showtimes', $showtimess);
       
           $this->set('room', $room);
        $this->set('_serialize', ['room']);  
        
       
        $this->set('showtimes',$movies);
        $this->set('room', $room);
        $this->set('_serialize', ['room']);
    
    }
}

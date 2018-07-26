<?php
namespace App\Controller\Admin;  

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class StoresController extends AppController
{

    	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
             $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }

        }

        $this->Auth->allow(['slugify','LatLongFromAddress','locations','locationadd']); 

        $this->authcontent(); 

    }  
    
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
         $this->paginate = [
            'contain' => ['Categories'],
            'order'=>['Stores.id'=>'desc']
        ];
        $stores = $this->paginate($this->Stores);  

        $this->set(compact('stores'));
        $this->set('_serialize', ['stores']);
    }
    
    
      public function locations($store_id = null)
    {
        $this->loadModel('Storelocations');
         $this->paginate = [
            'contain' => [],
            'conditions'=>['Storelocations.store_id'=>$store_id],
            'order'=>['Storelocations.id'=>'desc']
        ];
        $storelocations = $this->paginate($this->Storelocations);  

        $this->set(compact('storelocations','store_id'));
        $this->set('_serialize', ['storelocations']);
    }
    

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('store', $store);
        $this->set('_serialize', ['store']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
     private function slugify($str) { 
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     }
    public function add() 
    {
        
     
        $store = $this->Stores->newEntity();
        if ($this->request->is('post')) { 
         $image = $this->request->data['image'];
 
	    $name = time().$image['name'];
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/stores/'.$name;
		move_uploaded_file($tmp_name, $upload_path);  
            $this->request->data['image'] = $name;
   
            $store = $this->Stores->patchEntity($store, $this->request->getData());
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The store could not be saved. Please, try again.'));
        }
        $categories = $this->Stores->Categories->find('list', ['limit' => 200]);
        $this->set(compact('store','categories'));      
        $this->set('_serialize', ['store']);
    }
    
      public function locationadd($store_id = null) 
    {
        $this->loadModel('Storelocations');
     
        $storelocation = $this->Storelocations->newEntity();
        if ($this->request->is('post')) { 
            $this->request->data['store_id'] = $store_id;
            
            $storelocation = $this->Storelocations->patchEntity($storelocation, $this->request->getData());
            if ($this->Storelocations->save($storelocation)) {
                $this->Flash->success(__('The store location has been saved.'));

                return $this->redirect(['action' => 'locations/'.$store_id]);
            }
            $this->Flash->error(__('The store location could not be saved. Please, try again.'));
        }
        
        $this->set(compact('storelocation'));      
        $this->set('_serialize', ['storelocation']);
    }
    
    

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
               $post = $this->request->data;

			if($this->request->data['image']['name'] != ''){ 
					
			 	
			 
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/stores/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				 
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}
            
            
            $store = $this->Stores->patchEntity($store, $post);
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The store could not be saved. Please, try again.'));
        }
       $categories = $this->Stores->Categories->find('list', ['limit' => 200]);
        $this->set(compact('store','categories'));
        $this->set('_serialize', ['store']);
    }


    public function locationedit($id = null)
    {
        $this->loadModel('Storelocations');
        $storelocation = $this->Storelocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
               $post = $this->request->data;

            $storelocation = $this->Storelocations->patchEntity($storelocation, $post);
            if ($this->Storelocations->save($storelocation)) {
                $this->Flash->success(__('The store location has been saved.'));

                return $this->redirect(['action' => 'locations/'.$storelocation->store_id]);
            }
            $this->Flash->error(__('The store location could not be saved. Please, try again.'));
        }
      
        $this->set(compact('storelocation'));
        $this->set('_serialize', ['storelocation']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Stores->get($id);
        if ($this->Stores->delete($store)) {
            $this->Flash->success(__('The store has been deleted.'));
        } else {
            $this->Flash->error(__('The store could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

       public function locationdelete($locationid = null,$storeid = null)
    {
    
        $this->loadModel('Storelocations');
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Storelocations->get($locationid);
        if ($this->Storelocations->delete($store)) {
            $this->Flash->success(__('The locations has been deleted.'));
        } else {
            $this->Flash->error(__('The locations could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'locations/'.$storeid]);
    }

    public function LatLongFromAddress() {
        $complete_address= $_POST['address'];
        if (!empty($complete_address)) {
            $format_address = str_replace(' ', '+', $complete_address);
            $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $format_address . '&sensor=true', false);
            $output = json_decode($geocodeFromAddr);
            if (!empty($output)) {
                //$data['output']=$output;
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }else{
                $data['latitude'] = 0;
                $data['longitude'] = 0;
            }
          
        }
       echo  json_encode($data);
        exit; 
    }


}

<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Charities Controller
 *
 * @property \App\Model\Table\CharitiesTable $Charities
 *
 * @method \App\Model\Entity\Charities[] paginate($object = null, array $settings = [])
 */
class CharitiesController extends AppController
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

        $this->Auth->allow(['slugify']); 

        $this->authcontent();

    } 
    
    
    
     private function slugify($str) {  
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     } 
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [],
            'order'=>['Charities.id' =>'desc']
        ];
        $Charities = $this->paginate($this->Charities);

        $this->set(compact('Charities'));
        $this->set('_serialize', ['Charities']);
    }

    /**
     * View method
     *
     * @param string|null $id charity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $charity = $this->Charities->get($id, [
            'contain' => []
        ]);

        $this->set('charity', $charity);
        $this->set('_serialize', ['charity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $charity = $this->Charities->newEntity(); 
        if ($this->request->is('post')) {
            
                $image = $this->request->data['image'];
 
	        $name = time().$image['name']; 
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/charities/'.$name; 
		move_uploaded_file($tmp_name, $upload_path);
            $this->request->data['image'] = $name;      
           
            $charity = $this->Charities->patchEntity($charity, $this->request->getData());
            if ($this->Charities->save($charity)) {
                $this->Flash->success(__('The charity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The charity could not be saved. Please, try again.'));
        }
       // $parentCharities = $this->Charities->ParentCharities->find('treeList', ['limit' => 200]);  
        $this->set(compact('charity'));
        $this->set('_serialize', ['charity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id charity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $charity = $this->Charities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
                   $post = $this->request->data; 

			if($this->request->data['image']['name'] != ''){ 
					
			 	
			 
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/charities/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				 
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}
            
             
            $charity = $this->Charities->patchEntity($charity, $post);
            if ($this->Charities->save($charity)) {
                $this->Flash->success(__('The charity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The charity could not be saved. Please, try again.'));
        }
        //$parentCharities = $this->Charities->ParentCharities->find('treeList', ['limit' => 200]);
        $this->set(compact('charity'));
        $this->set('_serialize', ['charity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id charity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $charity = $this->Charities->get($id);

        if ($this->Charities->delete($charity)) {
            $this->Flash->success(__('The charity has been deleted.'));
        } else {
            $this->Flash->error(__('The charity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }  
}

<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Giftcards Controller
 *
 * @property \App\Model\Table\GiftcardsTable $Giftcards
 *
 * @method \App\Model\Entity\Giftcards[] paginate($object = null, array $settings = [])
 */
class GiftcardsController extends AppController
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

       $this->Auth->allow(['logout','slugify','sharehistory','shareview']);

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
            'order'=>['Giftcards.id' =>'desc']
        ];
        $Giftcards = $this->paginate($this->Giftcards);

        $this->set(compact('Giftcards'));
        $this->set('_serialize', ['Giftcards']);
    }


    public function sharehistory(){
        
        $this->loadModel('Sharehistories');
        $sharehistories = $this->Sharehistories->find('all',['contain'=>['Giftcards'=>['Users'],'Users']]);
        
        $sharehistories = $sharehistories->all()->toArray(); 
        
        
        $this->set(compact('sharehistories'));
        $this->set('_serialize', ['sharehistories']);
        
        
    }
    
        public function shareview($id = null)
    {
        $this->loadModel('Sharehistories');
        $giftcard = $this->Sharehistories->get($id, [
            'contain' => ['Giftcards'=>['Users'],'Users']
        ]);

        $this->set('giftcard', $giftcard);
        $this->set('_serialize', ['giftcard']);
    }
    
    
    /**
     * View method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $giftcard = $this->Giftcards->get($id, [
            'contain' => []
        ]);

        $this->set('giftcard', $giftcard);
        $this->set('_serialize', ['giftcard']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() 
    {
        $giftcard = $this->Giftcards->newEntity(); 
        if ($this->request->is('post')) {
            
                $image = $this->request->data['image'];
 
	        $name = time().$image['name']; 
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/giftcards/'.$name; 
		move_uploaded_file($tmp_name, $upload_path);
            $this->request->data['image'] = $name;      
           
            $giftcard = $this->Giftcards->patchEntity($giftcard, $this->request->getData());
            if ($this->Giftcards->save($giftcard)) {
                $this->Flash->success(__('The giftcard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The giftcard could not be saved. Please, try again.'));
        }
       $stores = $this->Giftcards->Stores->find('list', ['limit' => 200]);
       $categories = $this->Giftcards->Categories->find('list', ['limit' => 200]); 
        $this->set(compact('giftcard','stores','categories'));
        $this->set('_serialize', ['giftcard']);
    }

    /**
     * Edit method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $giftcard = $this->Giftcards->get($id, [ 
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
                   $post = $this->request->data; 

			if($this->request->data['image']['name'] != ''){ 
					
			 	
			 
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/giftcards/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				 
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']); 
				$post = $this->request->data;
			}
            
             
            $giftcard = $this->Giftcards->patchEntity($giftcard, $post);
            if ($this->Giftcards->save($giftcard)) {
                $this->Flash->success(__('The giftcard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The giftcard could not be saved. Please, try again.'));
        }
        $stores = $this->Giftcards->Stores->find('list', ['limit' => 200]);
        $categories = $this->Giftcards->Categories->find('list', ['limit' => 200]); 
        $this->set(compact('giftcard','stores','categories'));
        $this->set('_serialize', ['giftcard']);
    }

    /**
     * Delete method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $giftcard = $this->Giftcards->get($id);

        if ($this->Giftcards->delete($giftcard)) {
            $this->Flash->success(__('The giftcard has been deleted.'));
        } else {
            $this->Flash->error(__('The giftcard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);  
    }  
}

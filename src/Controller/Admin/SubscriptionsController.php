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
class SubscriptionsController extends AppController
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

       $this->Auth->allow(['logout']);

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
            'contain' => ['Users'],
            'order'=>['Subscriptions.id' =>'desc']
        ];
        $subscriptions = $this->paginate($this->Subscriptions);

        $this->set(compact('subscriptions'));
        $this->set('_serialize', ['subscriptions']);
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
        $subscriptions = $this->Subscriptions->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('subscriptions', $subscriptions);
        $this->set('_serialize', ['subscriptions']);
    }


   

   
}

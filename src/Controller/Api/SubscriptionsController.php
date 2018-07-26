<?php
namespace App\Controller\Api;     

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

       $this->Auth->allow(['logout','savesubscription']);

        $this->authcontent(); 

    }  
    
    
   
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function savesubscription()
    {

        $subscription = $this->Subscriptions->newEntity(); 
        if ($this->request->is('post')) {
            
            $exist = $this->Subscriptions->find('all',['conditions'=>['Subscriptions.user_id'=>$this->request->data['user_id']]]);
            $exist = $exist->first(); 

            if($exist){
               $response['status'] = false;
               $response['msg'] = 'Subscriptions already exist.'; 
            }else{
           
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->getData());
            if ($this->Subscriptions->save($subscription)) {

                $response['status'] = true;
                $response['msg'] = 'The subscriptions has been saved.';
                
            }else{
                $response['status'] = false;
                $response['msg'] = 'The subscriptions could not be saved. Please, try again.';
            }

           } 
           
        }

        echo json_encode($response);
        exit;
  
    }


    
    

   
}

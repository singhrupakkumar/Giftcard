<?php

namespace App\Controller\Admin;



use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;



/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */

class DashboardController extends AppController

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



	public function index(){

		$this->loadModel('Users');
		$this->loadModel('Giftcards');
		$this->loadModel('Stores');
		$this->loadModel('Charities');
 

		$users = $this->Users->find('all',[
			'conditions' => ['Users.role' => 'user','Users.status' => 1]
		])->all()->toArray();
		
		$this->set('users', $users);
		$this->set('_serialize', ['users']);
		
		$giftcard = $this->Giftcards->find('all')->all()->toArray();
		
		$this->set('giftcard', $giftcard);  
		$this->set('_serialize', ['giftcard']);  


		$stores = $this->Stores->find('all')->all()->toArray();
		
		$this->set('stores', $stores);  
		$this->set('_serialize', ['stores']);  

		$charity = $this->Charities->find('all')->all()->toArray();
		
		$this->set('charity', $charity);  
		$this->set('_serialize', ['charity']);  
		

		$members = $this->Users->find('all',[
			'conditions' => ['Users.status' => 1],
			'order'		=> ['Users.id' => 'desc'],
			'limit'		=>	8
		])->all()->toArray();
		
		$this->set('members', $members);
		$this->set('_serialize', ['members']);




		/*************Top Categories***************/


		$topcategory = $this->Categories->find('all',[
			'conditions' => ['Categories.status' => 1],
			'order'		=> ['Categories.id' => 'desc'],
			'limit'		=>	5
		])->all()->toArray();


		$this->set('topcategory', $topcategory);
		$this->set('_serialize', ['topcategory']);

		  

	}
}
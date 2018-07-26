<?php
namespace App\Controller\Admin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 *
 * @method \App\Model\Entity\Staticpage[] paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
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

        $this->Auth->allow(['tonelist']);

        $this->authcontent();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
         if ($this->request->is(array('post', 'put'))) {

            foreach ($this->request->data as $setting_key=>$setting_value){
                 
               $this->Settings->updateAll(['value'=>"$setting_value"],['key'=>$setting_key]);          
            }
            
             $this->Flash->success(__('Settings updated!'));
        
             
         }
        
        $settings = $this->Settings->find('all',[
			'order'		=>  ['Settings.id' => 'ASC']
		]);
		
	$settings = $settings->all()->toArray();

        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }
    
       public function tonelist()
    {
        $this->loadModel('Tones');
        $tones = $this->Tones->find('all',[
			'order'		=>  ['Tones.id' => 'ASC']
		]);
		
	$tones = $tones->all()->toArray();
	

	
    	foreach($tones as &$tone){
    	     if($tone['file']){   
             $tone['file'] = Router::url('/', true)."images/tones/". $tone['file'].".mp3";
             }else{
             $tone['file'] = Router::url('/', true)."images/tones/british_text_message.mp3";   
             }   
    	    
      	}

        $this->set(compact('tones'));
        $this->set('_serialize', ['tones']);
    }
    
    


}

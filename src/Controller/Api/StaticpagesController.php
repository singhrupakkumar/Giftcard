<?php
namespace App\Controller\Api;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Mailer\Email;

header("Access-Control-Allow-Origin: *");

/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 *
 * @method \App\Model\Entity\Staticpage[] paginate($object = null, array $settings = [])
 */
class StaticpagesController extends AppController
{

  public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        $this->Auth->allow(['pages','tutorial','sendmail','faq']);

        $this->authcontent();

    }


    public function pages(){ 

    if ($this->request->is('post')) {

        if(empty($this->request->data['position'])){
            $response['status'] = false;
            $response['msg'] = 'Page position required';
        }else{

         $staticpages = $this->Staticpages->find('all',[ 
            'conditions'=>['Staticpages.position'=>$this->request->data['position'],'Staticpages.status'=>1]
        ]);
        $staticpages = $staticpages->first();
        
        if($staticpages){

            $response['status'] = true;
            $response['data'] = $staticpages;
        }else{
           $response['status'] = false;
           $response['msg'] = 'Page not found'; 
        }


     }


    }
    echo json_encode($response);
    exit; 
    }


    public function faq(){ 

    if ($this->request->is('post')) {

         $staticpages = $this->Staticpages->find('all',[ 
            'conditions'=>['Staticpages.position'=>'faq','Staticpages.status'=>1]
        ]);
        $staticpages = $staticpages->all()->toArray();
        
        if($staticpages){

            $response['status'] = true;
            $response['data'] = $staticpages;
        }else{
           $response['status'] = false; 
           $response['msg'] = 'Page not found'; 
        }




    }
    echo json_encode($response);
    exit; 
    }


    public function tutorial(){ 
        $this->loadModel('Settings');

    if ($this->request->is('post')) {

        $data = array();

         $tutorial = $this->Settings->find('all',[ 
            'conditions'=>['Settings.key'=>'tutorial_info']
        ]);
        $tutorial = $tutorial->first();

        $tutorial1 = $this->Settings->find('all',[ 
            'conditions'=>['Settings.key'=>'tutorial_youtube_video_id_only']
        ]);

        $tutorial1 = $tutorial1->first();

        $data['link'] = $tutorial1['value'];
        $data['info'] = $tutorial['value'];
        
        if($data){

            $response['status'] = true;
            $response['data'] = $data;
        }else{
           $response['status'] = false;
           $response['msg'] = 'Page not found'; 
        }


    }
    echo json_encode($response);
    exit; 
    }


    public function sendmail(){
        
           
     $this->loadModel('Contacts');
     $contact = $this->Contacts->newEntity();
    if($this->request->is('post')){    
       if(!empty($this->request->data['email'])){        
        
          $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) { 
                $ms = '<table width="200" border="1"><tr><th scope="row">Name</th><td>' . $this->request->data['name'] . '</td></tr><tr><th scope="row">Email</th><td>' . $this->request->data['email'] . '</td></tr><tr><th scope="row">Message</th><td>' . $this->request->data['message'] . '</td></tr></table>';
                $email = new Email('default'); 
                $email->from(['rupak@avainfotech.com' => 'Gift Card'])
                        ->emailFormat('html')
                        ->template('default', 'default')
                        ->to('rupak@avainfotech.com')
                        ->subject('Contact Us Enquiry')
                        ->send($ms);

                 $response['status'] = true;
                 $response['msg'] = 'Thank you for contacting us! We will get back to you shortly.';        
                 
            } else {  
                $response['status'] = false;
                $response['msg'] = 'The contact could not be saved. Please, try again.';   
            
            } 
           
       }else{
         $response['status'] = false;
         $response['msg'] = 'Email is requred.';
       } 
  
    }   
     
    echo json_encode($response);
    exit;       
    
    }

  

  
}

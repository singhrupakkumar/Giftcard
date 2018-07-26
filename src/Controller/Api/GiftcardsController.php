<?php
namespace App\Controller\Api;      

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;


use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

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

        $this->Auth->allow(['slugify','index','add','edit','delete','view','neareststorebylocation','mygiftcard','viewcadbytype','donatemycard','sharemycard','storelisting','categorylisting','storeview','mycards','charitylist']);  

        $this->authcontent(); 

    } 
    
 public $distance = 100; 
    
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

    

    public function storelisting(){
        $this->loadModel('Stores');

     if ($this->request->is('post')) { 

        $store = $this->Stores->find('all',['contain'=>['Categories'],'conditions'=>['Stores.status'=>1]]);
        $store = $store->all()->toArray();
        if($store){
          $response['status'] = true ;
          $response['data'] = $store; 

        }else{

          $response['status'] = false ;
          $response['data'] = '';  

        }
      
     }
      echo json_encode($response);
       exit;  
    }


     public function categorylisting(){
        $this->loadModel('Categories');

      

     if ($this->request->is('post')) { 

        $category = $this->Categories->find('all',['conditions'=>['Categories.status'=>1]]);
        $category = $category->all()->toArray();


        if($category){
          $response['status'] = true ;
          $response['data'] = $category; 

        }else{

          $response['status'] = false ;
          $response['data'] = '';  

        }
      
     }
      echo json_encode($response);
       exit;  
    }

     public function charitylist(){
        $this->loadModel('Charities');

     if ($this->request->is('post')) { 

        $charities = $this->Charities->find('all',['conditions'=>['Charities.status'=>1]]);
        $charities = $charities->all()->toArray();


        if($charities){
          $response['status'] = true ;
          $response['data'] = $charities; 

        }else{

          $response['status'] = false ;
          $response['data'] = '';  

        }
      
     }
      echo json_encode($response);
       exit;  
    }

    


    

    public function mygiftcard(){

        if ($this->request->is('post')) { 
         $user_id = $this->request->data['user_id'] ;

         if(empty($user_id)){
          $response['status'] = false ;
          $response['data'] = 'User id required';  
         }else{  

        $usercard =  $this->Giftcards->find('all',['contain'=>['Stores'],'conditions'=>['Giftcards.user_id'=>$user_id]]);
        $usercard = $usercard->all()->toArray();
        if($usercard){
            $response['status'] = true ;
            $response['data'] = $usercard;


        }else{
            $response['status'] = false ;
            $response['data'] = '';
        }

       } 

         }  

       echo json_encode($response);
       exit;   
    }

    public function donatemycard(){

        $this->loadModel('Donatehistories');
        $this->loadModel('Charities');
         if ($this->request->is('post')) { 
            $donatehistory = $this->Donatehistories->newEntity(); 
             $card_id = $this->request->data['card_id'];
             $charity_id = $this->request->data['charity_id'];



        $exist = $this->Donatehistories->find('all', ['conditions' =>['AND' =>['Donatehistories.charity_id' => $charity_id,'Donatehistories.card_id' => $card_id]]]);
        $exist = $exist->first();
        if (!empty($exist)) {
            $response['status'] = false;
            $response['msg'] = "You are already donate this card to current chatity.";

        }else{

             $donatehistory = $this->Donatehistories->patchEntity($donatehistory, $this->request->getData());

            $save = $this->Donatehistories->save($donatehistory);  

            if ($save) {

            $charity_exist = $this->Charities->find('all', ['conditions' =>['Charities.id' => $charity_id]]);
            $charity_exist = $charity_exist->first();
            if(!empty($charity_exist)){ 
				$this->Giftcards->updateAll(array('user_id' =>$charity_exist['user_id']), array('id' =>$card_id));
            }

                 $response['status'] = true;
                 $response['msg'] = "Donate successfully.";  

             }else{
                $response['status'] = false;
                $response['msg'] = "Something wrong try again.";
             }


        } 

         }

       echo json_encode($response);  
       exit;   

    }

    public function sharemycard(){

        $this->loadModel('Sharehistories');
        $this->loadModel('Users'); 
         if ($this->request->is('post')) { 
            $sharehistory = $this->Sharehistories->newEntity(); 
             $card_id = $this->request->data['card_id'];
             $friend_email = $this->request->data['friend_email'];

        $user = $this->Users->find('all', ['conditions' =>['Users.email'=>$friend_email]]); 

        $user = $user->first();   
        if($user){
            $user_id = $user['id'];
        }else{
            $user_id = 0; 
        }

        $this->request->data['friend_id'] =  $user_id ;  

        $exist = $this->Sharehistories->find('all', ['conditions' =>['AND' =>['Sharehistories.friend_email' => $friend_email,'Sharehistories.card_id' => $card_id]]]);
        $exist = $exist->first();
        if (!empty($exist)) {
            $response['status'] = false;
            $response['msg'] = "You are already share this card to current friend.";

        }else{

             $sharehistory = $this->Sharehistories->patchEntity($sharehistory, $this->request->getData());

            $save = $this->Sharehistories->save($sharehistory);  

            if ($save) {
                 $response['status'] = true;
                 $response['msg'] = "share successfully.";
                 $response['data'] = $save;

             }else{
                $response['status'] = false;
                $response['msg'] = "Something wrong try again.";
             }


        } 

         }

       echo json_encode($response); 
       exit;   

    }
    public function viewcadbytype(){

        if ($this->request->is('post')) { 
         $user_id = $this->request->data['user_id'];
         $card_type = $this->request->data['card_type'];

         if(empty($user_id)){
          $response['status'] = false ;
          $response['data'] = 'User id required';  
         }elseif(empty($card_type)){
          $response['status'] = false ;
          $response['data'] = 'Card type required';
         }else{  

        $usercard =  $this->Giftcards->find('all',[['Stores'],'conditions'=>['AND'=>['Giftcards.user_id'=>$user_id,'Giftcards.card_type'=>$card_type]]]);
        $usercard = $usercard->all()->toArray();
        if($usercard){ 
            $response['status'] = true ;
            $response['data'] = $usercard;


        }else{
            $response['status'] = false ;
            $response['data'] = '';
        }

       } 

         }  

       echo json_encode($response);
       exit;   
    }

    public function neareststorebylocation(){
        $this->loadModel('Stores');
        $this->loadModel('Storelocations');
        $conn = ConnectionManager::get('default');

       if ($this->request->is('post')) { 

          $lat = $this->request->data['lat'] ; 
          $long = $this->request->data['long'] ;  

         //$lat = '30.7333'; 
         //$long = '76.7794' ;  


    //  $data = $this->Storelocations->find()->contain('Stores')
    // ->select([
    // 'distance' => "get_distance_in_miles_between_geo_locations('".$lat."','".$long."',Storelocations.lat,Storelocations.long)"])
    // ->select($this->Storelocations)->all();   
 





         // $query = "SELECT DISTINCT Storelocations.*,Stores.*,Giftcards.*,get_distance_in_miles_between_geo_locations('30.733578','76.705030',`Storelocations.lat`,`Storelocations.long`) as distance FROM `storelocations` as `Storelocations` ,`stores`as `Stores`, giftcards as Giftcards where `Stores`.`id` = `Storelocations`.`store_id` and `Stores`.`id` = `Giftcards`.`store_id` HAVING distance < 5 ORDER BY distance"


         $query = "SELECT *, get_distance_in_miles_between_geo_locations('".$lat."','".$long."',`lat`,`long`) as distance FROM storelocations group by store_id ORDER BY distance";
        $data = $conn->execute($query);  
        $data = $data->fetchAll('assoc');  

            $cnt = count($data);
            for ($i = 0; $i < $cnt; $i++) {
                if ($data[$i]['distance'] < $this->distance) {
                    
                } else {
                    unset($data[$i]);
                }
            }  
          $distance_myarrar = [];  
        foreach ($data as $key => $value) {
          $store_id[] = $value['store_id'];
          $distance_myarrar[$value['store_id']] = $value['distance'];
       
        }

        $storedata = $this->Stores->find('all',['contain'=>['Giftcards','Categories'],'conditions'=>['Stores.id in'=> $store_id]]);
        $storedata = $storedata->all()->toArray();
    
        foreach ($storedata as $key => &$value) {

        	 if($value['image']){   
             $value['image'] = Router::url('/', true)."images/stores/". $value['image'];
             }else{
             $value['image'] = Router::url('/', true)."images/stores/no-image.jpg";   
             }
 


        	 if(empty($value['giftcards'])){
        	 	 unset($storedata[$key]);   
        	 }
        	 $total_card_value = 0;
           // if($value['id'] == $data[$key]['store_id']){
        	 if(isset($distance_myarrar[$value['id']])){
        	 	 $value['distance'] = $distance_myarrar[$value['id']];
        	 }else{
        	 	$value['distance'] = 0;
        	 }
              
               if(!empty($value['giftcards'])){
               
                foreach ($value['giftcards'] as $key1 => &$value1) { 
                 
                 if($value1['user_id'] == $this->request->data['user_id']) {
                 	 $total_card_value += $value1['card_value'];  
                 }else{

                 	unset($value['giftcards'][$key1]);
                 	if(empty($value['giftcards'])){
                 		unset($storedata[$key]);  
                 	}
                 	  
                 }
                }
               }else{  
                $total_card_value = 0;
                unset($storedata[$key]);
               }


            $value['total_card_value'] = $total_card_value;
          
        }


 

        if($storedata){
          $response['status'] = true;
          $response['storedata'] = $storedata; 
          $response['location'] = $data;  
        }else{
          $response['status'] = false;
          $response['storedata'] = ''; 
          $response['location'] = $data;     
        }

       }  

       echo json_encode($response);
       exit;  
    }

    /**
     * View method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        if ($this->request->is('post')) { 
        $id = $this->request->data['card_id'] ;  

        if(empty($id)){
          $response['status'] = false;
          $response['msg'] = 'Card id required';  
        }else{

        $giftcard = $this->Giftcards->find('all', [
            'contain' => ['Stores'=>'Categories','Categories'],
            'conditions'=>['Giftcards.id'=>$id]
        ]);
        $giftcard = $giftcard->first(); 


         if($giftcard['store']['image']){   
             $giftcard['store']['image'] = Router::url('/', true)."images/stores/". $giftcard['store']['image'];
             }else{
             $giftcard['store']['image'] = Router::url('/', true)."images/stores/no-image.jpg";   
             }

        if($giftcard){
          $response['status'] = true;
          $response['data'] = $giftcard;   

        }else{

          $response['status'] = false;
          $response['msg'] = 'Invalid card id';  

        }

        }
       

         }

         echo json_encode($response);
         exit;
      
    }





     public function storeview()
    {
    	$this->loadModel('Stores');
        if ($this->request->is('post')) { 
        $id = $this->request->data['store_id'] ;  

        if(empty($id) || empty($this->request->data['user_id'])){
          $response['status'] = false;
          $response['msg'] = 'store_id & user_id required';  
        }else{

        $stores = $this->Stores->find('all', [
            'contain' => ['Giftcards'=>'Categories','Categories'],
            'conditions'=>['Stores.id'=>$id]
        ]);
        $stores = $stores->first(); 


        if($stores['image']){   
         $stores['image'] = Router::url('/', true)."images/stores/". $stores['image'];
         }else{
         $stores['image'] = Router::url('/', true)."images/stores/no-image.jpg";   
         }

         if(!empty($stores['giftcards'])){
         	foreach ($stores['giftcards'] as $key => &$value) {
         	
         	if($value['user_id'] == $this->request->data['user_id']){

         	}else{ 
         		unset($stores['giftcards'][$key]);
         	}
         	}
         }

        if($stores){
          $response['status'] = true;
          $response['data'] = $stores;   

        }else{

          $response['status'] = false;
          $response['msg'] = 'Invalid store id';  

        }

        }
       

         }

         echo json_encode($response);
         exit;
      
    }



     public function mycards()
    {
    
   	   $this->loadModel('Stores');

        if ($this->request->is('post')) { 
        $id =  $this->request->data['user_id'];

        if(empty($id)){
          $response['status'] = false;
          $response['msg'] = 'user_id required';   
        }else{

        $mycard = $this->Giftcards->find('all', [
            'contain' => ['Stores'],
            'conditions'=>['Giftcards.user_id'=>$id]
           
        ]); 	
       $mycard = $mycard->all()->toArray(); 
       $mystore_id  = [] ;
       foreach($mycard as $key => $card){
       	$mystore_id[]  = $card['store']['id'];
       }

    
        $allstore = $this->Stores->find('all', [
            'contain' => ['Giftcards'=>'Categories','Categories'],
            'conditions'=>['Stores.id in' =>$mystore_id]
           
        ]);
        $allstore = $allstore->all()->toArray(); 


        foreach ($allstore as $key => &$value) {

        if($value['image']){   
         $value['image'] = Router::url('/', true)."images/stores/". $value['image'];
         }else{
         $value['image'] = Router::url('/', true)."images/stores/no-image.jpg";   
         }
        $total_card_value = 0 ;
        if(!empty($value['giftcards'])){

          foreach ($value['giftcards'] as $key1 => &$value1) { 
                 
                 if($value1['user_id'] == $this->request->data['user_id']) {
                 	 $total_card_value += $value1['card_value'];  
                 }else{

                 	unset($value['giftcards'][$key1]);
                 	if(empty($value['giftcards'])){
                 		unset($allstore[$key]);  
                 	}
                 	  
                 }
                }


    	 }

    	$value['total_card_value'] = $total_card_value;

        }
        


        if($allstore){
          $response['status'] = true;
          $response['data'] = $allstore;   

        }else{

          $response['status'] = false;
           $response['data'] = '';   
          $response['msg'] = 'you don\'t have any cards';  

        }

        }
       

         }

         echo json_encode($response);
         exit;
      
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
            
  //            $image = $this->request->data['image'];
 
	 //        $name = time().$image['name']; 
		// $tmp_name = $image['tmp_name'];
		// $upload_path = WWW_ROOT.'images/giftcards/'.$name; 
		// move_uploaded_file($tmp_name, $upload_path);
  //           $this->request->data['image'] = $name;

            $exist = $this->Giftcards->find('all',['conditions'=>['Giftcards.card_code'=>$this->request->data['card_code']]]);
            $exist = $exist->first(); 

            if($exist){
               $response['status'] = false;
               $response['msg'] = 'giftcard code already exist.'; 
            }else{
           
            $giftcard = $this->Giftcards->patchEntity($giftcard, $this->request->getData());
            if ($this->Giftcards->save($giftcard)) {

                $response['status'] = true;
                $response['msg'] = 'The giftcard has been saved.';
                
            }else{
                $response['status'] = false;
                $response['msg'] = 'The giftcard could not be saved. Please, try again.';
            }

           } 
           
        }

        echo json_encode($response);
        exit;
   
    }

    /**
     * Edit method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
     
        if ($this->request->is(['patch', 'post', 'put'])) {

         
            if(empty($this->request->data['id'])){
                $response['status'] = false;
                $response['msg'] = 'Gift card id required.';

            }else{

           $giftcard = $this->Giftcards->get($this->request->data['id'], [

            'contain' => []
             ]);
   

            $post = $this->request->data; 

            $giftcard = $this->Giftcards->patchEntity($giftcard, $post);
            if ($this->Giftcards->save($giftcard)) {

                $response['status'] = true; 
                $response['msg'] = 'The giftcard has been update.';
            
            }else{
                $response['status'] = false;
                $response['msg'] = 'The giftcard could not be update. Please, try again.';
            }
            
            }
            
         
        }

         echo json_encode($response);
        exit;
      
    }

    /**
     * Delete method
     *
     * @param string|null $id giftcard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {  
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->data['id'];
        $giftcard = $this->Giftcards->get($id);

        if ($this->Giftcards->delete($giftcard)) {
            $response['status'] = true; 
            $response['msg'] = 'The giftcard has been deleted.';
          
        } else {
            $response['status'] = false; 
            $response['msg'] = 'The giftcard could not be deleted. Please, try again.';
        
        }

        echo json_encode($response);
        exit;
    }  
}

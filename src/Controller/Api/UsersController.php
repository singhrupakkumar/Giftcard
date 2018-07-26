<?php

namespace App\Controller\Api;



use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Mailer\Email;

use Cake\Error\Debugger;


 


/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */

class UsersController extends AppController

{



	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);
  

        $this->Auth->allow(['index','paymenthistory',"login",'userdata','edit','changepassword','forgot','reset','fblogin','gplogin','twitterlogin','instalogin','add','usersetting','purchasevoice','pushsend','emailverify']); 

        $this->authcontent();

    }



    /**

     * Index method

     *

     * @return \Cake\Http\Response|void

     */
    public function index(){

    	
            $baseurl = Router::url('/',true);

        $indexInfo['description'] = "Signup (post method)";

        $indexInfo['url'] = $baseurl. "api/users/add";

        $indexInfo['parameters'] = 'email:rupak@gmail.com username:rupak@gmail.com fname:Rupak lname:Singh password:123456<br>';

        $indexarr[] = $indexInfo;    

        $indexInfo['description'] = "User login(post method)";

        $indexInfo['url'] = $baseurl. "api/users/login";

        $indexInfo['parameters'] = 'username:prateek@avainfotech.com password:123456,device_token:dfrgtrghryhtrytret454545fg<br>'; $indexarr[] = $indexInfo;


        $indexInfo['description'] = "User Data(post method)"; 

        $indexInfo['url'] = $baseurl. "api/users/userdata";

        $indexInfo['parameters'] = 'id:44 <br>'; 

        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Edit Profile(post method)"; 

        $indexInfo['url'] = $baseurl. "api/users/edit";

        $indexInfo['parameters'] = 'id:45 ,fname:Vandana11 lname:sdff,image:abc.png ,<br>'; 

        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Changepassword (post method)"; 

        $indexInfo['url'] = $baseurl. "api/users/changepassword"; 

        $indexInfo['parameters'] = 'id:45 ,oldpassword:123456 password:123 ,<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Forgot Password (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/forgot"; 
        $indexInfo['parameters'] = 'email:prateek@avainfotech.com ,<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Facebook Login (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/fblogin"; 
        $indexInfo['parameters'] = 'fb_id:454544544455444444 ,email:rupak@avainfotech.com, fname:rupak, lname:singh,  ,<br>';  
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Google Plus Login (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/gplogin";  
        $indexInfo['parameters'] = 'google_id:454544544455444444 ,email:rupak@avainfotech.com, image:feerf.png, fname:rupak, lname:singh,  ,<br>';     
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Twitter Login (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/twitterlogin";  
        $indexInfo['parameters'] = 'twitter_id:454544544455444444 ,email:rupak@avainfotech.com, image:feerf.png, fname:rupak, lname:singh,  ,<br>';     
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Instagram Login (post method)"; 
        $indexInfo['url'] = $baseurl. "api/users/instalogin";  
        $indexInfo['parameters'] = 'insta_id:454544544455444444 ,email:rupak@avainfotech.com, image:feerf.png, fname:rupak, lname:singh,  ,<br>';       
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Add gift Card";

        $indexInfo['url'] = $baseurl. "api/giftcards/add";

        $indexInfo['parameters'] = 'name:rk shop_id:60 card_code:fddg56 address:dtgr card_value:5454564564 card_type:fgh category:4 expiration:12 reminder:1 giver_name:ms giver_contact:855545555<br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = "Edit gift Card";

        $indexInfo['url'] = $baseurl. "api/giftcards/edit";

        $indexInfo['parameters'] = 'id:2 name:rk shop_id:60 card_code:fddg56 address:dtgr card_value:5454564564 card_type:fgh category:4 expiration:12 reminder:1 giver_name:ms giver_contact:855545555<br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = "Delete gift Card";
        $indexInfo['url'] = $baseurl. "api/giftcards/delete";
        $indexInfo['parameters'] = 'id:2 <br>';
        $indexarr[] = $indexInfo; 

        $indexInfo['description'] = "Single Card view";
        $indexInfo['url'] = $baseurl. "api/giftcards/view";
        $indexInfo['parameters'] = 'card_id:3 <br>';
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "My Giftcards";
        $indexInfo['url'] = $baseurl. "api/giftcards/mygiftcard";
        $indexInfo['parameters'] = 'user_id:45 <br>';
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "View Card By Type";
        $indexInfo['url'] = $baseurl. "api/giftcards/viewcadbytype";
        $indexInfo['parameters'] = 'user_id:45,card_type:hghhh <br>';
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Donate My Card";
        $indexInfo['url'] = $baseurl. "api/giftcards/donatemycard";
        $indexInfo['parameters'] = 'card_id:3,charity_id:2 <br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Charity List Api";
        $indexInfo['url'] = $baseurl. "api/giftcards/charitylist";  
        $indexInfo['parameters'] = 'no required <br>';  
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Share my card";
        $indexInfo['url'] = $baseurl. "api/giftcards/sharemycard";  
        $indexInfo['parameters'] = 'card_id:3,friend_name:Rupak,friend_email:rupak@avainfotech.com,is_deleted :1 <br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Privacy & Policy";
        $indexInfo['url'] = $baseurl. "api/staticpages/pages";
        $indexInfo['parameters'] = 'position:privacy-policy <br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Support & Contact";
        $indexInfo['url'] = $baseurl. "api/staticpages/pages";
        $indexInfo['parameters'] = 'position:support-contact <br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Send Mail";
        $indexInfo['url'] = $baseurl. "api/staticpages/sendmail";
        $indexInfo['parameters'] = 'name:Rupak ,email:rupak@avainfotech.com,message: this is test msg<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Tutorial Video";
        $indexInfo['url'] = $baseurl. "api/staticpages/tutorial";
        $indexInfo['parameters'] = 'no requred<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "FAQ";
        $indexInfo['url'] = $baseurl. "api/staticpages/faq";
        $indexInfo['parameters'] = 'no requred<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Store listing APi ";
        $indexInfo['url'] = $baseurl. "api/giftcards/storelisting";
        $indexInfo['parameters'] = 'no requred<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Category listing Api"; 
        $indexInfo['url'] = $baseurl. "api/giftcards/categorylisting";
        $indexInfo['parameters'] = 'no requred<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Store view Api"; 
        $indexInfo['url'] = $baseurl. "api/giftcards/storeview";
        $indexInfo['parameters'] = 'store_id:1 user_id:63<br>'; 
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "Mycards view Api"; 
        $indexInfo['url'] = $baseurl. "api/giftcards/mycards";
        $indexInfo['parameters'] = 'user_id:63<br>'; 
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Save Purchase Voice"; 
        $indexInfo['url'] = $baseurl. "api/users/purchasevoice";
        $indexInfo['parameters'] = 'user_id:63 ,voice_id[0]:1,voice_id[1]:2,voice_id[3]:3,voice_id[4]:4<br>'; 
        $indexarr[] = $indexInfo;
 

        $indexInfo['description'] = "User Account Settins"; 
        $indexInfo['url'] = $baseurl. "api/users/usersetting";
        $indexInfo['parameters'] = 'settingsdata[audible_noti]:1 ,settingsdata[banner_noti]:1,settingsdata[noti_within_days]:15,settingsdata[display_mycard_as]:List,settingsdata[mycard_display_order]:Alphabetical,settingsdata[currency]:Us Dollars,settingsdata[subscription]:standard,settingsdata[subscription_expired]:2018-06-15,settingsdata[automatic_renewal]:0,user_id:44<br>';  
        $indexarr[] = $indexInfo;

        $indexInfo['description'] = "User Subscriptions save Api"; 
        $indexInfo['url'] = $baseurl. "api/subscriptions/savesubscription";
        $indexInfo['parameters'] = 'user_id:68, payamount:105, expired_date:2019-07-20<br>';  
        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Nearest Store By Location";
        $indexInfo['url'] = $baseurl. "api/giftcards/neareststorebylocation";
        $indexInfo['parameters'] = 'lat:30.723465 ,long: 76.808853 <br>';
        $indexarr[] = $indexInfo;  

        $this->set('baseurl', $baseurl);
        $this->set('indexarr', $indexarr); 

        $this->set('_serialize', ['user']);

    }



    public function pushsend()

    { 
         $response = array(); 
         if ($this->request->is('post')) { 
          $user_id = $this->request->data['user_id']; 
          if(!empty($user_id)){
          $userdata = $this->Users->find('all',['contain'=>['Usertones'=>'Tones'],'conditions'=>['Users.id'=>$user_id]]);

          $userdata = $userdata->first();
         if($userdata){ 

         if($userdata['device_token']){  
          $sound = true ;
          $soundarray = [] ;
          if(!empty($userdata['usertones'])){

            foreach ($userdata['usertones'] as $key => $value) {
             $soundarray[] = $value['tone']['file'];
            }

          }  
          if(!empty($soundarray)){
            shuffle($soundarray);
            $sound = $soundarray[0];
          }else{
           $sound = true ; 
          }
       
         $send = $this->SendPushNotificationsAndroid($userdata['device_token'],'Test','This is test push notification.',$sound);

           if($send){
             $response['msg'] = "Successfully send notification."; 
             $response['status'] = true;
           }else{
             $response['msg'] = "something worng.";
             $response['status'] = false;
           } 

          }else{
            $response['msg'] = "Device token required.";
            $response['status'] = false;   
          } 

         }else{
             $response['msg'] = "Invalid user";
             $response['status'] = false; 
         }  

        }else{
             $response['msg'] = "User id required";
             $response['status'] = false; 
        } 
       }

         echo json_encode($response);
         exit;
    }



    public function login()

    {
         $response = array();

          //if ((new DefaultPasswordHasher)->check($this->request->data['oldpassword'], $user['password'])) {
        
		if ($this->request->is('post')) {

            if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                $use = $this->Users->find('all',['conditions'=>['Users.email'=>$this->request->data['username']]]);
            }else{
           
                $use = $this->Users->find('all',['conditions'=>['Users.username'=>$this->request->data['username']]]);  
            }

          

            $use = $use->first();
         

            if (empty($use)){
               $response['msg']='Invalid Username';
                 $response['status']= false;
                 
            }elseif (!(new DefaultPasswordHasher)->check($this->request->data['password'], $use['password'])) {
              $response['msg']='Wrong password';
              $response['status']=false;   
            }else{

                if ($use['status'] == 0) {   
                     $this->Auth->logout();
                     $response['msg']='You are not active Yet!';
                     $response['status']=false;    
                      
                 }else{

				$this->Auth->setUser($use); 

				

				if($this->Auth->user('role') == 'admin'){

					$this->logout();
					$response['msg']='You are admin';
					$response['status']=false;
				

				}else{	
					if(isset($this->request->data['device_token'])){   
					$this->Users->updateAll(['device_token' =>$this->request->data['device_token']],['id' =>$use['id']]); 
					}		

                     $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$use['id']]]);
                    $usedata = $usedata->first();
                  	$response['msg']='login successfully';
					$response['status']= true; 
					$response['data']= $usedata;
				}	


              }  

			}

        }
      echo json_encode($response);
      exit;
    }


     public function fblogin() { 
       
        $response = array();
        if ($this->request->is('post')) {   
             $imgurl ='https://graph.facebook.com/'.$this->request->data['fb_id'].'/picture?width=320&height=320' ;
            $results = $this->Users->find('all', ['conditions' => ['Users.username' => $this->request->data['username']]]);
            $results = $results->first();
            if (!empty($results)) {
            
                if ($results) {
                    $this->Users->updateAll(array('device_token'=>$this->request->data['device_token'],'fb_id' => $this->request->data['fb_id'],'image'=>$imgurl), array('id' => $results['id']));
                    $this->Auth->setUser($results);
                    $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$results['id']]]);
                    $usedata = $usedata->first();
                    $response['status'] = true;
                    $response['data'] = $usedata;
                    $response['msg'] = 'Logged in successfully.';
                } else {

                	$response['status'] = false;
                    $response['data'] = '';
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
       
                }
            } else {
                $post = array();
                $post['fb_id'] = $this->request->data['fb_id'];
                $post['fname'] = $this->request->data['fname'];
                $post['lname'] = $this->request->data['lname'];
                $post['email'] = $this->request->data['email'];
                $post['device_token'] = $this->request->data['device_token'];
                $post['image'] = $imgurl; 
                $post['username'] = $this->request->data['email'];
                $post['password'] = 'zxswedcxswzrrr';
                $post['status'] = '1';
                $post['role'] = 'user'; 
                $user = $this->Users->newEntity();
                $user = $this->Users->patchEntity($user, $post);
                $new_user = $this->Users->save($user);
                
                if ($new_user) {
                   
                    $this->request->data['username'] = $this->request->data['username'];
                    $this->request->data['password'] = 'zxswedcxswzrrr';
                  
                    $user2 = $this->Auth->identify();
                    if ($user2) {
                        $this->Auth->setUser($user2);     
                        $response['status'] = true;
                        $response['data'] = $user2;
                        $response['msg'] = 'Logged in successfully.';
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Error In Signing In. Please Try Again.';
                    }
                }
            }

        }     
        echo json_encode($response);
        exit;
    }
    public function gplogin() {
        
        $response = array();
        if ($this->request->is('post')) {   
            $results = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
            $results = $results->first();
            if (!empty($results)) {
         
                if ($results) {  
                    $this->Users->updateAll(array('device_token'=>$this->request->data['device_token'],'google_id' => $this->request->data['google_id']), array('id' => $results['id']));
                    $this->Auth->setUser($results);  
                    $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$results['id']]]);
                    $usedata = $usedata->first();
                   	$response['status'] = true; 
                   	$response['data'] = $usedata; 
                    $response['msg'] = 'Logged in successfully.';
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            } else {
                $post = array();
                $post['google_id'] = $this->request->data['google_id'];
                $post['device_token']=$this->request->data['device_token'];
                $post['fname'] = $this->request->data['fname'];
                $post['lname'] = $this->request->data['lname'];
                $post['email'] = $this->request->data['email'];
                $post['username'] = $this->request->data['email'];
                //$post['image'] = $this->request->data['image'];
                $post['password'] = 'zxswedcxswzrrr';
                $post['status'] = '1';
                $post['role'] = 'user';
                $user2 = $this->Users->newEntity();
                $user2 = $this->Users->patchEntity($user2, $post);
                $new_user = $this->Users->save($user2);
                if ($new_user) {
                   
                    $this->request->data['username'] = $this->request->data['username'];
                    $this->request->data['password'] = 'zxswedcxswzrrr';
                    $user2 = $this->Auth->identify();
                    if ($user2) {
                        $this->Auth->setUser($user2);
                              
                        $response['status'] = true; 
                        $response['data'] = $user2;  
                        $response['msg'] = 'Logged in successfully.';
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Error In Signing In. Please Try Again.';
                    }
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            }
        }
        echo json_encode($response);   
        exit;
    }


     public function twitterlogin() {  
        
        $response = array();
        if ($this->request->is('post')) {   
            $results = $this->Users->find('all', ['conditions' => ['Users.username' => $this->request->data['username']]]);
            $results = $results->first();
            if (!empty($results)) {
         
                if ($results) {  
                    $this->Users->updateAll(array('device_token'=>$this->request->data['device_token'],'twitter_id' => $this->request->data['twitter_id']), array('id' => $results['id']));
                    $this->Auth->setUser($results);  
                    $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$results['id']]]);
                    $usedata = $usedata->first();
                   	$response['status'] = true; 
                   	$response['data'] = $usedata; 
                    $response['msg'] = 'Logged in successfully.';
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            } else {
                $post = array();
                $post['twitter_id'] = $this->request->data['twitter_id'];
                $post['device_token']=$this->request->data['device_token'];
                $post['fname'] = $this->request->data['fname'];
                $post['lname'] = $this->request->data['lname'];
               // $post['email'] = $this->request->data['email'];
                $post['username'] = $this->request->data['username'];
              
                $post['password'] = 'zxswedcxswzrrr';
                $post['status'] = '1';
                $post['role'] = 'user';
                $user2 = $this->Users->newEntity();
                $user2 = $this->Users->patchEntity($user2, $post);
                $new_user = $this->Users->save($user2);
                if ($new_user) {
                   
                    $this->request->data['username'] = $this->request->data['username'];
                    $this->request->data['password'] = 'zxswedcxswzrrr';
                    $user2 = $this->Auth->identify();
                    if ($user2) {
                        $this->Auth->setUser($user2);
                              
                        $response['status'] = true; 
                        $response['data'] = $user2; 
                        $response['msg'] = 'Logged in successfully.';
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Error In Signing In. Please Try Again.';
                    }
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            }
        }
        echo json_encode($response);   
        exit;
    }


    public function instalogin() {
        
        $response = array();
        if ($this->request->is('post')) {   
            $results = $this->Users->find('all', ['conditions' => ['Users.username' => $this->request->data['username']]]);
            $results = $results->first();
            if (!empty($results)) {
         
                if ($results) {  
                    $this->Users->updateAll(array('device_token'=>$this->request->data['device_token'],'insta_id' => $this->request->data['insta_id']), array('id' => $results['id']));
                    $this->Auth->setUser($results);  
                    $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$results['id']]]);
                    $usedata = $usedata->first();
                   	$response['status'] = true; 
                   	$response['data'] = $usedata; 
                    $response['msg'] = 'Logged in successfully.';
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            } else {
                $post = array();
                $post['insta_id'] = $this->request->data['insta_id'];
                $post['device_token'] = $this->request->data['device_token'];    
                $post['fname'] = $this->request->data['fname'];
                $post['lname'] = $this->request->data['lname'];
               // $post['email'] = $this->request->data['email'];
                $post['username'] = $this->request->data['email'];
              //  $post['image'] = $this->request->data['image'];
                $post['password'] = 'zxswedcxswzrrr';
                $post['status'] = '1';
                $post['role'] = 'user';
                $user2 = $this->Users->newEntity();
                $user2 = $this->Users->patchEntity($user2, $post); 
                $new_user = $this->Users->save($user2);
                if ($new_user) {
                   
                    $this->request->data['username'] = $this->request->data['username'];
                    $this->request->data['password'] = 'zxswedcxswzrrr';
                    $user2 = $this->Auth->identify();
                    if ($user2) {
                        $this->Auth->setUser($user2);
                              
                        $response['status'] = true; 
                        $response['data'] = $user2; 
                        $response['msg'] = 'Logged in successfully.';
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Error In Signing In. Please Try Again.';
                    }
                } else {
                    $response['status'] = false;
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
                }
            }
        }
        echo json_encode($response);   
        exit;
    }


	

	public function userdata()

    {	
    	if(empty($this->request->data['id'])){


			$response['msg']='user id required';
			$response['status']= false;

    	}else{
    		$users = $this->Users->find('all', [
			'conditions' => ['Users.id' => $this->request->data['id']]
			]);

			$users = $users->first();
			if($users){
			$response['data']= $users;
			$response['status']= true;

			}else{
			$response['msg']='Invalid user id';	
			$response['data']= '';
			$response['status']= false;	
			}
		
    	}

      echo json_encode($response);
      exit;

    }


	public function logout() {

        if ($this->Auth->logout()) {

            return $this->redirect(['action' => 'login']);

        }

    }




    public function add()

    {  

        $this->loadModel('Sharehistories');


        // $postdata = file_get_contents("php://input");

        // print_r($postdata);

        //  exit;   


        $response = array();

        $user = $this->Users->newEntity();


        if ($this->request->is('post')) {  

        if(empty($this->request->data['username'])){ 

            $response['status'] = false;
            $response['msg'] = "Username required"; 
        }else{    

        $user_check = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
        $user_check = $user_check->first();

         $username = $this->Users->find('all', ['conditions' => ['Users.username' => $this->request->data['username']]]);
        $username = $username->first();
        if (!empty($user_check)) {
            $response['status'] = false;
            $response['msg'] = "Email address already exists. Please try with another Email Address.";
        } elseif(!empty($username)){

            $response['status'] = false;
            $response['msg'] = "Username already exists. Please try with another username.";

        }else{

            $post = $this->request->getData();   

            $post['status'] = '0';
            $post['role'] = 'user';  

            $user = $this->Users->patchEntity($user, $post);

            $new_user = $this->Users->save($user);  

            if ($new_user) {

                   $shareexist = $this->Sharehistories->find('all',['conditions'=>['Sharehistories.friend_email'=>$user->email]]);

                   $shareexist = $shareexist->first();

                   if(!empty($shareexist)){ 
                      $this->Sharehistories->updateAll(array('friend_id' =>$new_user['id']), array('friend_email' => $user->email));
                   }

                    $burl = Router::fullbaseUrl();
                    $hash = md5(time() . rand(100000000, 999999999)); 
                    $url = Router::url(['controller' => 'users', 'action' => 'emailverify'. '/' . $user->id . '/' . $hash]);
                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default');   

                 $send = $email->from(['rupak@avainfotech.com' => 'Giftcard']) 
                        ->emailFormat('html')
                        ->template('invite')
                        ->to($user->email)
                        ->subject('Welcome to Giftcard')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))    
                        ->send();   



                 $response['status'] = true;
                 $response['msg'] = " Registration done successfully. We have sent a verification mail to your registered email address, Please verify your account. Please be patient, as it may take some time to reach your inbox.";
                 $response['data'] = '';
               
 
             }else {

                $response['status'] = false;
                $response['msg'] = "The user could not be saved. Please, try again.";

            }

        }
      

      }

        }

       
        echo json_encode($response);
        exit;

    }



    public function emailverify ($user_id = null,$token = null){ 

           if(!empty($user_id)){

             $useractive = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);
             
             $useractive = $useractive->first();
             if($useractive['status']==1){
               $this->Flash->success(__('Your account has been activated, go for login.'));    
              // return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
             }
             
             if($useractive['tokenhash'] ==  $token){   
             $this->Users->updateAll(array('tokenhash' =>' ','status'=>1), array('id' => $user_id));    
             $this->Flash->success(__('Your account has been activated, go for login.'));  
             // return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
             }else{ 
             $this->Flash->error(__('Token has been expired. Please, try again.'));        
             } 
               
           }
     }


    


    public function purchasevoice()

    {  

        $this->loadModel('Usertones');
        $response = array();
        if ($this->request->is('post')) {  

        if(empty($this->request->data['user_id'])){ 

            $response['status'] = false;
            $response['msg'] = "user_id required"; 
        }else{

        $savestatus = 0; 

        $post = $this->request->getData();  
        $voicecount = count($post['voice_id']);


        foreach ($post['voice_id'] as $key => $value) {

        $usertone = $this->Usertones->newEntity();            
       $exist = $this->Usertones->find('all', ['conditions' => ['Usertones.user_id' => $this->request->data['user_id'],'Usertones.tone_id'=>$value]]);
        $exist = $exist->first();

            if(empty($exist)){

            $savevalue['user_id'] = $this->request->data['user_id'];
            $savevalue['tone_id'] = $value;  

            $usertone = $this->Usertones->patchEntity($usertone, $savevalue);

            $new_tone = $this->Usertones->save($usertone);  
                
            }

            if($voicecount -1 == $key){
             $savestatus = 1 ;   
            }

              
           }   

          if($savestatus == 1){
            $response['status'] = true;
            $response['msg'] = "Successfully save";   
          } 

      }

        }

       
        echo json_encode($response);
        exit;

    }



    /**

     * Edit method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.

     * @throws \Cake\Network\Exception\NotFoundException When record not found.

     */

    public function edit()

    {


        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data; 

			if(empty($post['id'])){
				$response['status'] = false;
            	$response['msg'] = 'User id required.';
			}else{	

			$exit = $this->Users->find('all',['conditions'=>['Users.id'=>$post['id']]]);
			$exit = $exit->first();
			if ($exit) {			
    	
	        $user = $this->Users->get($post['id'], [

	            'contain' => []

	        ]);

             if(!empty($this->request->data['image'])) {

             $uniquename = time().uniqid(rand()).'.png';
             $upload_path = WWW_ROOT . 'images/users/' . $uniquename;
          
             $userimage = base64_decode($post['image']);
             $success = file_put_contents($upload_path, $userimage);
             $post['image']= $uniquename;
             
             }else{

               $post['image']= $user->image;  
             }

            $findbyemail = $this->Users->find('all',['conditions'=>['Users.email'=>$post['email']]]);
            $findbyemail = $findbyemail->first();
            if(empty($findbyemail)){

                  $user = $this->Users->patchEntity($user, $post);
                  $update = $this->Users->save($user);
                  if ($update) {
                        $response['status'] = true;
                        $response['msg'] = 'User data has been updated.';
                        $response['data'] = $update;

                    }else{
                        $response['status'] = false;
                        $response['msg'] = 'The user could not be saved. Please, try again.';
                       
                    }

            } else {

                if($post['id'] == $findbyemail['id']){
                    $user = $this->Users->patchEntity($user, $post);
                    $update = $this->Users->save($user);
                    if ($update) {
                        $response['status'] = true;
                        $response['msg'] = 'User data has been updated.';
                        $response['data'] = $update;

                    }else{
                        $response['status'] = false;
                        $response['msg'] = 'The user could not be saved. Please, try again.';
                       
                    }
                }else{
                    $response['status'] = false;
                    $response['msg'] = 'Email already exist.';
                }
           
            }


	       
            

	        }else{
	        	$response['status'] = false;
            	$response['msg'] = 'Invalid user id.';
	        }

           
			}	
        }

        echo json_encode($response);
        exit;
  

    }


    
     public function usersetting() { 

      $this->loadModel('Usersettings'); 
        if ($this->request->is('post')) { 

            if(empty($this->request->data['user_id'])){
                $response['status'] = false;
                $response['msg'] = 'User id required!.';    
            }else{

            $exist = $this->Usersettings->find('all',['conditions'=>['Usersettings.user_id'=>$this->request->data['user_id']]]);

             $exist = $exist->first();
            if($exist){

             foreach ($this->request->data['settingsdata'] as $key => $value) {

                 $this->Usersettings->updateAll(['value'=>"$value"],['key'=>$key,'user_id'=>$exist['user_id']]); 
   
                }

                $response['status'] = true;
                $response['msg'] = 'Settings updated!.';  

            }else{
                 
                 foreach ($this->request->data['settingsdata'] as $key => $value) {
                    $settings = $this->Usersettings->newEntity();
                    $post['key'] = $key;
                    $post['value'] = $value;
                    $post['user_id'] = $this->request->data['user_id'];   
                 $settings = $this->Usersettings->patchEntity($settings, $post);
                 $settingssave = $this->Usersettings->save($settings);
                 }

                $response['status'] = true;
                $response['msg'] = 'Settings save!.'; 

             }             

          

            }

        }

        echo json_encode($response);
        exit;
     }

	
 public function changepassword() {



        if ($this->request->is(['patch', 'post', 'put'])) {

        	$id = $this->request->data['id'];
			$exit = $this->Users->find('all',['conditions'=>['Users.id'=>$id]]);
			$exit = $exit->first();
			if ($exit) {	

	       		$user = $this->Users->get($exit['id'], [   
		            'contain' => []
		        ]);


            if ((new DefaultPasswordHasher)->check($this->request->data['oldpassword'], $user['password'])) {


                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {

                	$response['status'] = true;
            		$response['msg'] = 'Password Changed Successfully.';

                } else {

                	$response['status'] = false;
            		$response['msg'] = 'Invalid Password, Try again.';
                 
                }
            } else {


	            	$response['status'] = false;
	        		$response['msg'] = 'Old Password did not match.';
                
            }

	        }else{
	        	$response['status'] = false;
            	$response['msg'] = 'Invalid user id.';
	        }

		     
        }

        echo json_encode($response);
        exit;
    }



    public function forgot() {

        if ($this->request->is('post')) {

            $email = $this->request->data['email'];

            if(!empty($email)){

            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);

            $user = $user->first();

            $burl = Router::fullbaseUrl();

            if (empty($user)) {

            	$response['status'] = false;
            	$response['msg'] = 'Enter regsitered email address to reset you password.';
            } else {

                if ($user->email) {

                    $hash = md5(time() . rand(100000000, 999999999)); 

                    $url = Router::url(['controller' => 'users', 'action' => 'reset' . '/' . $hash]);



                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default'); 

                 $send = $email->from(['rupak@avainfotech.com' => 'Giftcard']) 
                        ->emailFormat('html')
                        ->template('forgot')
                        ->to($user->email)
                        ->subject('Reset Your Password')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))  
                        ->send();  
 


	            	$response['status'] = true;
	            	$response['msg'] = 'Check your email to reset your Password.';     
                   
                } else {
                	$response['status'] = false;
	            	$response['msg'] = 'Email Is Invalid.';  
                   
                }
            }
           }else{

           			$response['status'] = false;
	            	$response['msg'] = 'Please enter your register email address.';  
           
           } 
        }

        echo json_encode($response);
        exit;
    }


    public function reset($token) {

        $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);
        $data = $query->first();
        if ($data) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                if ($this->request->data['password1'] != $this->request->data['password']) {
                    $this->Flash->success(__('New password & confirm password does not match!'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
                $this->request->data['tokenhash'] = md5(time() . rand(100000000, 999999999)); 
                $user = $this->Users->get($data->id, [
                    'contain' => []
                ]);
                $user = $this->Users->patchEntity($user, $this->request->getData());  

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your password has been changed'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                } else {
                    $this->Flash->success(__('Invalid Password, try again'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
            }
        } else {
            $this->Flash->success(__('Invalid Token, Try Again'));
            return;
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }
        




}


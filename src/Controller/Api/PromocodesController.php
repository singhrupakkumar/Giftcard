<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;

header("Access-Control-Allow-Origin: *");

/**
 * Promocodes Controller
 *
 * @property \App\Model\Table\PromocodesTable $Promocodes
 *
 * @method \App\Model\Entity\Review[] paginate($object = null, array $settings = [])
 */
class PromocodesController extends AppController
{
    
    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');

        }

        $this->Auth->allow();

        $this->authcontent();

    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $promocodes = $this->Promocodes->find('all', [
                'order'     =>  ['Promocodes.id' => 'desc']
        ]);
    
        $promocodes = $promocodes->all()->toArray();    
  
  
        $this->set(compact('promocodes'));

    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promocodes = $this->Promocodes->get($id);

        $this->set('promocodes', $promocodes);
        $this->set('_serialize', ['promocodes']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promocode = $this->Promocodes->newEntity();
        if ($this->request->is('post')) {


           $exist = $this->Promocodes->find('all',array('conditions'=>array('Promocodes.promocode'=>$this->request->data['promocode'])));

           $exist = $exist->first();
           
            if($exist['id']){
                $this->Flash->error(__('Promocode already taken. Please add Unique Entry!'));
            }else{

      

            $date1 = date_create($this->request->data['expired']);
  
            $eexpired =  date_format($date1, 'Y-m-d H:i:s');

            $this->request->data['expired'] =  $eexpired; 

            $promocode = $this->Promocodes->patchEntity($promocode, $this->request->getData());
            if ($this->Promocodes->save($promocode)) {
                $this->Flash->success(__('The promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
             $this->Flash->error(__('The promocode could not be saved. Please, try again.'));    
            }


             } 

           
        }
    
        $this->set(compact('promocode'));
        $this->set('_serialize', ['promocode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $promocode = $this->Promocodes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
                
            $date1 = date_create($this->request->data['expired']);
  
            $eexpired =  date_format($date1, 'Y-m-d H:i:s');

            $this->request->data['expired'] =  $eexpired;  


            $promocode = $this->Promocodes->patchEntity($promocode, $this->request->getData());
            if ($this->Promocodes->save($promocode)) {
                $this->Flash->success(__('The promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promocode could not be saved. Please, try again.'));
        }
 
        $this->set(compact('promocode'));
        $this->set('_serialize', ['promocode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $promocode = $this->Promocodes->get($id);
        if ($this->Promocodes->delete($promocode)) {
            $this->Flash->success(__('The promocode has been deleted.'));
        } else {
            $this->Flash->error(__('The promocode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
 
}

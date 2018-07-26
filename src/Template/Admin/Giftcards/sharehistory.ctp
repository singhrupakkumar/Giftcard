<section class="content-header">
    <h1>
    <?= __('Share History') ?> 
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('Share History') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Card Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Card Owner') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Share To') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Share Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Share Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                 <?php foreach ($sharehistories as $history): ?>
            <tr>

                <td><?= h($history['giftcard']['name']) ?></td>
                <td><?= h($history['giftcard']['user']['fname']." ".$history['giftcard']['user']['lname']) ?></td>
                <td><?= h($history['friend_name']) ?></td>
                <td><?= h($history['friend_email']) ?></td>
                <td><?= h($history->created) ?></td>
                <td class="actions">
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'shareview', $history->id],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>  

                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>  
    </div>
</section>    

<style>

.delt { margin-left:20px;} 


</style>


<script type="text/javascript">

    
         
 $(document).ready(function() {

  $('#charitytable1').DataTable( {
   "order": [[ 3, "desc" ]]

    });


   } );  
</script>   
<section class="content-header">
    <h1>
    Promocodes <?= $this->Html->link(__('Add Promocodes'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Promocodes</li>
    </ol>
</section>
<?php //print_r($trainers); ?>
<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?= $this->Flash->render() ?>
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body"> 
              <table id="promocodestable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Promocode</th>
                  <th>Discount</th>
                  <th>Expired</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($promocodes as $promocode): ?>
                <tr>
                  <td><?php echo $promocode['id']; ?></td>
                  <td><?php echo $promocode['promocode']; ?> </td>
                  <td><?php echo $promocode['discount']; ?></td>
                
                   <td>
                  <?php echo $promocode['expired']; ?>
                  </td>
                  <td><?php echo $promocode['created']; ?></td>
                 
                  <td>
                    <?= $this->Html->link(  
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View Promocode') . '</span>',
                        ['action' => 'view', $promocode['id']],
                        ['escape' => false, 'title' => __('View Promocode'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $promocode->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promocode->id),'class' => 'btn btn-danger btn-xs']) ?>
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
<script type="text/javascript">

    $(document).ready(function() {   
  $('#promocodestable').DataTable( {
   "order": [[ 3, "desc" ]]
    } );

   } );

</script>
 
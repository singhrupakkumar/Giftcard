<section class="content-header">
    <h1>
    <?= __('Charities') ?>   <?= $this->Html->link(__('Add Charity'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('Charities') ?></li>
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
              <table id="charitytable" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                 <?php foreach ($Charities as $charaty): ?>
            <tr>
                <td><?= $this->Number->format($charaty->id) ?></td>
                <td><?= h($charaty->name) ?></td>
                <td><?php echo $this->Html->Image('/images/charities/' . $charaty->image, array('width' => 100, 'height' => 100, 'alt' =>$charaty->name, 'class' => 'image')); ?></td>
                <td><?= h($charaty->created) ?></td>
                <td class="actions">
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $charaty->id],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>  
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $charaty->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                  
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $charaty->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charaty->id),'class' => 'btn btn-danger btn-xs delt']) ?>
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

  $('#charitytable').DataTable( {
   "order": [[ 3, "desc" ]]

    });


   } );  
</script>   
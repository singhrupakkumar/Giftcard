<section class="content-header">
    <h1> 
    <?= __('Store Locations') ?>   <?= $this->Html->link(__('Add Location'), ['action' => 'locationadd/'.$store_id], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li> 
        <li class="active"><?= __('Store Locatios') ?></li>
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
               
                <th scope="col"><?= $this->Paginator->sort('Location Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                <?php foreach ($storelocations as $store): ?>
            <tr>
                
                <td><?= h($store->location_name) ?></td>
                <td><?= h($store->lat) ?></td>
                <td><?= h($store->long) ?></td>
             
                <td><?= h($store->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'locationedit', $store->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                  
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'locationdelete', $store->id,$store->store_id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id),'class' => 'btn btn-danger btn-xs']) ?>
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
<section class="content-header">
    <h1>
    <?= __('Subscriptions') ?> 
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('Subscriptions') ?></li>
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
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pay amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expired date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                 <?php foreach ($subscriptions as $plan): ?>
            <tr>
                
                <td><?= h($plan->user->fname." ".$plan->user->lname) ?></td>
                <td><?= h($plan->payamount) ?></td>
                <td><?= h($plan->created) ?></td>
                <td><?= h($plan->expired_date) ?></td>
                <td class="actions">
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $plan->id],
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

<section class="content-header">
    <h1>
    <?= __('Tones') ?>   
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('Tones') ?></li>
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
                <th scope="col"><?= $this->Paginator->sort('file') ?></th>

            </tr>
            </thead>
                <tbody>
                 <?php foreach ($tones as $list): ?>
            <tr>
      
                <td><?= h($list->name) ?></td>
                <td>
                    <audio controls>
                      <source src="<?php echo $list->file; ?>" type="audio/ogg">
                      <source src="<?php echo $list->file; ?>" type="audio/mpeg">
                      Your browser does not support the audio tag.
                    </audio>
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
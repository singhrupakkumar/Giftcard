<section class="content-header">
    <h1>
   <?= __('Promocode') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Add Promocode') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
     <?= $this->Flash->render() ?>
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Promocode') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($promocode, ['id' => 'promocode-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Promocode</label>
                  <?php echo $this->Form->control('promocode', ['class' => 'form-control', 'label' => false]); ?>
                </div> 
                  <?php echo $this->Form->control('discount',['class' => 'form-control','label'=>'Discount in percentage','type'=>'number','min'=>1]);?>      
                  <?php echo $this->Form->control('expired',['label'=>'Expiry Date/Time','type'=>'text','class' => 'form-control']);?>    
               
              <div class="form-group">
                 <label for="exampleInputEmail1">Status</label>
              <?php echo $this->Form->select('status', [
                     '1' => 'Active',
                    '0' => 'Deactive'
                ],['label' => 'Status','class' => 'form-control']);
                ?>  
                </div>
                
            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

<script>
 $('#expired').datetimepicker({
 minDate: new Date(),   
inline:true,
});

</script>    
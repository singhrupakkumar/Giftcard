<section class="content-header">
    <h1>
   <?= __('Charity') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?></a></li>
        <li class="active"><?= __('Add Charity') ?></li>
    </ol>
</section>

<section class="content"> 
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Giftcard') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($giftcard, ['id' => 'giftcard-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label> 
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div> 
                 <div class="form-group">
                  <?php echo $this->Form->control('store_id', ['class' => 'form-control', 'label' => 'Store']); ?>
                </div>
                 <?php echo $this->Form->control('category_id', ['class' => 'form-control', 'label' => 'Category']); ?>
                <?php echo $this->Form->control('card_code', ['class' => 'form-control', 'label' => 'Card Code']); ?>
                <?php echo $this->Form->control('address', ['class' => 'form-control', 'label' => 'Address']); ?>
                <?php echo $this->Form->control('card_value', ['class' => 'form-control', 'label' => 'Card value']); ?>
                <?php echo $this->Form->control('card_type', ['class' => 'form-control', 'label' => 'Card type']); ?>
               

                 <div class="form-group">
                  <label>Expiration</label>
                   <?php echo $this->Form->control('expiration', ['class' => 'form-control', 'label' => false]); ?>
                </div>
              
                 <div class="form-group">
                  <label>Reminder</label>
                 <?php echo $this->Form->checkbox('reminder', ['type'=>'checkbox']); ?>
                </div>
                <div class="form-group">
                   <label>Notify giver</label>
                <?php echo $this->Form->checkbox('notify_giver', ['type'=>'checkbox']); ?>
               </div>

                 
                 <?php echo $this->Form->control('giver_name', ['class' => 'form-control', 'label' => 'Giver name']); ?>
                  <?php echo $this->Form->control('giver_contact', ['class' => 'form-control', 'label' => 'Giver contact']); ?> 
                  <?php echo $this->Form->control('image',['class' => 'form-control','type'=>'file']);?>
              </div>
              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 
     


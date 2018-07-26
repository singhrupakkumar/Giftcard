<section class="content-header">
    <h1>
   <?= __('Store Location') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Edit Location') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Edit Location') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($storelocation, ['id' => 'location-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                <?php echo $this->Form->control('location_name', ['class' => 'form-control', 'label' => 'Address']); ?>
                 <?php echo $this->Form->control('lat', ['class' => 'form-control', 'id' => 'lat','type'=>'hidden']); ?>

                 <?php echo $this->Form->control('long', ['class' => 'form-control', 'id' => 'long','type'=>'hidden']); ?>
                  
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

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script>

/****************Lat Long***********************/


    $("#location-name").on('change',function(){ 

        $.post("<?php echo $this->request->webroot; ?>admin/stores/LatLongFromAddress",
        {
            address: $(this).val()
        },
        function(data, status){

            if(status=='success'){
                var res = JSON.parse(data);
                $('#lat').val(res.latitude);
        		$('#long').val(res.longitude);
                //displayMap(res.latitude,res.longitude)
            }
            
        });
    });
</script>      
  
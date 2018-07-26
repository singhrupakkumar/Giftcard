<section class="content-header">
    <h1>
   <?php echo $promocodes['promocode']; ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"> <?= h($promocodes['promocode']) ?> </h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">  
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($promocodes->id) ?></td>
        </tr>
        <tr>
          <th><?= __('Discount Percentage') ?></th>
          <td><?= h($promocodes->discount) ?> %</td>
        </tr>
        <tr>
          <th><?= __('Expired') ?></th>
          <td>
       <?= h($promocodes->expired) ?>
          </td>
        </tr>
      
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       
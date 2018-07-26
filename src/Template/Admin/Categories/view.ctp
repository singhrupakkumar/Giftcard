<section class="content-header">
    <h1>
    <?= __('Category') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('View') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12"> 
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($category->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h(strip_tags($category->description)) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?=  $this->Number->format($category->id) ?></td>
        </tr>
  
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
   
   
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
            
            
    </div>
</section>       
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
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($subscriptions->user->fname." ".$subscriptions->user->lname) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriptions->user->fname." ".$subscriptions->user->lname) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($subscriptions->user->email) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Pay amount') ?></th>
            <td>$<?= h($subscriptions->payamount) ?></td>
        </tr>
  
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($subscriptions->created) ?></td>
        </tr>
        
         <tr>
            <th scope="row"><?= __('Expired Date') ?></th>
            <td><?= h($subscriptions->expired_date) ?></td>
        </tr>
 
   
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
            
            
    </div>
</section>       
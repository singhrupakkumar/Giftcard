<section class="content-header">
    <h1>
    <?= __('Share History') ?>
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
    <h3 class="box-title"><?= h($giftcard['giftcard']['name']) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Card Name') ?></th>
            <td><?= h($giftcard['giftcard']['name']) ?></td>
        </tr>
 
        <tr>
            <th scope="row"><?= __('Card value') ?></th>
            <td>$<?=  $this->Number->format($giftcard['giftcard']['card_value']) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Card Owner') ?></th> 
            <td><?=  h($giftcard['giftcard']['user']['fname']." ".$giftcard['giftcard']['user']['lname']) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Share To') ?></th> 
            <td><?=  h($giftcard['friend_name']) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Share email') ?></th> 
            <td><?=  h($giftcard['friend_email']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Share Date') ?></th>
            <td><?= h($giftcard->created) ?></td>
        </tr>
  
   
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
            
            
    </div>
</section>       
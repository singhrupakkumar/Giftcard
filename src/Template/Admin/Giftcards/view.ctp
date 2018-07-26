<section class="content-header">
    <h1>
    <?= __('Giftcard') ?>
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
    <h3 class="box-title"><?= h($giftcard->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($giftcard->name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Card code') ?></th>
            <td><?= h($giftcard->card_code) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?=  h($giftcard->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Card value') ?></th>
            <td>$<?=  $this->Number->format($giftcard->card_value) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Card type') ?></th> 
            <td><?=  h($giftcard->card_type) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Category') ?></th> 
            <td><?=  h($giftcard->category) ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Notify giver') ?></th> 
            <td><?=  h($giftcard->notify_giver) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Reminder') ?></th> 
            <td><?=  h($giftcard->reminder) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Giver name') ?></th> 
            <td><?=  h($giftcard->giver_name) ?></td>
        </tr>

         <tr>
            <th scope="row"><?= __('Giver contact') ?></th> 
            <td><?=  $this->Number->format($giftcard->giver_contact) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Expiration') ?></th> 
            <td><?=  h($giftcard->expiration) ?></td>
        </tr>

  
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($giftcard->created) ?></td>
        </tr>
        <tr>
          <th><?= __('Image') ?></th>
          <td>
            <?php if($giftcard->image != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/giftcards/<?php echo $giftcard->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/categories/no-image.jpg" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
   
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
            
            
    </div>
</section>       
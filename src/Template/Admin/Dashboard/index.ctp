<section class="content-header">
    <h1>
    Dashboard
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
	<div class="row">
    
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
                <a href="<?php echo $this->request->webroot; ?>admin/users">  
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  
                    <span class="info-box-text">All Users</span>
                    <span class="info-box-number"><?php echo count($users); ?><small></small></span> 
                </div>
              </a>  
            </div>
        </div>

        
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
                <a href="<?php echo $this->request->webroot; ?>admin/stores">  
                <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stores</span>
                    <span class="info-box-number"><?php echo count($stores); ?></span>
                </div>
              </a>  
            </div>
        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
                <a href="<?php echo $this->request->webroot; ?>admin/giftcard">  
                <span class="info-box-icon bg-red"><i class="fa fa-gift"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Giftcards</span>
                    <span class="info-box-number"><?php echo count($giftcard); ?></span>
                </div>
              </a>  
            </div>
        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
                <a href="<?php echo $this->request->webroot; ?>admin/charities">  
                <span class="info-box-icon bg-orange"><i class="fa fa-university"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Charity</span> 
                    <span class="info-box-number"><?php echo count($charity); ?></span>
                </div>
              </a>  
            </div>
        </div>
        

    
    
    </div>
    
    <div class="row">
    	<div class="col-md-6">
        
            <div class="box box-danger">
                <div class="box-header with-border">
                	<h3 class="box-title">Latest Members</h3>
                </div>
                
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                    
                    	<?php foreach($members as $member){ ?>
                        <li>
                        	<?php if($member['image'] != ''){ ?>
                            <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['fname']." ".$member['lname']; ?>" style="height: 112px;">
                            <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/users/noimage.png" alt="User Image">
                            <?php } ?>
                            <a class="users-list-name" href="#"><?php echo ucwords($member['fname']." ".$member['lname']); ?></a>
                            <span class="users-list-date"><?php echo date('d M', strtotime($member['created'])); ?></span>
                        </li>
                    	<?php } ?>
                        
                    </ul>
                </div>
                
                <div class="box-footer text-center">
                <?php echo $this->Html->link('View All Users', ['controller' => 'users', 'action' => 'index'], ['class' => 'uppercase']); ?>
                </div>
            </div>
    
    	</div>


        <div class="col-md-6">
      
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Giftcard Category</h3>
                </div>
                
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                    
                        <?php foreach($topcategory as $member){ ?>
                        <li>
                            <a class="users-list-name" href="#"><?php echo ucwords($member['name']); ?></a>
                            <span class="users-list-date"><?php echo date('d M', strtotime($member['created'])); ?></span>
                        </li>
                        <?php } ?> 
                        
                    </ul>
                </div>
                
                <div class="box-footer text-center">
                <?php echo $this->Html->link('View All Category', ['controller' => 'categories', 'action' => 'index'], ['class' => 'uppercase']); ?>
                </div>
            </div>
       
        </div>
      
    </div>
     


     <!--div class="row">
        <div class="col-md-6">
        
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest 5 Subscribed Users</h3>
                </div>
                
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                    
                        <?php foreach($topsubscribeduser as $member){ ?>
                        <li>
                            <?php if($member['user']['image'] != ''){ ?>
                            <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['user']['name']; ?>" style="height: 112px;">
                            <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/users/noimage.png" alt="User Image">
                            <?php } ?>
                            <a class="users-list-name" href="#"><?php echo ucwords($member['user']['fname']); ?> <?php echo ucwords($member['user']['lname']); ?></a>
                            <span class="users-list-date"><?php echo date('d M', strtotime($member['created'])); ?></span>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </div>
                
                <div class="box-footer text-center">
                <?php echo $this->Html->link('View All Users', ['controller' => 'users', 'action' => 'index'], ['class' => 'uppercase']); ?>
                </div>
            </div>
       
        </div>   

    </div-->
</section> 
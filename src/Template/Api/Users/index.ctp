<h3><strong>All Api Url</strong></h3>

<h4><strong>Base Url : </strong><?= $baseurl; ?></h4>

<div style="clear:both">

	<?php $i=1;

	foreach($indexarr as $value){ 

		echo '<h4><strong>['.$i.']. '.$value['description'].'</strong></h4>';

		echo $value['url'].'<br>';

		echo '<i><b>Parameters</b><br>'.$value['parameters'].'</i><br><br>';

		$i++;

	}

	?>

</div>
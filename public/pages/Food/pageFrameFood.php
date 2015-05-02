<?php
	$foodList = SessionHandlers::getObjSession("foodList");
	//SessionHandlers::destroySession('foodList');
?>
				
<table class="table table-th-block table-dark">
	<thead>
		<tr>
			<th style="width: 100px"><?php i18n::getLabel("food.id");?></th>
			<th><?php i18n::getLabel("food.image");?></th>
			<th><?php i18n::getLabel("food.name");?></th>
			<th><?php i18n::getLabel("food.price");?></th>
			<th><?php i18n::getLabel("food.type");?></th>
			<th><?php i18n::getLabel("food.counttype");?></th>
		</tr>
	</thead>
	<tbody>
<?php for($i=0;$i<sizeof($foodList);$i++)
	{ $food = $foodList[$i];
	?>
		<tr>
			<td><?php echo $food->getId();?></td>
			<td><img src="<?php echo Tool::getURIFileUploadImage($food->getThumbnail());?>" style="width: 100px;" alt="Image"></td>
			<td><strong><?php echo $food->getName();?></strong></td>
			<td><strong class="text-danger">&#36; <?php echo $food->getPrice();?></strong></td>
			<td><?php echo $food->getFoodTypeId();?></td>
			<td class="text-left"><?php echo $food->getStatus();?></td>
		</tr>
<?php }?>
	</tbody>
</table>
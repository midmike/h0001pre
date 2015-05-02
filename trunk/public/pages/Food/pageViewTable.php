<div class="container-fluid">
	<!-- Begin page heading -->
	<h1 class="page-heading"><?php i18n::getLabel("message.user.managefood.title");?></h1>
	<!-- End page heading -->
	<form role="form" id="myform" method="Post">
		<!-- Begin Button -->
		<div class="the-box rounded">
			<div class="the-box rounded form-group">
				
				<div class="col-xs-12 col-md-2">
					<a href="javascript:void(0);open('myform','<?php echo CREATE?>','controls/FoodControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-plus"></i><?php i18n::getLabel("message.user.manageuser.button.new");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-2">
					<a href="javascript:void(0);open('myform','<?php echo EDIT?>','controls/FoodControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-pencil"></i><?php i18n::getLabel("message.user.manageuser.button.edit");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-3">
					<a href="javascript:void(0);open('myform','<?php echo SHOWHIDE?>','controls/FoodControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-eye"></i><?php i18n::getLabel("message.user.manageuser.button.show");?>
					</a>
				</div>
				<a href="javascript:void(0);open('myform','<?php echo REFRESH?>','controls/FoodControl.php');"
					class="btn"><i class="fa fa-refresh"></i></a>
			</div>

			<!-- End Button -->
			<!-- Pop up -->
			<div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
			</div>
			<!-- End Pop up -->
			<input type="hidden" name="cache_val"
				value="<?php User::CACHE_SHOW?>" />
			<!-- BEGIN DATA TABLE -->
			<div class="the-box">
				<iframe src="controls/FoodControl.php?<?php echo PAGE."=".FRAME;?>" height="800px"></iframe>
			</div>
			<!-- /.the-box .default -->
			<!-- END DATA TABLE -->
		</div>
	</form>
</div>
<!-- /.container-fluid -->

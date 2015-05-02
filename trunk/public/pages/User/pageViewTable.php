<script src="assets/js/jquery.min.js"></script>
<?php require_once 'assets/js/datatable.php';?>
<script type="text/javascript">
	$(document).ready(function(){
        <?php
        	$cache = BaseModel::CACHE_SHOW;
        	if (Tool::isNotAndNotEmpty($_GET,"cache")) {
        		$cache = $_GET ["cache"];
        	} else {
        		$cache = 0;
        	}
        ?>
		datatable("helper/datatable/ManageUserDataTable.php?cache=<?php echo $cache;?>");
	});
</script>
<div class="container-fluid">
	<!-- Begin page heading -->
	<h1 class="page-heading"><?php i18n::getLabel("message.user.manageuser.title");?></h1>
	<!-- End page heading -->
	<form role="form" id="user_datatable_form" method="Post">
		<!-- Begin Button -->
		<div class="the-box rounded">
			<div class="the-box rounded form-group">
				<div class="col-xs-12 col-md-2">
					<a href="javascript:void(0);open('user_datatable_form','<?php echo CREATE?>','controls/UserControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-plus"></i><?php i18n::getLabel("message.user.manageuser.button.new");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-2">
					<a href="javascript:void(0);open('user_datatable_form','<?php echo EDIT?>','controls/UserControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-pencil"></i><?php i18n::getLabel("message.user.manageuser.button.edit");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-3">
					<a href="javascript:void(0);open('user_datatable_form','<?php echo SHOWHIDE?>','controls/UserControl.php');"
						class="btn btn-success btn-rounded-lg col-md-12 col-xs-12"> <i
						class="fa fa-eye"></i><?php i18n::getLabel("message.user.manageuser.button.show");?>
					</a>
				</div>
				<a href="javascript:void(0);open('user_datatable_form','<?php echo REFRESH?>','controls/UserControl.php');"
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
				<div class="table-responsive">
					<table
						class="table table-th-block table-success table-striped table-hover"
						data-click-to-select="true" id="datatable-user">
						<thead class="the-box dark full">
							<tr>
								<th width="3px"></th>
								<th><?php i18n::getLabel("message.user.register.fullname");?></th>
								<th><?php i18n::getLabel("message.user.manageuser.table.status");?></th>
								<th><?php i18n::getLabel("message.user.register.address");?></th>
								<th><?php i18n::getLabel("message.user.register.phone");?></th>
								<th><?php i18n::getLabel("message.user.manageuser.table.username");?></th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.the-box .default -->
			<!-- END DATA TABLE -->
		</div>
	</form>
</div>
<!-- /.container-fluid -->

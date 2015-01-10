<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		datatable();
	});
	function datatable() {
		if ($('#datatable-user').length > 0){
			$('#datatable-user').dataTable( {
				"bAutoWidth": false,
				"language": {
		            "lengthMenu": "<?php i18n::getLabel("message.user.manageuser.lengthmenu.0");?> _MENU_ <?php i18n::getLabel("message.user.manageuser.lengthmenu.1");?>",
		            "zeroRecords": "<?php i18n::getLabel("message.user.manageuser.zerorecords");?>",
		            "info": "<?php i18n::getLabel("message.user.manageuser.info.0");?> _PAGE_ <?php i18n::getLabel("message.user.manageuser.info.1");?> _PAGES_",
		            "infoEmpty": "<?php i18n::getLabel("message.user.manageuser.zerorecords");?>",
		            "infoFiltered": "(filtered from _MAX_ total records)",
		            "search": "<?php i18n::getLabel("message.user.manageuser.search");?>",
		            "paginate": {
		                "first": "<<",
		                "last": ">>",
		                "next" : ">",
		                "previous" : "<"
		            }
		        },
				"processing": true,
				"columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ],
		        "order": [[ 1, 'asc' ]],
		        "serverSide": true,
		        "ajax": {
			        <?php
			        	$cache = User::CACHE_SHOW;
			        	if (isset ( $_GET ["cache"] ) && ! empty ( $_GET ["cache"] )) {
			        		$cache = $_GET ["cache"];
			        	}
			        ?>
			        "url" : "helper/datatable/ManageUserDataTable.php?cache=<?php echo $cache;?>",
			        "type" : "POST"
		        },
		        "ordering": true,
                "bScrollCollapse": true,
			});
		}
	}
	function getCache() {
		var myform = document.getElementById ('user_datatable_form');
		return myform['cache_val'].value;
	}
	function open(formname) {
		var myform = document.getElementById ('user_datatable_form');
		myform.action = "controls/UserControl.php?<?php echo PAGE;?>=" + formname;
		if(formname === '<?php echo EDIT?>') {
			myform.action = myform.action + "&id=" + $('input[name="id"]:checked').val();
		} else if(formname === '<?php echo SHOWHIDE?>') {
			myform.action = myform.action + "&cache=<?php echo User::CACHE_HIDE?>";
		}
		myform.submit();
	}
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
					<a href="javascript:void(0);open('<?php echo CREATE?>');" class="btn btn-success btn-rounded-lg col-md-12 col-xs-12">
						<i class="fa fa-plus"></i><?php i18n::getLabel("message.user.manageuser.button.new");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-2">
					<a href="javascript:void(0);open('<?php echo EDIT?>');" class="btn btn-success btn-rounded-lg col-md-12 col-xs-12">
						<i class="fa fa-pencil"></i><?php i18n::getLabel("message.user.manageuser.button.edit");?>
					</a>
				</div>
				<div class="col-xs-12 col-md-3">
					<a href="javascript:void(0);open('<?php echo SHOWHIDE?>');" class="btn btn-success btn-rounded-lg col-md-12 col-xs-12">
						<i class="fa fa-eye"></i><?php i18n::getLabel("message.user.manageuser.button.show");?>
					</a>
				</div>
				<a href="javascript:void(0);open('<?php echo REFRESH?>');" class="btn" ><i class="fa fa-refresh"></i></a>
			</div>
		
			<!-- End Button -->
			<!-- Pop up -->
			<div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
			</div>
			<!-- End Pop up -->
			<input type="hidden" name="cache_val" value="<?php User::CACHE_SHOW?>"/>
			<!-- BEGIN DATA TABLE -->
			<div class="the-box">
				<div class="table-responsive">
				<table class="table table-th-block table-success table-striped table-hover" data-click-to-select="true" id="datatable-user">
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
				</div><!-- /.table-responsive -->
			</div><!-- /.the-box .default -->
			<!-- END DATA TABLE -->
		</div>
	</form>
</div><!-- /.container-fluid -->

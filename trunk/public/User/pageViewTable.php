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
		        "ajax": "helper/datatable/ManageUserDataTable.php",
		        "ordering": true,
                "bScrollCollapse": true,
                "bFilter": false
			});
		}
	}
	function open(formname) {
		var myform = document.getElementById ('user_datatable_form');
		myform.action = "#";
		alert(myform);
	}
</script>
<div class="container-fluid">
	<!-- Begin page heading -->
	<h1 class="page-heading"><?php i18n::getLabel("message.user.manageuser.title");?></h1>
	<!-- End page heading -->
	<form role="form" id="user_datatable_form" action="#">
		<!-- Begin Button -->
		<div class="the-box rounded inline-popups">
			<a href="#text-popup-html" data-effect="mfp-zoom-in" class="btn btn-success btn-rounded-lg btn-sm" ><i class="fa fa-plus"></i><?php i18n::getLabel("message.user.manageuser.button.new");?></a>
			<!--  <a href="javascript:void(0);open(1);" class="btn btn-success btn-rounded-lg btn-sm" ><i class="fa fa-plus"></i><?php i18n::getLabel("message.user.manageuser.button.new");?></a>-->
			<a href="javascript:void(0);open(2);" class="btn btn-success btn-rounded-lg btn-sm" ><i class="fa fa-pencil"></i><?php i18n::getLabel("message.user.manageuser.button.edit");?></a>
			<a href="javascript:void(0);open(3);" class="btn btn-success btn-rounded-lg btn-sm" ><i class="fa fa-eye"></i><?php i18n::getLabel("message.user.manageuser.button.show");?></a>
		</div>
		<!-- End Button -->
		<!-- Pop up -->
		<div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
		</div>
		<!-- End Pop up -->
		
		<!-- BEGIN DATA TABLE -->
		<div class="the-box rounded no-border">
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
	</form>
</div><!-- /.container-fluid -->

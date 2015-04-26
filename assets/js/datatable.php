<script type="text/javascript">
function datatable(urlTableManager) {
	if ($('#datatable-user').length > 0){
		$('#datatable-user').DataTable( {
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
		        "url" : urlTableManager,
		        "type" : "POST"
	        },
	        "ordering": true,
            "bScrollCollapse": true,
		});
	}
}
</script>
<?php
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/DT_bootstrap.js');
?>
<div class="panel panel-white">
	<div class="panel-body">
		<div>	
			<table class="table table-striped table-bordered table-hover directoryTable">
				<thead>
					<tr>
						<th>Event</th>
						<th>Email</th>
						<th>Reason</th>
						<th>Description</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php 
					foreach ($mailErrors as $id => $mailError) {
					?>
						<tr id="<?php echo 'mailError'.$id?>">
							<td class="mailErrorLine">
								<a href=""><i class="fa fa-envelope fa-2x"></i> <?php echo $mailError->event ?></a>
							</td>
							<td class="mailErrorLine">
								<a href=""><?php echo $mailError->recipient ?></a>
							</td>
							<td class="mailErrorLine">
								<a href=""><?php echo $mailError->reason ?></a>
							</td>
							<td class="mailErrorLine">
								<a href=""><?php echo $mailError->description ?></a>
							</td>
							<td class="mailErrorLine">
								<a href=""><?php echo date("d-m-Y H:i:s", $mailError->timestamp) ?></a>
							</td>
							<td class="center">
								<div class="btn-group">
									<a href="#" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm"><i class="fa fa-cog"></i> <span class="caret"></span></a>
									<ul class="dropdown-menu pull-right dropdown-dark" role="menu">
										<li>
											<a href="javascript:;" data-type="person" data-id="<?php echo $mailError->id ?>" class="margin-right-5 deleteThisUserBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Delete this user </a></li>
									</ul>
								</div>
							</td>							
						</tr>
					<?php } ?>
				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	bindAdminBtnEvents();
	resetDirectoryTable();
});	

var directoryTable = null;

function resetDirectoryTable() { 
	mylog.log("resetDirectoryTable");

	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});
	} 
	else 
	{
		if( $(".directoryLines").children('tr').length > 0 )
		{
			directoryTable.dataTable().fnDestroy();
			directoryTable.dataTable().fnDraw();
		} else {
			mylog.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}


function bindAdminBtnEvents(){
	mylog.log("bindAdminBtnEvents");
	
	<?php 
	/* **************************************
	* ADMIN STUFF
	***************************************** */
	if( Yii::app()->session["userIsAdmin"] ) {?>		

		$(".deleteThisUserBtn").off().on("click",function () 
		{
			mylog.log("deleteThisUserBtn click");
	        $(this).empty().html('<i class="fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var type = $(this).data("type");
	        var urlToSend = baseUrl+"/"+moduleId+"/admin/delete/type/"+type+"/id/"+id;
	        
	        bootbox.confirm("confirm please !!",
        	function(result) 
        	{
				if (!result) {
					btnClick.empty().html('<i class="fa fa-thumbs-down"></i>');
					return;
				} else {
					$.ajax({
				        type: "POST",
				        url: urlToSend,
				        dataType : "json"
				    })
				    .done(function (data) {
				        if ( data && data.result ) {
				        	toastr.info("User has been deleted");
				        	$("#"+type+id).remove();
				        	//window.location.href = "";
				        } else {
				           toastr.error("something went wrong!! please try again.");
				        }
				    });
				}
			});

		});
	
	<?php } ?>
}

function changeButtonName(button, action) {
	mylog.log(action);
	var icon = '<span class="fa-stack"> <i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span>';
	if (action=="addBetaTester") {
		button.removeClass("addBetaTesterBtn");
		button.addClass("revokeBetaTesterBtn");
		button.html(icon+" Revoke this beta tester");
	} else if (action=="revokeBetaTester") {
		button.removeClass("revokeBetaTesterBtn");
		button.addClass("addBetaTesterBtn");
		button.html(icon+" Add this beta tester");
	} else if (action=="addSuperAdmin") {
		button.removeClass("addSuperAdminBtn");
		button.addClass("revokeSuperAdminBtn");
		button.html(icon+" Revoke this super admin");
	} else if (action=="revokeSuperAdmin") {
		button.removeClass("revokeSuperAdminBtn");
		button.addClass("addSuperAdminBtn");
		button.html(icon+" Add this super admin");
	} else {
		mylog.warn("Unknown action !");
	}
}

</script>
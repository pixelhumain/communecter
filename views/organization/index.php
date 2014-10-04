<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/jquery.dataTables.min.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Liste d'organization</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="sample_2">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>contact</th>
								<th>Tags</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($groups as $e) {
							?>
							<tr>
								<td><a href="<?php echo Yii::app()->createUrl('association/view/id/'.$e["_id"])?>"><?php echo $e["name"]?></a></td>
								<td><?php if(isset($e["type"]))echo $e["type"]?></td>
								<td><?php if(isset($e["email"]))echo $e["email"]?></td>
								<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script type="text/javascript">
jQuery(document).ready(function() {
	if($(".tooltips").length) {
		$('.tooltips').tooltip();
	}
initDataTable();

	<?php 
if(Citoyen::isAdminUser()){
?>
	  $(document).on('touchstart click', '.delBtn', function(event){
		  //console.log(this.hash.substr(1));
		  if(confirm("t'es sur de ton coup ?")){
		  event.preventDefault();
		  toggleSpinner();
		  $( "."+this.hash.substr(1) ).remove();
		  $.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/association/delete",
	    	  data: {"id":this.hash.substr(1)},
	    	  success: function(data){
	    			  $("#flashInfo .modal-body").html(data.msg);
	    			  toggleSpinner();
	    		  	  $("#flashInfo").modal('show');
	    		  	  window.location.reload();
	    	  },
	    	  dataType: "json"
	    	});
		  }
	  });
<?php } ?>
});

var initDataTable = function() {
		var oTable = $('#sample_2').dataTable({
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
		$('#sample_2_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#sample_2_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#sample_2_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#sample_2_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
		});
	};

</script>			
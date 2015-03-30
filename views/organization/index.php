
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
					<table class="table table-striped table-hover" id="organizationTable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Tags</th>
								<th>PostalCode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($organizations as $e) {
							?>
							<tr>
								<td><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/view/id/'.$e["_id"])?>"><?php echo $e["name"]?></a></td>
								<td><?php if(isset($e["type"]))echo $e["type"]?></td>
								<td><?php echo (isset($e['tags'])) ? implode(",", $e['tags']) : ""?></td>
								<td><?php if(isset($e["address"]["postalCode"])) echo $e["address"]["postalCode"] ?></td>
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

var contextTags =[];
var oTableOrganization;
<?php
	foreach ($organizations as $e) {
		if(isset($e["tags"])){
			foreach ($e["tags"] as $k) {
?>
	if($.inArray("<?php echo $k ?>", contextTags)==-1){
		contextTags.push("<?php echo $k ?>");
	};
<?php
			}
		}
	}
?>
jQuery(document).ready(function() {
	if($(".tooltips").length) {
		$('.tooltips').tooltip();
	}
initDataTable();

});


var initDataTable = function() {
		oTableOrganization = $('#organizationTable').dataTable({
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
	};

</script>			
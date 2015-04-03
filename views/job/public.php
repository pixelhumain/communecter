<div class="row">
	<div class="col-sm-12">
		<div id="#panel_public" class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Form <span class="text-bold">X-editable</span></h4>
				<div class="panel-tools">
					<div class="dropdown" style="display: inline-block;">
						<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-cog"></i>
						</a>
						<ul role="menu" class="dropdown-menu dropdown-light pull-right" style="display: none;">
							<li>
								<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a href="#" class="panel-refresh">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a data-toggle="modal" href="#panel-config" class="panel-config">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a href="#" class="panel-expand">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body" style="display: block;">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
						Title / Data / Ville
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
						Fonction / Lieu / Ville / Experience Rq / Nb d'heures / Salaire / Image orga
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
						Description / Qualifications
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

var jobData = <?php echo json_encode($job)?>;

jQuery(document).ready(function() {

	debugMap.push(jobData);
});
</script>
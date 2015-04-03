<div class="row">
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li class="active">
					<a data-toggle="tab" href="#panel_public">
						List of Jobs Posting
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="#panel_public" class="tab-pane fade in active">
					<div class="row">
						<table class="table table-striped table-bordered table-hover" id="members">
							<thead>
								<tr>
									<th>Title</th>
									<th class="hidden-xs">Employment Type</th>
									<th class="hidden-xs">Date Posted</th>
									<th class="hidden-xs">Tags</th>
									<th class="hidden-xs">Organization Hiring</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(isset($jobList)) {
								foreach ($jobList as $jobValue) {
									if ( isset($jobValue["_id"]) ) {
										$jobId = $jobValue["_id"];
								?>
								<tr id="job<?php echo $jobId;?>">
									<td><?php if(isset($jobValue["title"])) echo $jobValue["title"]?></td>
									<td><?php if(isset($jobValue["employmentType"])) echo $jobValue["employmentType"] ?></td>
									<td><?php if(isset($jobValue["datePosted"])) echo $jobValue["datePosted"] ?></td>
									<td><?php if(isset($jobValue["tags"]))echo implode(",", $jobValue["tags"])?></td>
									<td><?php if(isset($jobValue["hiringOrganization"]) && isset($jobValue["hiringOrganization"]["name"])) echo $jobValue["hiringOrganization"]["name"] ?></td>
									<td class="center">
									<div class="visible-md visible-lg hidden-sm hidden-xs">
										<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id."/job/public/id/".$jobId);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
										<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo $jobId;?>" data-name="<?php echo (string)$jobValue["title"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
									</div>
									</td>
								</tr>
								<?php
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		    
		    
		</div>
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function() {
	
	<?php $contextMap = array("jobList"=>$jobList); ?>

 	var contextMap = <?php echo json_encode($contextMap)?>;
 	debugMap.push(contextMap);


});
</script>
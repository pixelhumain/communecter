<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-lightbulb-o fa-2x text-blue"></i> Mes projets</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
			<a href="#newProject"  class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add a project" alt="Add an project"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<!--div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">			
			<table class="table table-striped table-hover" id="projects">
				<tbody>
					<?php
					if(isset($projects) && count($projects)>0){
					foreach ($projects as $e) {
					?>
					<tr id="project<?php echo (string)$e["_id"];?>">
						<td class="center">
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>" class="text-dark">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-lightbulb-o fa-2x"></i>
							<?php } ?>
						</a>
						</td>
						<td>
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>" class="text-dark">
								<?php if(isset($e["name"]))echo $e["name"]?>
							</a>
						</td>
						<td><?php if(isset($e["url"]))echo $e["url"]?></td>
						<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/edit/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="left" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
							<a href="#" class="removeProjectbtn btn btn-xs btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="left" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
							<?php }; ?>
						</div>
						</td>
					</tr>
					<?php
						};}
					?>
				</tbody>
			</table>
			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
		<?php if(isset($projects) && count($projects) == 0) {?>
			<div id="info" class="padding-10">
				<blockquote> 
					Create or Contribute 
					<br>Build Things 
					<br>Find Help 
					<br>Organize
					<br>Local or distant
					<br>Projects
				</blockquote>
			</div>
		<?php } ?>
		</div>
	</div>-->
</div>
<script type="text/javascript">
	//alert ("oui");
		//jQuery(document).ready(function() {});
		jQuery(document).ready(function() {
		bindBtnRemoveProject();
	});

	function bindBtnRemoveProject() {

		$(".removeProjectbtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idProject = $(this).data("id");
			//var idMember = $(this).data("member-id");
			//var typeMember = $(this).data("member-type");
			bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> project ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				console.log(idProject);
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/project/removeproject/projectId/"+idProject+"",
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {               
							toastr.info("PROJECT REMOVED SUCCESFULLY!!");
							$("#project"+idProject).remove();
							if ($("#projects tr").length == 0) {
								$("#info").show();
							}
						} else {
						   toastr.info("something went wrong!! please try again.");
						}
					}
				});
			});

			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
		});
	}
function updateProject( nProject, projectId ){
		console.log(nProject);
		if('undefined' != typeof contextMap){
			contextMap["projects"].push(nProject);
		}
		var viewBtn = '<a href="'+baseUrl+'/'+moduleId+'/project/dashboard/id/'+projectId+'">';
		var unlinkBtn = '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
							'<a href="javascript:;" class="btn btn-xs btn-light-blue tooltips " data-placement="left" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>'+
							'<a href="#" class="btn btn-xs btn-red tooltips delBtn" data-id="'+projectId+'" data-name="'+nProject.name+'" data-placement="left" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
						'</div>';
		var projectLine  = 
		'<tr id="project'+projectId+'">'+
					'<td class="center">'+viewBtn+'<i class="fa fa-lightbulb-o fa-2x"></i></a></td>'+
					'<td>'+nProject.title+'</a></td>'+
					'<td>'+nProject.url+'</td>'+
					'<td class="center">'+
					unlinkBtn+
					"</td>"+
				"</tr>";
		$("#projects").prepend(projectLine);
		$('.tooltips').tooltip();
		$('#info').hide();
		bindBtnRemoveProject();	
	}
</script>
<?php 
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	'/plugins/select2/select2.css',
	'/plugins/select2/select2.min.js',
	//autosize
	'/plugins/autosize/jquery.autosize.min.js',

	'/plugins/jQuery-Knob/js/jquery.knob.js',
	'/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
?>
<div class="panel panel-white">
	<div class="panel-heading border-ligh bg-purple">
		<h4 class="panel-title"><i class="fa <?php echo Project::ICON ?> "></i> <?php echo Yii::t("project","Projects",null,Yii::app()->controller->module->id) ?></h4>
	</div>
	<div class="panel-tools">
		<?php if( @$authorised || $openEdition && isset(Yii::app()->session["userId"]) ) { ?>
			<a href="javascript:openForm('project','sub')" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add a project" alt="Add a project"><i class="fa fa-plus"></i> Créer un nouveau projet</a>
		<?php  } ?>
			<a id="showHideOldProject" class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("project","Display/Hide old projects",null,Yii::app()->controller->module->id) ?>" onclick="toogleOldProject()">
	    		
	    		<i class="fa fa-history"></i> <?php echo Yii::t("project","Old projects",null,Yii::app()->controller->module->id) ?>
	    	</a>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">			
			<table class="table table-striped table-hover" id="projects">
				<tbody>
					<?php
						//print_r($projects);
					$nbOldProjects = 0;
					if(isset($projects) && count($projects)>0){
					foreach ($projects as $e) {
						if (!empty($e["endDate"])) {
							$endDate = strtotime($e["endDate"]);
						}
						
						if (empty($e["endDate"]) || $endDate > time()) {
							$projectStyle = "";
							$projectClass = "";
						} else {
							$projectStyle = "display:none;";
							$projectClass = "oldProject";
							$nbOldProjects++;
						}
					?>
					<tr class="<?php echo $projectClass ?>" style="<?php echo $projectStyle ?>" id="project<?php echo (string)$e["_id"];?>" style="padding:5px 0px;">
						<td class="center" style="padding-left: 15px;">
							<?php $url = '#element.detail.type.'.Project::COLLECTION.'.id.'.$e["_id"];?>
							<a href="<?php echo $url?>" class="lbh text-dark">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-lightbulb-o fa-2x text-purple"></i>
							<?php } ?>
							</a>
						</td>
						<td>
							<a href="<?php echo $url?>" class="lbh text-dark">
								<?php if(isset($e["name"]))echo $e["name"]?>
							</a>
						</td>
						<td class="center">
						<div class="visible-md visible-lg visible-lg" >
							<?php if( @$authorised ) { ?>
							<a href="#" class="removeProjectbtn btn btn-xs btn-grey tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
							<?php }; ?>
						</div>
						</td>
					</tr>
					<?php
						}}
					?>
				</tbody>
			</table>
			<?php if(isset($projects) && count($projects) > 0 ){ ?>
				<div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 11px; height: 200px;"></div></div>
			<?php } ?>
		<?php if(isset($projects) && count($projects) == 0) {?>
			<div id="info" class="padding-10">
				<blockquote>
					Créez des projets ...
					<?php //echo Yii::t("project","Create or Contribute <br>Build Things<br>Find Help<br>Organize<br>Local or distant<br>Projects",null,Yii::app()->controller->module->id) ?>
				</blockquote>
			</div>
		<?php } ?>
		<?php if(isset($projects) && count($projects) > 0 && count($projects)==$nbOldProjects ) {?>
			<div id="infoLastButNotNew" class="padding-10">
				<blockquote>
					<?php echo Yii::t("project","Create new projects <br>To show your current activity<br>And what's happened around people",null,Yii::app()->controller->module->id) ?>
				</blockquote>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	var nbOldProjects = <?php echo (String) @$nbOldProjects;?>;
	jQuery(document).ready(function() {
		if (nbOldProjects == 0) $("#showHideOldProject").hide();
		bindBtnRemoveProject();
	});

	function bindBtnRemoveProject() {
		$(".removeProjectbtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idProject = $(this).data("id");
			bootbox.confirm("Are you sure you want to delete <span class='text-grey'>"+$(this).data("name")+"</span> project ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				mylog.log(idProject);
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
						   toastr.error(data.msg);
						}
					},
					error: function(data) {
						toastr.error("Something went wrong!! Contact your administrator");
					}
				});
			});

			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
		});
	}

	function toogleOldProject() {
		$(".oldProject").toggle("slow");
		$("#infoLastButNotNew").toggle("slow");
	}
</script>
<?php 
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	'/assets/plugins/select2/select2.css',
	'/assets/plugins/select2/select2.min.js',
	//autosize
	'/assets/plugins/autosize/jquery.autosize.min.js',

	'/assets/plugins/jQuery-Knob/js/jquery.knob.js',
	//'/assets/js/ui-sliders.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-lightbulb-o fa-2x text-blue"></i> Mes projets</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
			<a href="#newProject"  class="new-project btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add a project" alt="Add an project"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">			
			<table class="table table-striped table-hover" id="projects">
				<tbody>
					<?php
						//print_r($projects);
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
						<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs" >
							<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
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
	</div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function() {
		bindBtnAddProject();
		bindBtnRemoveProject();
	});

	function bindBtnAddProject() {
		$('.new-project').off().on("click", function(){
			$.subview({
				content : "#ajaxSV",
				onShow : function() {
					var url = baseUrl+"/"+moduleId+"/project/projectsv";
					getAjax("#ajaxSV", url, 
							function(){
								console.log('toto');
								initProjectForm();
							}, 
							"html");
				},
				onSave : function() {
					$('.form-project').submit();
				},
				onHide : function() {
					$.hideSubview();
				}
			});
			
		});
	}

	function bindBtnRemoveProject() {
		$(".removeProjectbtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idProject = $(this).data("id");
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
	function updateProject( nProject, projectId ){
		console.log(projectId);
		if('undefined' != typeof contextMap){
			contextMap["projects"].push(nProject);
		}
		var viewBtn = '<a href="'+baseUrl+'/'+moduleId+'/project/dashboard/id/'+projectId.$id+'" class="text-dark">';
		var unlinkBtn = '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
							'<a href="#" class="removeProjectbtn btn btn-xs btn-red tooltips delBtn" data-id="'+projectId.$id+'" data-name="'+nProject.name+'" data-placement="left" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
						'</div>';
		var projectLine  = 
		'<tr id="project'+projectId.$id+'">'+
					'<td class="center">'+viewBtn+'<i class="fa fa-lightbulb-o fa-2x"></i></a></td>'+
					'<td>'+viewBtn+nProject.name+'</a></td>'+
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
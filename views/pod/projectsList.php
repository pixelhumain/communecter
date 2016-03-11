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
	'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light bg-purple">
		<h4 class="panel-title"><i class="fa <?php echo Project::ICON ?> "></i> <?php echo Yii::t("project","PROJECTS",null,Yii::app()->controller->module->id) ?></h4>
	</div>
	<div class="panel-tools">
		<?php if( @$authorised ) { ?>
			<a href="#" onclick="showAjaxPanel( '/project/projectsv/id/<?php echo $contextId ?>/type/<?php echo $contextType ?>', 'ADD A PROJECT','lightbulb-o' )" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add a project" alt="Add a project"><i class="fa fa-plus"></i> Créer un nouveau projet</a>
		<?php  } ?>
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
					<tr id="project<?php echo (string)$e["_id"];?>" style="padding:5px 0px;">
						<td class="center" style="padding-left: 15px;">
							<?php $url = '#project.detail.id.'.$e["_id"];?>
							<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')" class="text-dark">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-lightbulb-o fa-2x text-purple"></i>
							<?php } ?>
							</a>
						</td>
						<td>
							<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')" class="text-dark">
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
			$("#ajaxSV").html("<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>");
			$.subview({
				content : "#ajaxSV",
				onShow : function() {
					var url = baseUrl+"/"+moduleId+"/project/projectsv/id/<?php echo @$contextId; ?>/type/<?php echo @$contextType; ?>";
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
			bootbox.confirm("Are you sure you want to delete <span class='text-grey'>"+$(this).data("name")+"</span> project ?", 
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
			contextMap["projects"][projectId] = nProject;
		}
		var viewBtn = '<a href="'+baseUrl+'/'+moduleId+'/project/dashboard/id/'+projectId.$id+'" class="text-dark">';
		var unlinkBtn = '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
							'<a href="#" class="removeProjectbtn btn btn-xs btn-grey tooltips delBtn" data-id="'+projectId.$id+'" data-name="'+nProject.name+'" data-placement="left" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
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
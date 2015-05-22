<?php 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css');

	//X-editable...
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , CClientScript::POS_END, array(), 2);
?>
<style type="text/css">
	.selectEv{
		min-width: 200px;
	}
</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> Informations</span></h4>
		<ul class="panel-heading-tabs border-light">
        	<li>
        		<a href="#" class="removeEventBtn btn btn-red">Remove</a>
        	</li>
        </ul>
	</div>
	<div class="panel-body no-padding">
		<div class="row center">
			<div class="col-md-6 col-md-offset-3">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => $itemId,
																		  "type" => $type,
																		  "contentId" =>Document::IMG_PROFIL,
																		  "show" => "true" ,
																		  "editMode" => true)); ?>
			</div>
		</div>
		<table class="table table-condensed table-hover" >
			<tbody>
				<tr>
					<td>Intitulé</td>
					<td><a href="#" id="name" name="name" data-type="text" data-title="Event name" data-emptytext="Event name" class="editable-event editable editable-click" ><?php if(isset($event["name"]))echo $event["name"];?></a></td>
				</tr>
				<?php if(!empty($organizer)) {?>
					<tr>
						<td>Organisateur</td>
						<td><a href="<?php echo Yii::app()->createUrl("/".$this->module->id.'/'.$organizer["type"].'/dashboard/id/'.$organizer["id"]);?>" ><?php echo $organizer["name"]; ?></a></td>
					</tr>
				<?php } ?>
				<tr>
					<td>Début</td>
					<td><a href="#" id="startDate" data-type="datetime" data-emptytext="Enter Start Date" class="editable editable-click" ><?php if(isset($event["startDate"]))echo $event["startDate"]; ?></a></td>
				</tr>
				<tr>
					<td>Fin</td>
					<td><a href="#" id="endDate" data-type="datetime" data-emptytext="Enter End Date" class="editable editable-click"><?php if(isset($event["endDate"]))echo $event["endDate"]; ?></a></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><a href="#" id="type" name="type" data-type="select" data-inputclass="selectEv" class="editable editable-click" ><?php if(isset($event["type"])) echo $event["type"]; ?></a></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	var itemId = "<?php echo $itemId ?>";
	jQuery(document).ready(function() {

		activateEditable();

		$(".removeEventBtn").off().on("click", function(e){
			bootbox.confirm("Are you sure you want to delete this event ?", function(result) {
				if (!result) {
					return;
				}
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/event/delete/eventId/"+itemId,
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {               
							toastr.info("EVENT REMOVE SUCCESFULLY!!");
							document.location.href= baseUrl+"/"+moduleId+"/person";
						}else{
							toastr.error("Something went wrong");
						}
					}
				})
			})
		})
	})

	function activateEditable() {
		$.fn.editable.defaults.mode = 'inline';

		$('.editable-event').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", //this url will not be used for creating new job, it is only for update
			onblur: 'submit',
			showbuttons: false
		});

		$('#startDate').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", //this url will not be used for creating new user, it is only for update
			mode: "popup",
			placement: "bottom",
			format: 'dd/mm/yyyy hh:ii',    
			viewformat: 'dd/mm/yyyy hh:ii',
			showbuttons: false,    
			datetimepicker: {
				weekStart: 1,
				format: 'yyyy-mm-dd hh:ii'
			   }
			}
		);

		$('#endDate').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", //this url will not be used for creating new user, it is only for update
			mode: "popup",
			placement: "bottom",
			format: 'dd/mm/yyyy hh:ii',    
			viewformat: 'dd/mm/yyyy hh:ii',
			showbuttons: false,    
			datetimepicker: {
				weekStart: 1,
				format: 'yyyy-mm-dd hh:ii'
			   }
			}
		);

		$('#type').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield",
			source: ["event", "meeting", "discussion"]
			}
		);

		$('.editable-event').editable('option', 'pk', itemId);
		$('#startDate').editable('option', 'pk', itemId);
		$('#endDate').editable('option', 'pk', itemId);
		$('#type').editable('option', 'pk', itemId);
	}
</script>
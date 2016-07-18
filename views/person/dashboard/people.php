<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/communecter.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
.user-pending {
	opacity: 0.5;
}
</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-share-alt fa-2x text-yellow"></i> Mon entourage</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
			<a href="#" class="btn btn-xs new-invite btn-light-blue tooltips" data-placement="top" data-original-title="Invite Someone"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover" id="people">
				<tbody>
					<?php 
					$memberType = Person::COLLECTION;
					if(isset($people)  && count($people)>0) {
						foreach ($people as $e) { 
					?>
						<tr id="<?php echo $memberType.(string)$e["_id"];?>" class="<?php echo @$e["pending"] ? "user-pending" : "" ?>">
							<td class="center">
								<?php if (! @$e["pending"]) {?>
									<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>">
									<?php if (@$e["profilImageUrl"] != ""){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['profilImageUrl']) ?>">
									<?php } else { ?>
										<i class="fa fa-user fa-2x"></i>
									<?php } ?>
									</a>
								<?php } else { ?>
									<i class="fa fa-user fa-2x"></i>
								<?php } ?>
							</td>
							<td>
								<?php  if (! @$e["pending"]) {
									echo '<a href="'.Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]).'">'.@$e["name"].'</a>'; ?>
								<?php } else {
									echo @$e["name"];
									} ?>
							</td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
								<a href="javascript:;" class="disconnectPersonBtn btn btn-xs btn-red tooltips " data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>"  data-type="<?php echo $memberType ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="left" data-original-title="Remove Knows relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
							</td>
						</tr>
					<?php
						}}
					?>
				</tbody>
			</table>
			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php if (isset($people) && count($people) == 0) { ?>
				<div id="infoPodPeople" class="padding-10">
					<blockquote> 
						Invite People 
						<br>create links 
						<br>communicate & interact
						<br>better cities & Organizations
						<br>People are the heart of the system
					</blockquote>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">

var connectedPersons = <?php echo json_encode($people) ?>;
jQuery(document).ready(function() {
	bindConnectEvent();
})

function bindConnectEvent() {
	$(".new-invite").off().on("click", function() {
		openSubView('Invite someone', '/'+moduleId+'/person/invite',null);
	});

	$(".disconnectPersonBtn").off().on("click", function() {
		var idToDisconnect = $(this).data("id");
		var typeToDisconnect = "<?php echo Person::COLLECTION ?>";
		var nameToDisconnect = $(this).data("name");
		$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
		
		disconnectPerson(idToDisconnect, typeToDisconnect, nameToDisconnect, 
			function(idToDisconnect, typeToDisconnect, nameToDisconnect) {
				console.log('callback disconnectPerson');
				updateInvite(idToDisconnect, typeToDisconnect, nameToDisconnect)
			}
		);

		$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
	});

}

function updateInvite(user, isPending, isLineToRemove) {
	console.log("updateInvite", user);
	var newLine = "";

	if (isLineToRemove) {
		$("#citoyens"+user).fadeOut("slow", function() {
			$(this).remove();
		});
		if ($("#people tr").length == 0) {
			$("#infoPodPeople").show();
		}
	} else {
		$("#infoPodPeople").hide();
		if (isPending) {
			newLine += '<tr class="user-pending" id="citoyens'+user.id+'">'+
							'<td class="center">'+
								'<i class="fa fa-user fa-2x"></i>'+
							'</td>'+
							'<td>'+user.name+'</td>'+
							'<td class="center">'+
								'<div class="visible-md visible-lg hidden-sm hidden-xs">'+
									'<a data-original-title="Remove Knows relation" data-placement="left" data-name="'+user.name+'" data-id="'+user.id+'" data-type="citoyens" data-linktype="" class="disconnectBtn btn btn-xs btn-red tooltips " href="javascript:;"><i class=" disconnectBtnIcon fa fa-unlink"></i></a>'+
								'</div>'+
							'</td>'+
						'</tr>';	
		} else {
			newLine += '<tr id="citoyens'+user.id+'">'+
							'<td class="center">'+
								'<a href="/ph/communecter/person/dashboard/id/'+user.id+'">';
			//Profil Image
			if (user.profilImageUrl == "") 
				newLine += '<i class="fa fa-user fa-2x"></i>';
			else 
				newLine += '<img width="50" height="50" src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+user.profilImageUrl+'" class="img-circle" alt="image">';
			
			newLine += '</a>'+
							'</td>'+
							'<td><a href="'+baseUrl+'/'+moduleId+'/person/dashboard/id/'+user.id+'">'+user.name+'</a></td>'+
							'<td class="center">'+
								'<div class="visible-md visible-lg hidden-sm hidden-xs">'+
									'<a data-original-title="Remove Knows relation" data-placement="left" data-name="'+user.name+'" data-id="'+user.id+'" data-type="citoyens" data-linktype="" class="disconnectPersonBtn btn btn-xs btn-red tooltips " href="javascript:;"><i class=" disconnectBtnIcon fa fa-unlink"></i></a>'+
								'</div>'+
							'</td>'+
						'</tr>';
		}
		$('#people').prepend(newLine);
		$('#citoyens'+user.id).addClass('animated bounceIn');
		bindConnectEvent();
	}
}

</script>
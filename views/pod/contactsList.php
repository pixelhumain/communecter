<?php

$cssAnsScriptFilesTheme = array(

'/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light bg-blue">
		<h4 class="panel-title"><i class="fa fa-user-circle"></i> <?php echo Yii::t("common","Contact",null,Yii::app()->controller->module->id); ?></h4>
	</div>
	<div class="panel-tools">
		<?php if(( @$authorised || @$openEdition) && !isset($noAddLink) && isset(Yii::app()->session["userId"]) ) { ?>
			<a class="tooltips btn btn-xs btn-light-blue " data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Add",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick="elementLib.openForm ( 'contactPoint','contact')">
	    		<i class="fa fa-plus"></i> <?php echo Yii::t("common","Add") ?>
	    	</a>
		<?php } ?>
	</div>
	
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
				<?php
					if(isset($contacts) && count($contacts)>0 ) { ?>
					<table class="table table-striped table-hover" id="contacts">
						<tbody>
					<?php	
						foreach ($contacts as $keyContact => $contact) {						
					?>
						<tr class="" style="" id="<?php echo $keyContact;?>">
							<td class="center hidden-sm hidden-xs" style="padding-left: 18px; ">
								<?php  

								if(!empty($contact["id"])){
									$url = '#person.detail.id.'.$contact["id"];
									$id = $contact["id"];
									$o = Element::getInfos(Person::COLLECTION, $id);
									
									$icon='<img height="35" width="35" class="tooltips" data-placement="right" src="'.$this->module->assetsUrl.'/images/news/profile_default_l.png" data-placement="right" data-original-title="'.$o['name'].'">';
									$refIcon="fa-user";
									$redirect="person";
									
									?>
									<a href="#<?php echo $redirect; ?>.detail.id.<?php echo (string)$o['id'];?>" class="lbh" title="<?php echo $o['name'] ?>" class="btn no-padding ">

									<?php if(@$o["profilThumbImageUrl"]) { ?>
										<img width="50" height="50"  alt="image" class="tooltips" data-placement='right' src="<?php echo Yii::app()->createUrl('/'.$o['profilThumbImageUrl']) ?>" data-original-title="<?php echo $o['name'] ?>">
									<?php }else{ 
										echo $icon;
									} ?>
									</a>
								<?php } 
								else 
								{ ?>
								<span class="lbh text-dark">
								<?php 
								$icon='<img height="35" width="35" class="tooltips" data-placement="right" src="'.$this->module->assetsUrl.'/images/news/profile_default_l.png" data-placement="right">';
								echo $icon;
								?>
									
								</span>
								<?php } ?>
							</td>
							<td>
								<?php if(!empty($contact["id"])){ ?>
								<a href="<?php echo $url?>" class="lbh text-dark">
								<?php }else{ ?>
								<span class="lbh text-dark">
								<?php } ?>
									<?php 
									if(!empty($contact["name"])) echo $contact["name"];
									if(!empty($contact["role"])){
									?>
									<br/><span class="text-extra-small"><?php echo @$contact["role"];?></span>
									<?php }
									if(!empty($contact["email"])){ ?>
									<br/><span class="text-extra-small"><?php echo @$contact["email"];?></span>
									<?php }
									if(!empty($contact["telephone"])){ ?>
									<br/><span class="text-extra-small">
										<?php 
										foreach ($contact["telephone"] as $keyTel => $tel) {
											if($keyTel > 0) echo " / ";
											echo $tel;
										} ?>
									</span>
								<?php }
								if(!empty($contact["id"])){ ?>
								</a>
								<?php }else{ ?>
								</span>
								<?php } ?>
								
							</td>
							<td>
								<?php $json = json_encode($contact); ?>
								<a class="tooltips btn btn-xs btn-light-blue " data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Update",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick='updateContact("<?php echo $keyContact; ?>");'>
						    		<i class="fa fa-pencil"></i>
						    	</a>
						    	<a class="tooltips btn btn-xs btn-light-blue " data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Remove",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick='removeContact("<?php echo $keyContact; ?>")'>
						    		<i class="fa fa-trash"></i>
						    	</a>
								
							</td>
						</tr>
						<?php
						}
					}
					if(isset($contacts) && count($contacts)>0 ) { ?>
						</tbody>
					</table>
					<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	var contacts = <?php echo json_encode($contacts);?>;
	jQuery(document).ready(function() {	 
		
	});

	function updateContact(ind) {
		contact = contacts[ind] ;
		dataUpdate = { index : ind } ;

		if(typeof contact.name !="undefined")
			dataUpdate.name = contact.name;
		if(typeof contact.email !="undefined")
			dataUpdate.email = contact.email;
		if(typeof contact.role !="undefined")
			dataUpdate.role = contact.role;
		if(typeof contact.telephone !="undefined"){
			var string = "";
			
			$.each(contact.telephone, function (i,num) { 
	        	if(i > 0)
	        		string += ", ";
	        	string += num;
	        });
	        dataUpdate.phone = string;
		}
		
		console.dir(dataUpdate);
		elementLib.openForm ('contactPoint','contact', dataUpdate);
	}

	function removeContact(ind) {
		param = new Object;
    	param.name = "contacts";
    	param.value = {index : ind};
    	param.pk = contextData.id;
		param.type = contextData.type;
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
	        data: param,
	       	dataType: "json",
	    	success: function(data){
	    		mylog.log("data", data);
		    	if(data.result){
					toastr.success(data.msg);
					loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
		    	}
		    }
		});
	}

</script>
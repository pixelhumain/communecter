<div class="panel panel-white">
  <div class="panel-heading border-light">
    <h4 class="panel-title">Annuaire </h4>
    <div class="panel-tools">
		<?php 
		$nbOrganization = isset($members[Organization::COLLECTION]) ? count($members[Organization::COLLECTION]) : 0;
		$nbPerson = isset($members[Person::COLLECTION]) ? count($members[Person::COLLECTION]) : 0;
    	$isAuthorized= false;
    	if(isset($organization) && isset(Yii::app()->session["userId"])) {
    		$isAuthorized =  Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"]);
    		if ($isAuthorized){
    	?>
			<a href="#addMembers" class="addMembersBtn btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Connect People or Organizations that are part of your Organization"><i class="fa fa-plus"></i></a>
		<?php }} ?>
	</div>
  </div>
  <div class="panel-body no-padding">
    <div class="tabbable no-margin no-padding partition-dark">
      <ul class="nav nav-tabs" id="myTab">
        <li class="<?php if ($nbPerson > $nbOrganization) echo "active" ?>">
          <a data-toggle="tab" href="#users_tab_example2">
            <i class="fa fa-user text-red"></i> People <span class="badge badge-red nbPersons"><?php echo $nbPerson ?></span>
          </a>
        </li>
        <li class="<?php if ($nbPerson <= $nbOrganization) echo "active" ?>">
          <a data-toggle="tab" href="#users_tab_example3">
            <i class="fa fa-group text-green"></i> Organizations <span class="badge badge-green nbOrganizations"><?php echo $nbOrganization ?></span>
          </a>
        </li>
      </ul>
      <div class="tab-content partition-white">
        <div id="users_tab_example2" class="tab-pane padding-bottom-5 <?php if ($nbPerson > $nbOrganization) echo "active" ?>">
          <div class="panel-scroll height-230">
            <table class="table table-striped table-hover">
              <tbody id='tPerson'>
              	<?php if(isset($members[Person::COLLECTION]) && count($members[Person::COLLECTION])>0) {
              		foreach ($members[Person::COLLECTION] as $e) { 
              			$id = (String) $organization["_id"]; 
              	?>
						<tr id="<?php echo Person::COLLECTION.(string)$e["_id"];?>">
							<td class="center">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']); ?>">
									<?php } else { ?>
										<i class="fa fa-user fa-2x"></i>
									<?php } ?>
								</a>
							</td>
							<td>
								<?php 
								if ($e && @$organization['links']['members'][ (string)$e['_id'] ]["isAdmin"] ){ ?>
									<i class="fa fa-pencil-square text-red" title="is Admin"></i>
								<?php } ?>
							</td>
							<td><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td><?php if(isset($e["position"]))echo $e["position"]?></td>
							<!--<td><?php //if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>-->
							<td><?php if(isset($e["links"]["memberOf"][$id]["roles"])) echo implode(",", $e["links"]["memberOf"][$id]["roles"]) ;?></td>
							<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<?php if( $isAuthorized ) { ?>
									<a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-placement="left" data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>" data-id="<?php if(isset($e['_id'])) echo $e['_id'];?>" data-type="<?php echo PHType::TYPE_CITOYEN ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove this member" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
									<?php }; ?>
								</div>
							</td>
						</tr>
					<?php }}else{ ?>
						<div class ="center height-250 padding-10" >
							<blockquote> 
								Invite People 
								<br>create links 
								<br>communicate and interact
								<br>better cities and Organizations
								<br>People are the heart of the system
							</blockquote>
						</div>
					<?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div id="users_tab_example3" class="tab-pane padding-bottom-5 <?php if ($nbPerson <= $nbOrganization) echo "active" ?>">
          <div class="panel-scroll height-230 organizationNetwork">
            <table class="table table-striped table-hover">
              <tbody id='tOrga'>
                <?php if(isset($members[Organization::COLLECTION]) && count($members[Organization::COLLECTION])>0){
                	foreach ($members[Organization::COLLECTION] as $e) { ?>
						<tr id="<?php echo Organization::COLLECTION.(string)$e["_id"];?>">
							<td class="center organizationLine">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>">
									<?php } else { ?>
										<i class="fa fa-group fa-2x"></i>
									<?php } ?>
								</a>
							</td>
							<td>
								<?php 
								if ($e && @$organization['links']['members'][ (string)$e['_id'] ]["isAdmin"] ){ ?>
									<i class="fa fa-pencil-square text-red"  title="is Admin"></i>
								<?php } ?>
							</td>
							<td><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></td>
							<td><?php if(isset($e["type"]))echo $e["type"]?></td>
							<!--<td><?php //if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>-->
							<td><?php if(isset($e["linkType"]))echo $e["linkType"]?></td>
							<td class="center">
								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<?php if( $isAuthorized ) { ?>
									<a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-placement="left" data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>"  data-type="<?php echo Organization::COLLECTION ?>" data-id="<?php if(isset($e['_id'])) echo $e['_id'];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove this organization" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
									<?php }; ?>
								</div>
							</td>
						</tr>
					<?php }}else{ ?>
						<div class ="height-250 padding-30 emptyOrganizationNetwork" >
							<blockquote> 
								Create or Connect 
								<br>an Organization, NGO,  
								<br>Local Business, Informal Group. 
								<br>Build links in your network, 
								<br>to create a connected local directory 
							</blockquote>
						</div>
					<?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
   $this->renderPartial('addMembers', array( "organization" => $organization, "organizationTypes" => $organizationTypes ));
 ?>
<script type="text/javascript">
	var members = <?php echo json_encode($members); ?>;
	var organization = <?php echo json_encode($organization); ?>;

	jQuery(document).ready(function() {
		bindBtnNetwork();
	});

	function updateOrganisation(newMember,type) {
		console.log("UpdateOrganization from network pod !");
		if('undefined' != typeof contextMap["organizations"])
		{
			if(type == '<?php echo Person::COLLECTION; ?>')
				contextMap["people"].push(newMember);
			else if (type == '<?php echo Organization::COLLECTION; ?>')
				contextMap["organizations"].push(newMember);
		}
		console.log(newMember, "type", type);
		var links ="";
		var itemId = newMember["_id"]["$id"];
		if( !$("#"+type+itemId).length > 0 ) 
		{
			var imgHtml="";
			var roles ="";
			var parentId = organization["_id"]["$id"];

			if(type=="citoyens"){
				links=  baseUrl+'/'+moduleId+'/person/dashboard/id/'+itemId;
				type = "";
				imgHtml = '<i class="fa fa-user fa-2x"></i>';
				tabObject= $("#tPerson");
				$('.nbPersons').html((parseInt($('.nbPersons').html()) || 0) +1);
			}else{
				links=  baseUrl+'/'+moduleId+'/organization/dashboard/id/'+itemId;
				tabObject = $("#tOrga");
				imgHtml = '<i class="fa fa-group fa-2x"></i>';
				type = newMember.type;
				$('.nbOrganizations').html((parseInt($('.nbOrganizations').html()) || 0) +1);
			}
			if('undefined' != typeof newMember["imagePath"] && newMember["imagePath"]!=""){
				imgHtml = '<img width="50" height="50" alt="image" class="img-circle" src="'+newMember["imagePath"]+'">'
			}
			
			if('undefined' != typeof newMember["links"]["memberOf"][parentId]["roles"]){
				var rolesTab = newMember["links"]["memberOf"][parentId]["roles"];
				for(var i = 0; i<rolesTab.length; i++){
					if(i==0){
						roles = rolesTab[i];
					}else{
						roles += ", "+rolesTab[i]
					}	
				}
			}
			
			var networkLine = '<tr id="'+type+itemId+'">'+
	          							'<td class="center">'+
	          							'<a href="'+links+'">'+
	          								imgHtml+
	          							'</a>' +
	          							'</td>'+
	          							'<td> <a href="'+links+'">'+
	          								newMember.name+
										'</a> </td>'+
	          							'<td>'+type+'</td>'+
	          							'<td>'+roles+'</td>'+
	      								'<td class="center">'+
											'<div class="visible-md visible-lg hidden-sm hidden-xs">'+
												' <a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-placement="left" data-linkType=""  data-type="'+type+'" data-name="'+newMember.name+'" data-original-title="" ><i class=" disconnectBtnIcon fa fa-unlink"></i> </a>'+
											' </div>'+
										'</td>'+
	        						'</tr>';

	        //console.log(networkLine);
	        tabObject.append(networkLine);
	        bindBtnNetwork();

	        if( $(".organizationNetwork tr").length > 0 )
				$(".emptyOrganizationNetwork").remove();
		}
	}

	
	
	function bindBtnNetwork(){

		$(".disconnectBtnNet").off().on("click",function () {
	        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	        var idMember = $(this).data("id");
	        var typeMember = $(this).data("type");
	        console.log(idMember);
	        bootbox.confirm("Are you sure you want to remove <span class='text-red'>"+$(this).data("name")+"</span> from your members ?", 
				function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/link/removemember/memberId/"+idMember+"/memberType/"+typeMember+"/memberOfId/<?php echo (string)$organization['_id'] ?>/memberOfType/<?php echo Organization::COLLECTION ?>",
					       	dataType: "json",
				        	success: function(data){
					        	if ( data && data.result ) {               
						       	 	toastr.info("LINK DIVORCED SUCCESFULLY!!");
						        	$("#"+typeMember+idMember).remove();
						        } else {
						           toastr.info("something went wrong!! please try again.");
						           $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						        }
						    }
						});
					}
				}
			)
		});
	}

</script>

<div class="panel panel-white">
  <div class="panel-heading border-light">
    <h4 class="panel-title">Annuaire </h4>
    <div class="panel-tools">
    	<?php 
    	$res= false;
    	if(isset($organization) && isset(Yii::app()->session["userId"])) {
    		$res =  Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], new MongoId($organization["_id"]));
    		if($res){
    	?>
			<a href="#addMembers" class="addMembersBtn btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Connect People or Organizations that are part of your Organization"><i class="fa fa-plus"></i> Add Members</a>
		<?php }} ?>
      <div class="dropdown">
        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
          <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
          <li>
            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
          </li>
          <li>
            <a class="panel-refresh" href="#">
              <i class="fa fa-refresh"></i> <span>Refresh</span>
            </a>
          </li>
          <li>
            <a class="panel-config" href="#panel-config" data-toggle="modal">
              <i class="fa fa-wrench"></i> <span>Configurations</span>
            </a>
          </li>
          <li>
            <a class="panel-expand" href="#">
              <i class="fa fa-expand"></i> <span>Fullscreen</span>
            </a>
          </li>
        </ul>
      </div>
      <a class="btn btn-xs btn-link panel-close" href="#">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="panel-body no-padding">
    <div class="tabbable no-margin no-padding partition-dark">
      <ul class="nav nav-tabs" id="myTab">
        <li class="<?php if(count($members[PHType::TYPE_CITOYEN]) && count($members[PHType::TYPE_CITOYEN]) > count($members[Organization::COLLECTION])) echo "active" ?>">
          <a data-toggle="tab" href="#users_tab_example2">
            <i class="fa fa-user text-red"></i> People <?php echo count($members[PHType::TYPE_CITOYEN]) ?>
          </a>
        </li>
        <li class="<?php if(count($members[Organization::COLLECTION]) && count($members[PHType::TYPE_CITOYEN]) < count($members[Organization::COLLECTION]) ) echo "active" ?>">
          <a data-toggle="tab" href="#users_tab_example3">
            <i class="fa fa-group text-green"></i> Organizations <?php echo count($members[Organization::COLLECTION]) ?>
          </a>
        </li>
      </ul>
      <div class="tab-content partition-white">
        <div id="users_tab_example2" class="tab-pane padding-bottom-5 <?php if(count($members[PHType::TYPE_CITOYEN]) && count($members[PHType::TYPE_CITOYEN]) > count($members[Organization::COLLECTION])) echo "active" ?>">
          <div class="panel-scroll height-230">
            <table class="table table-striped table-hover">
              <tbody id='tPerson'>
              	<?php if(isset($members[PHType::TYPE_CITOYEN])){foreach ($members[PHType::TYPE_CITOYEN] as $e) { $id = new MongoId($organization["_id"]); ?>
						<tr id="<?php echo (string)$e["_id"];?>">
							<td class="center">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-user fa-2x"></i>
							<?php } ?>
							</td>
							<td><?php if(isset($e["name"]))echo $e["name"]?></td>
							<td><?php if(isset($e["position"]))echo $e["position"]?></td>
							<!--<td><?php //if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>-->
							<td><?php if(isset($e["links"]["memberOf"][(string)$id]["roles"])) echo implode(",", $e["links"]["memberOf"][(string)$id]["roles"]) ;?></td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips "  data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
								<?php if( $res ) { ?>
								<a  href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/edit/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
								<a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>" data-id="<?php if(isset($e['_id'])) echo $e['_id'];?>" data-type="<?php echo PHType::TYPE_CITOYEN ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove this member" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
							</td>
						</tr>
					<?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
        <div id="users_tab_example3" class="tab-pane padding-bottom-5 <?php if(count($members[Organization::COLLECTION]) && count($members[PHType::TYPE_CITOYEN]) < count($members[Organization::COLLECTION]) ) echo "active" ?>">
          <div class="panel-scroll height-230">
            <table class="table table-striped table-hover">
              <tbody id='tOrga'>
                <?php if(isset($members[Organization::COLLECTION])){foreach ($members[Organization::COLLECTION] as $e) { ?>
						<tr id="<?php echo (string)$e["_id"];?>">
							<td class="center">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-group fa-2x"></i>
							<?php } ?>
							</td>
							<td><?php if(isset($e["name"]))echo $e["name"]?></td>
							<td><?php if(isset($e["type"]))echo $e["type"]?></td>
							<!--<td><?php //if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>-->
							<td><?php if(isset($e["linkType"]))echo $e["linkType"]?></td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
								<?php if( $res ) { ?>
								<a  href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/edit/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
								<a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>"  data-type="<?php echo Organization::COLLECTION ?>" data-id="<?php if(isset($e['_id'])) echo $e['_id'];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove this organization" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
							</td>
						</tr>
					<?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

	var members = <?php echo json_encode($members); ?>;

	var organization = <?php echo json_encode($organization); ?>;

	function updateOrganisation(newOrga,type){
		console.log(newOrga, "type", type);
		var links ="";
		var itemId = newOrga["_id"]["$id"];
		var imgHtml="";
		var roles ="";
		var parentId = organization["_id"]["$id"];

		if(type=="citoyens"){
			links=  baseUrl+'/'+moduleId+'/person/dashboard/id/'+itemId;
			type = "";
			imgHtml = '<i class="fa fa-user fa-2x"></i>';
			tabObject= $("#tPerson");
		}else{
			links=  baseUrl+'/'+moduleId+'/organization/dashboard/id/'+itemId;
			tabObject = $("#tOrga");
			imgHtml = '<i class="fa fa-group fa-2x"></i>'
			type = newOrga.type;
		}
		if(typeof(newOrga["imagePath"])!="undefined" && newOrga["imagePath"]!=""){
			imgHtml = '<img width="50" height="50" alt="image" class="img-circle" src="'+newOrga["imagePath"]+'">'
		}
		console.log(newOrga["links"]["memberOf"][parentId]["roles"]);
		if(typeof(newOrga["links"]["memberOf"][parentId]["roles"])!="undefined"){
			var rolesTab = newOrga["links"]["memberOf"][parentId]["roles"];
			for(var i = 0; i<rolesTab.length; i++){
				if(i==0){
					roles = rolesTab[i];
				}else{
					roles += ", "+rolesTab[i]
				}	
			}
		}
		
		var organizationLine = '<tr id="'+itemId+'">'+
          							'<td class="center">'+
          								imgHtml+
          							'</td>'+
          								'<td>'+newOrga.name+'</td>'+
          							'<td>'+type+'</td>'+
          							'<td>'+roles+'</td>'+
      								'<td class="center">'+
										'<div class="visible-md visible-lg hidden-sm hidden-xs">'+
											'<a href="'+links+'" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i> </a>'+
											'<a  href="" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i> </a>'+
											'<a href="javascript:;" class="disconnectBtnNet btn btn-xs btn-red tooltips " data-linkType=""  data-type="'+type+'" data-name="'+newOrga.name+'" data-placement="top" data-original-title="" ><i class=" disconnectBtnIcon fa fa-unlink"></i> </a>'+
										'</div>'+
									'</td>'+
        						'</tr>';

        console.log(organizationLine);
        tabObject.append(organizationLine);
	}

	jQuery(document).ready(function() {
		bindBtnNetwork();
	});
	
	function bindBtnNetwork(){

		$(".disconnectBtnNet").off().on("click",function () {
	        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	        var idOrga = $(this).data("id");
	        var typeOrga = $(this).data("type");
	        console.log(idOrga);
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/organization/removemember/organizationId/<?php echo (string)$organization['_id'] ?>/id/"+idOrga+"/type/"+typeOrga,
		       	dataType: "json",
	        	success: function(data){
		        	if ( data && data.result ) {               
			       	 	toastr.info("LINK DIVORCED SUCCESFULLY!!");
			        	$("#"+idOrga).remove();
			        } else {
			           toastr.info("something went wrong!! please try again.");
			           $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
			        }
			    }
			});
		});
	}
</script>

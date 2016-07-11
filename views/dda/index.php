<style>
	.thumb-profil-parent-dda{

	}
	.toolbar-DDA{
		position:absolute;
		top:115px;
		left:50px;
	}

	.toolbar-DDA .dropdown{
		display: inline-block;
	}

	#accordion .panel{
		margin-top:15px;
	}
	.panel-group .panel-heading + .panel-collapse > .panel-body {
	    font-size: 17px;
	    padding:10px;
	}

	.box-ajaxTools .btn.tooltips {
	    border-radius: 10px !important;
	    margin: 10px;
	}
}
</style>

<?php 

	$urlPhotoProfil = "";
	if(!@$parent){
		if($parentType == Project::COLLECTION) { $parent = Project::getById($parentId); }
	  	if($parentType == Organization::COLLECTION) { $parent = Organization::getById($parentId); }
	  	if($parentType == Person::COLLECTION) { $parent = Person::getById($parentId); }
        if($parentType == City::COLLECTION) { $parent = City::getByUnikey($parentId); }
	}

	if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
      $urlPhotoProfil = Yii::app()->getRequest()->getBaseUrl(true).$parent['profilImageUrl'];
    else
      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';

	$icon = "comments";	
	$colorName = "dark";
	if($parentType == Project::COLLECTION) { $icon = "lightbulb-o"; $colorName = "purple"; }
  	if($parentType == Organization::COLLECTION) { $icon = "group"; $colorName = "green"; }
  	if($parentType == Person::COLLECTION) { $icon = "user"; $colorName = "dark"; }
    if($parentType == City::COLLECTION) { $icon = "group"; $colorName = "red"; }

    $urlParent = Element::getControlerByCollection($parentType).".detail.id.".$parentId; 
	if($parentType == City::COLLECTION) 
		$urlParent = Element::getControlerByCollection($parentType).".detail.insee.".$parent["insee"].".postalCode.".$parent["cp"]; 

?>

<div class="col-md-12">
	<h1 class="homestead text-<?php echo $colorName; ?>" onclick="loadByHash('#<?php echo $urlParent; ?>');">
		<i class="fa fa-<?php echo $icon; ?>"></i> 
		<?php
			if($parentType == City::COLLECTION) echo "Conseil Citoyen - "; 
			echo $parent['name']; 
		?>
	</h1>
</div>

<div class="col-md-4">
	<img class="img-responsive thumb-profil-parent-dda thumbnail" src="<?php echo $urlPhotoProfil; ?>" alt="/\" >

	<div class="panel-group" id="accordion">
	<?php 
		createAccordionMenu($discussions, 1, "Discuter", "comments", "discuss", "Aucun espace de discussion");
		createAccordionMenu($votes, 2, "Décider", "archive", "vote", "Aucun espace de décision");
		createAccordionMenu($actions, 3, "Agir", "cogs", "actions", "Aucun espace d'action");
	?>
	</div>
</div>


<div class="col-md-8" id="room-container">
</div>

<div class="col-md-8" id="form-create-room">
<?php 
	$listRoomTypes = Lists::getListByName("listRoomTypes");
    foreach ($listRoomTypes as $key => $value) {
        //error_log("translate ".$value);
        $listRoomTypes[$key] = Yii::t("rooms",$value, null, Yii::app()->controller->module->id);
    }
    $tagsList =  Lists::getListByName("tags");
    $params = array(
        "listRoomTypes" => $listRoomTypes,
        "tagsList" => $tagsList
    );
	$this->renderPartial('editRoomSV', $params); 
?>
</div>

<?php 

function createAccordionMenu($elements, $index, $title, $icon, $typeNew, $emptyMsg){
	
	$in = $index == 1 ? "in" : "";
	
	$urlCreate = "";

	echo '<div class="panel panel-default">';

	echo    '<div class="panel-heading bg-dark">
		      <h4 class="panel-title pull-left">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$index.'">
		        	<i class="fa fa-'.$icon.'"></i> '.$title.'
		        </a>
		      </h4>
		      <span class="badge pull-right">'.count($elements).'</span>
		    </div>';

	echo 	'<div id="collapse'.$index.'" class="panel-collapse collapse '.$in.'">';

		        foreach ($elements as $key => $value) {
					echo '<div class="panel-body"><a href="javascript:showRoom(\''.$typeNew.'\', \''.(string)$value["_id"].'\')"><i class="fa fa-comments"></i> '.$value["name"].'</a></div>';
		        } 

			    if(empty($elements)) 
			      	echo '<div class="panel-body"><i class="fa fa-times"></i> '.$emptyMsg.'</div>';

			    echo '<div class="panel-body text-green"><a href="javascript:selectRoomType(\''.$typeNew.'\')"><i class="fa fa-plus"></i> nouveau</a></div>';

	echo 	'</div>';

	echo '</div>';

}
?>



<script type="text/javascript">
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> espaces coopératifs");
});

function showRoom(type, id){

	var url = "";
	if(type=="discuss") url = "comment/index/type/actionRooms";
	if(type=="vote") url = "survey/entries";
	if(type=="actions") url = "rooms/actions";

	$("#room-container").html("<h2 class='text-dark text-left'><i class='fa fa-circle-o-notch fa-spin'></i> Chargement en cours</h2>");
	getAjax('#room-container',baseUrl+'/'+moduleId+'/'+url+"/id/"+id, function(){},"html");
}

</script>
<style>
	
@media screen and (min-width: 1400px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 48%;
  }
}
</style>
</style>
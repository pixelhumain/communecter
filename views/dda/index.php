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

	#accordion .panel-title a{
		font-weight:200;
		color:white;
		font-size:18px;
	}

	#accordion .panel-title a:hover{
		font-weight:400;
	}
	.text-light{
		font-weight: 300;
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
	<h1 class="homestead text-<?php echo $colorName; ?> pull-left" onclick="loadByHash('#<?php echo $urlParent; ?>');">
		<i class="fa fa-<?php echo $icon; ?>"></i> 
		<?php
			if($parentType == City::COLLECTION) echo "Conseil Citoyen - "; 
			echo $parent['name']; 
		?>
	</h1>
</div>

<div class="col-md-4" id="col-menu-spaceco">
	<button class="btn btn-default pull-left" id="btn-reduce-menu"><i class="fa fa-arrows-h"></i></button>
	<img class="img-responsive thumb-profil-parent-dda thumbnail" src="<?php echo $urlPhotoProfil; ?>" alt="/\" >

	<h4 class="text-dark text-light hide-on-reduce-menu"><i class="fa fa-caret-down"></i> Liste des espaces coopératifs</h4>
	<div class="panel-group" id="accordion">
	<?php 
		createAccordionMenu($discussions, 1, "Discussions", "comments", "discuss", "Aucun espace de discussion");
		createAccordionMenu($votes, 2, "Décisions", "archive", "vote", "Aucun espace de décision");
		createAccordionMenu($actions, 3, "Actions", "cogs", "actions", "Aucun espace d'action");
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
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$index.'" class="show-menu-co">
		        	<i class="fa fa-caret-down hide-on-reduce-menu"></i> <i class="fa fa-'.$icon.'"></i> <span class="hide-on-reduce-menu">'.$title.'</span>
		        </a>
		      </h4>
		      <span class="badge pull-right hide-on-reduce-menu">'.count($elements).'</span>
		    </div>';

	echo 	'<div id="collapse'.$index.'" class="panel-collapse collapse '.$in.'">';

		        foreach ($elements as $key => $value) {
		        	$created = ( @$value["created"] ) ? date("d/m/y h:i",$value["created"]) : ""; 
					echo '<div class="panel-body hide-on-reduce-menu">'.
							'<a href="javascript:showRoom(\''.$typeNew.'\', \''.(string)$value["_id"].'\')" class="text-dark">'.
								'<i class="fa fa-'.$icon.'"></i> '.$value["name"]."".
							'</a>'.
						 '</div>';
		        } 

			    if(empty($elements)) 
			      	echo '<div class="panel-body hide-on-reduce-menu"><i class="fa fa-times"></i> '.$emptyMsg.'</div>';

			    echo '<div class="panel-body hide-on-reduce-menu"><a href="javascript:selectRoomType(\''.$typeNew.'\')" class="text-green">'.
			    		'<i class="fa fa-plus"></i> <i class="fa fa-'.$icon.'"></i> Nouvel espace</a>'.
			    	 '</div>';

	echo 	'</div>';

	echo '</div>';

}
?>



<script type="text/javascript">
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> espaces coopératifs");

	$("#btn-reduce-menu").click(function(){
		toogleMenuCo("toogle");
	});
	$(".show-menu-co").click(function(){
		toogleMenuCo(true);
	});
});

function toogleMenuCo(forceOpen){
	var open = $("#col-menu-spaceco").hasClass("col-md-4");
	if(open && forceOpen == "toogle"){
		$("#col-menu-spaceco").removeClass("col-md-4").addClass("col-md-1");
		$("#room-container").removeClass("col-md-8").addClass("col-md-11");
		$(".hide-on-reduce-menu").addClass("hidden");
	}else{
		$("#col-menu-spaceco").removeClass("col-md-1").addClass("col-md-4");
		$("#room-container").removeClass("col-md-11").addClass("col-md-8");
		$(".hide-on-reduce-menu").removeClass("hidden");
	}

	if(forceOpen==true){
		$("#col-menu-spaceco").removeClass("col-md-1").addClass("col-md-4");
		$("#room-container").removeClass("col-md-11").addClass("col-md-8");
		$(".hide-on-reduce-menu").removeClass("hidden");
	}
	if(forceOpen==false){
		$("#col-menu-spaceco").removeClass("col-md-4").addClass("col-md-1");
		$("#room-container").removeClass("col-md-8").addClass("col-md-11");
		$(".hide-on-reduce-menu").addClass("hidden");
	}

}

function showRoom(type, id){

	var url = "";
	if(type=="discuss") url = "comment/index/type/actionRooms";
	if(type=="vote") url = "survey/entries";
	if(type=="actions") url = "rooms/actions";

	$("#room-container").html("<h2 class='text-dark text-left'><i class='fa fa-circle-o-notch fa-spin'></i> Chargement en cours</h2>");
	getAjax('#room-container',baseUrl+'/'+moduleId+'/'+url+"/id/"+id, function(){ toogleMenuCo(false) },"html");
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
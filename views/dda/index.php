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
	
	//Menu::rooms($_GET["id"],$_GET["type"]);
	//$this->renderPartial('../default/panels/toolbar');

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

	if(!isset($_GET["renderPartial"])){
		$this->renderPartial('../rooms/header',array(    
		   					"parent" => $parent, 
	                        "parentId" => $parentId, 
	                        "parentType" => $parentType, 
	                        "fromView" => "rooms.index",
	                        "faTitle" => "connectdevelop",
	                        "colorTitle" => "azure",
	                        "textTitle" => "",
	                        "discussions" => $discussions, 
	                        "votes" => $votes, 
	                        "actions" => $actions, 
	                        "history" => $history, 
	                        "mainPage" => true
	                        ));
		echo '<div class="col-md-12 panel-white padding-15" id="room-container">';
   } 
 ?>
<div class="panel-group" id="accordion">
	<?php 
		$auth = Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId);
		createAccordionMenu($discussions, 1, "Discussions", "comments", "discuss", "Aucun espace de discussion", $auth);
		createAccordionMenu($votes, 2, "Décisions", "archive", "vote", "Aucun espace de décision", $auth);
		createAccordionMenu($actions, 3, "Actions", "cogs", "actions", "Aucun espace d'action", $auth);
	?>
</div>

<div id="endOfRoom"></div>
<?php 
	function createAccordionMenu($elements, $index, $title, $icon, $typeNew, $emptyMsg, $auth){
	
	$in = $index == 1 ? "in" : "";
	
	echo '<div class="panel panel-default">';

	echo    '<div class="panel-heading bg-dark">
		      <h4 class="panel-title pull-left">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$index.'" class="show-menu-co">
		        	<i class="fa fa-angle-down hide-on-reduce-menu"></i> <i class="fa fa-'.$icon.'"></i> <span class="hide-on-reduce-menu">'.$title.'</span>
		        </a>
		      </h4>
		      <span class="badge pull-right hide-on-reduce-menu">'.count($elements).'</span>
		    </div>';

	echo 	'<div id="collapse'.$index.'" class="panel-collapse collapse '.$in.'">';

		        foreach ($elements as $key => $value) {
		        	$created = ( @$value["created"] ) ? date("d/m/y h:i",$value["created"]) : ""; 
		        	$col = Survey::COLLECTION;
			        $attr = 'survey';
		        	if( @$value["type"] == ActionRoom::TYPE_ACTIONS ){
			        	$col = ActionRoom::TYPE_ACTIONS;
			        	$attr = 'room';
			        }
					echo '<div class="panel-body hide-on-reduce-menu">'.
							'<a href="javascript:" onclick="showRoom(\''.$typeNew.'\', \''.(string)$value["_id"].'\')" class="text-dark">'.
								'<i class="fa fa-'.$icon.'"></i> '.$value["name"]." <span class='badge badge-success pull-right'>".PHDB::count($col,array($attr =>(string)$value["_id"]))."</span>".
							'</a>'.
						 '</div>';
		        } 

			    if(empty($elements)) 
			      	echo '<div class="panel-body hide-on-reduce-menu"><i class="fa fa-times"></i> '.$emptyMsg.'</div>';

			    echo '<div class="panel-body hide-on-reduce-menu">';
			    	if($auth==true) 
			    	echo '<a href="javascript:" onclick="selectRoomType(\''.$typeNew.'\')" data-toggle="modal" 
			    			data-target="#modal-create-room" class="text-green">'.
			    			'<i class="fa fa-plus"></i> <i class="fa fa-'.$icon.'"></i> Nouvel espace'.
			    		'</a>';
			    echo  '</div>';

	echo 	'</div>';

	echo '</div>';
}

if(!isset($_GET["renderPartial"])){
  echo "</div>"; // ferme le id="room-container"
}
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> espaces coopératifs");
	$(".main-col-search").addClass("assemblyHeadSection");
});
</script>

<style>
@media screen and (min-width: 1400px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 48%;
  }
}
</style>
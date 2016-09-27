<?php 
/* Author @oceatoon
* ActivityList2 is a pod to any updates of different kind
* Improvement: 
* - make template per types 
*/
 ?>
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
	
/*
	#accordion .panel-title a{
		font-weight:200;
		color:white;
	}*/

	#accordion .panel-title a:hover{
		font-weight:400;
	}
	.text-light{
		font-weight: 300;
	}
}
.datepicker{z-index:12000 !important;}

a h1.text-azure:hover{
	color:#3C5665 !important;
}
</style>

<div class="panel-group" id="accordion">
	<?php 
		createAccordionMenu($list, 1, $title, "Liste Vide");
	?>
</div>

<div id="endOfRoom">
	<a href='javascript:loadByHash("#rooms.index.type.<?php echo (String) $parentType; ?>.id.<?php echo (String) $parentId; ?>")'>
		<i class='fa fa-sign-in'></i> Entrer dans l'espace coopératif 
	</a>
</div>
<?php 
	function createAccordionMenu($elements, $index, $title, $emptyMsg){
	
	$in = $index == 1 ? "in" : "";
	
	echo '<div class="panel panel-default">';

	echo    '<div class="panel-heading bg-dark">
		      <div class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$index.'" class="show-menu-co">
		        	<i class="fa fa-angle-down hide-on-reduce-menu"></i> <span class="hide-on-reduce-menu">'.$title.'</span>
		        	<span class="badge pull-right hide-on-reduce-menu">'.count($elements).'</span>
		        </a>
		      </div>
		      
		    </div>';

	echo 	'<div id="collapse'.$index.'" class="panel-collapse collapse '.$in.'">';

		        foreach ($elements as $key => $value) {
		        	$created = ( @$value["created"] ) ? date("d/m/y h:i",$value["created"]) : ""; 
		        	$updated = (@$value["updated"]) ? "<span class='text-extra-small'>(".round(abs(time() - $value["updated"]) / 60).")</span>" : "";
		        	$col = Survey::COLLECTION;
			        $attr = 'survey';
		        	if( @$value["type"] == ActionRoom::TYPE_ACTIONS ){
			        	$col = ActionRoom::TYPE_ACTIONS;
			        	$attr = 'room';
			        }
			        $elemObj = Element::getElementSpecsByType (@$value["type"]);

			        $onclick = (@$elemObj["hash"]) ? 'loadByHash(\'#'.$elemObj["hash"].(string)$value["_id"].'\')' : "toastr.success('no hash available');";
			        $icon = (@$elemObj["icon"]) ? $elemObj["icon"] : "question-circle";
			        $pod = ($count = PHDB::count($col,array($attr =>(string)$value["_id"]))) ? "<span class='badge badge-success pull-right'>".PHDB::count($col,array($attr =>(string)$value["_id"]))."</span>" : "";
					echo '<div class="panel-body hide-on-reduce-menu">'.
							'<a href="javascript:'.$onclick.'" class="text-dark">'.
								'<i class="fa fa-'.$icon.'"></i> '.$value["name"]." ".$updated." ".$pod.
							'</a>'.
						 '</div>';
		        } 

		         if(empty($elements)) 
			      	echo '<div class="panel-body hide-on-reduce-menu"><i class="fa fa-times"></i> '.$emptyMsg.'</div>';

	echo 	'</div>';

	echo '</div>';
}

if(!isset($_GET["renderPartial"]) && !isset($renderPartial)){
  echo "</div>"; // ferme le id="room-container"
}
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	//setTitle("Espaces Coopératifs","connectdevelop");
	$(".main-col-search").addClass("assemblyHeadSection");
	$(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
});

<?php if(isset($renderPartial)){ ?>
function loadRoom(type, id){
	
	var mapUrl = { 	"all": 
						{ "url"  : "rooms/index/type/<?php echo $parentType; ?>", 
						  "hash" : "rooms.index.type.<?php echo $parentType; ?>"
						} ,
					"discuss": 
						{ "url"  : "comment/index/type/actionRooms", 
						  "hash" : "comment.index.type.actionRooms"
						} ,
					"vote": 
						{ "url"  : "survey/entries", 
						  "hash" : "survey.entries"
						} ,
					"entry" :
						{ "url"  : "survey/entry",
						  "hash" : "survey.entry",
						},
					"actions": 
						{ "url"  : "rooms/actions", 
						  "hash" : "rooms.actions"
						} ,
					"action":
						{
							"url" : "rooms/action",
							"hash" : "rooms.action",
						}
				}

	var thiHash = "#"+mapUrl[type]["hash"]+".id."+id;
	loadByHash(thiHash);
}
<?php } ?>
</script>

<style>
@media screen and (min-width: 1400px) {
  .mixcontainer .mix, .mixcontainer .gap{
    width: 48%;
  }
}
</style>
<?php 
$cssAnsScriptFilesTheme = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->theme->baseUrl."/assets");

Menu::rooms($_GET["id"],$_GET["type"]);
$this->renderPartial('../default/panels/toolbar');

$moduleId = Yii::app()->controller->module->id;
?>

<style>
.assemblyHeadSection {  
  /*background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyHead.png); */
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/bg/noise_lines.png); 

  /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
  background-color: #fff;
  background-repeat: repeat;
  /*background-position: 0px -50px;*/
  /*background-size: 100% auto;*/
}/*
.assemblyHeadSection {  
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyHead.png);
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: 0px -50px;
  background-size: 100% auto;
}*/

  h1.citizenAssembly-header{
    background-color: rgba(255, 255, 255, 0.4);
    padding: 30px;
    padding-top:0px;
    margin-bottom: -3px;
    font-size: 32px;
    margin-top:90px;
    padding-bottom: 100px;
    -moz-box-shadow: 0px 3px 10px 1px #656565;
	-webkit-box-shadow: 0px 3px 10px 1px #656565;
	-o-box-shadow: 0px 3px 10px 1px #656565;
	box-shadow: 0px 3px 10px 1px #656565;
  }
#main-panel-room{
	/*margin-top:100px;*/
}

a.text-white {
    color: #FFF;
}

.tr-room{
	margin:5px 0px;
}


#thumb-profil-parent{
	margin-top:-60px;
	margin-bottom:20px;
	-moz-box-shadow: 0px 3px 10px 1px #656565;
	-webkit-box-shadow: 0px 3px 10px 1px #656565;
	-o-box-shadow: 0px 3px 10px 1px #656565;
	box-shadow: 0px 3px 10px 1px #656565;
}

.panel-heading .panel-heading-tabs {
    list-style: none;
    top: 0;
    right: 0;
    position: absolute;
    margin: 0;
    padding: 0;
}
.rate .value {
    font-size: 30px !important;
    font-weight: 600;
}
.panel-heading .panel-heading-tabs > li {
    float: left;
    padding: 0 15px;
    border-left-width: 1px;
    border-left-style: solid;
    border-left-color: inherit;
    height: 50px;
    line-height: 50px;
}
.panel-title{
	font-size:18px !important;
	font-weight: 600;
}

.directoryLines a.entryname {
    font-size: 1.4em;
    font-weight: 200;
    margin-left: 4px;
}

.directoryLines a.entryname_vote {
    font-size: 1.2em;
    font-weight: 300;
    margin-left: 4px;
}

.nav-menu-rooms{
	margin-top: -50px;
}

.tab-pane{
	background-color: white;
}


blockquote {border: 1px solid gray; cursor: pointer;}
blockquote:hover {border: 1px solid #E33551; }
blockquote.active {border: 1px solid #E33551; cursor: pointer;}
</style>


<h1 class=" text-dark center citizenAssembly-header" style="font-size:27px;">
    <?php 
    	//var_dump($parent);
		$urlPhotoProfil = "";
		if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
	      $urlPhotoProfil = Yii::app()->createUrl($parent['profilImageUrl']);
	    else
	      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
		$icon = "comments";	
		if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
	  	if($parentType == Organization::COLLECTION) $icon = "group";
	  	if($parentType == Person::COLLECTION) $icon = "user";
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    <br>
	<span class="homestead" style="padding:10px;">
		<a href="javascript:loadByHash('#<?php echo Element::getControlerByCollection($_GET["type"]); ?>.detail.id.<?php echo $_GET["id"]; ?>');" class="text-dark"><i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $parent['name']; ?></a>
	</span><br>
	<span class="homestead text-azure" style="padding:10px; font-size:0.8em;">
		<i class='fa fa-connectdevelop'></i> <?php echo Yii::t("rooms","Action Rooms", null, Yii::app()->controller->module->id)?>
	</span>
	<?php 
	$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","JOIN TO PARTICPATE", null, Yii::app()->controller->module->id);
   

    $ctrl = Element::getControlerByCollection($_GET["type"]);
    $btnUrl = "#".$ctrl.".detail.id.".$parentId;
	
	if( $_GET["type"] != Person::COLLECTION && Authorisation::canParticipate(Yii::app()->session['userId'],$_GET["type"],$_GET["id"]) ){ 
		$btnLbl = "<i class='fa fa-plus'></i> ".Yii::t("rooms","Add an Action Room", null, Yii::app()->controller->module->id);
	    $btnUrl = "#rooms.editroom.type.".$_GET["type"].".id.".$_GET["id"];
	} 

	if( $_GET["type"] != Person::COLLECTION ){
	?>
	<div class="col-md-12 center">
		<button class='btn btn-sm btn-success' style='margin-top:10px;margin-bottom:10px;' onclick='loadByHash("<?php echo $btnUrl?>")'><?php echo $btnLbl?></button>
	</div>
	<?php } ?>
</h1>
	    
<div class="" id="main-panel-room">
		     <?php $this->renderPartial('../pod/roomTable',array(    
		   					"history" => $history, 
                            "moduleId" => $moduleId, 
                            "discussions" => $discussions, 
                            "votes" => $votes, 
                            "actions" => $actions, 
                            "nameParentTitle" => $nameParentTitle, 
                            "parent" => $parent, 
                            "parentId" => $parentId, 
                            "parentType" => $parentType )); ?>
</div>




<script type="text/javascript">
var nameParentTitle = "<?php echo $nameParentTitle; ?>";
jQuery(document).ready(function() {
	
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> " + "espaces coopératifs");
	
	$(".main-col-search").addClass("assemblyHeadSection");
	resetDirectoryTable() ;
	$(".DataTables_Table_1_wrapper").addClass("hide");

	$(".explainLink").click(function() {
		    $(".removeExplanation").parent().hide();
			showDefinition( $(this).data("id") );
			return false;
		});

	
	$(".dataTables_length").append("");
});	

function resetDirectoryTable() 
{ 
	console.log("resetDirectoryTable");

	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "_MENU_",
				//"sLengthMenu" : "Montrer _MENU_ lignes",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] ],
			"iDisplayLength" : 10,
			"destroy": true
		});
	} 
	else 
	{
		if( $(".directoryLines").children('tr').length > 0 )
		{
			directoryTable.dataTable().fnDestroy();
			directoryTable.dataTable().fnDraw();
		} else {
			console.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}

function applyStateFilter(str)
{
	console.log("applyStateFilter",str);
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
function clearAllFilters(str){ 
	$( "input[type='search']" ).val("");
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
</script>
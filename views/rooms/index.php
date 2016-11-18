<?php 
$cssAnsScriptFilesTheme = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
$cssAnsScriptFilesTheme = array(
	'/css/rooms/header.css'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->theme->baseUrl."/assets");

Menu::rooms($_GET["id"],$_GET["type"]);
$this->renderPartial('../default/panels/toolbar');

$moduleId = Yii::app()->controller->module->id;
?>

<style>


h1.citizenAssembly-header{
  padding-bottom:60px !important;
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

    .row.vote-row.contentProposal{
	   	position: absolute;
		padding-top: 5px;
		top: 350px;
		background-color: white;
		width: 100%;
		z-index: 0;
    }
    .row.vote-row.parentSpaceName{
	   	position: absolute;
		padding-top: 5px;
		top: 300px;
		background-color: white;
		width: 100%;
		height:50px;
		z-index: 1;
		-moz-box-shadow:  0px 0px 6px 0px rgba(101, 101, 101, 0.39);
		-webkit-box-shadow:  0px 0px 6px 0px rgba(101, 101, 101, 0.39);
		-o-box-shadow:  0px 0px 6px 0px rgba(101, 101, 101, 0.39);
		box-shadow:  0px 0px 6px 0px rgba(101, 101, 101, 0.39);
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5);
    }
    .row.vote-row.parentSpaceName h1{
    	padding-top:10px;
		margin:0px !important;
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
 #main-panel-room .tab-content {
      min-height: 300px;
      -moz-box-shadow: 0px 2px 10px -2px rgb(101, 101, 101);
      -webkit-box-shadow: 0px 2px 10px -2px rgb(101, 101, 101);
      -o-box-shadow: 0px 2px 10px -2px rgb(101, 101, 101);
      box-shadow: 0px 2px 10px -2px rgb(101, 101, 101);
  }


blockquote {border: 1px solid gray; cursor: pointer;}
blockquote:hover {border: 1px solid #E33551; }
blockquote.active {border: 1px solid #E33551; cursor: pointer;}
</style>

    <?php $this->renderPartial('../rooms/header',array(    
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
                            
                            )); ?>
	    
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
var nameParentTitle = "<?php echo htmlspecialchars($nameParentTitle); ?>";
jQuery(document).ready(function() {
	
	setTitle("espaces coopératifs","connectdevelop");
	$(".main-col-search").addClass("assemblyHeadSection");
	resetDirectoryTable() ;
	$(".DataTables_Table_1_wrapper").addClass("hide");

	$(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
	$(".dataTables_length").append("");
	
	activeTab = <?php echo (@$_GET["tab"]) ? $_GET["tab"] : "1"?>;
	$(".nav-menu-rooms li:nth-child("+activeTab+") a").trigger("click");
});	

function resetDirectoryTable() 
{ 
	mylog.log("resetDirectoryTable");

	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				//"url": "<?php echo Yii::app()->theme->baseUrl?>/assets/plugins/DataTables/media/js/fr.js"
			    "sProcessing":     "Traitement en cours...",
			    "sSearch":         "Rechercher&nbsp;:",
			    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
			    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
			    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
			    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			    "sInfoPostFix":    "",
			    "sLoadingRecords": "Chargement en cours...",
			    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
			    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
			    "oPaginate": {
			        "sFirst":      "Premier",
			        "sPrevious":   "Pr&eacute;c&eacute;dent",
			        "sNext":       "Suivant",
			        "sLast":       "Dernier"
			    },
			    "oAria": {
			        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
			        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
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
			mylog.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}

function applyStateFilter(str)
{
	mylog.log("applyStateFilter",str);
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
function clearAllFilters(str){ 
	$( "input[type='search']" ).val("");
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
</script>

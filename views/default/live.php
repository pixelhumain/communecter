
<?php  
  	HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/default/live.css'), Yii::app()->theme->baseUrl);
	HtmlHelper::registerCssAndScriptsFiles(array('/js/default/live.js'), $this->module->assetsUrl);
	HtmlHelper::registerCssAndScriptsFiles(array('/js/default/search.js'), $this->module->assetsUrl); ?>

<div class="row headerHome">
<?php 
	$dontShowHeaderPages = array("city/detail");
	if(!@Yii::app()->session["userId"] && !in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id,$dontShowHeaderPages)  )
		$this->renderPartial('../pod/headerHome');
?>
</div>

<div class="col-xs-12 col-md-9 col-feed"  data-tpl="default.live">

	  <h3 class="text-dark homestead pull-left hidden">
		<i class="fa fa-angle-down"></i> <i class="fa fa-send"></i> Publier
	  </h3>
	  
	<div class="col-xs-12 center ">
		
	

	<div id="list_filters">
	  <!--  <div class="col-xs-12 margin-top-15 no-padding">
	    <div id="list_tags_scopes" class="hidden-xs list_tags_scopes"></div> test test test
	  </div> -->
	  
	  <div class="btn-group inline-block hidden" id="menu-directory-type">
	    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Messages" type="news">
	      <i class="fa fa-check-circle-o search_news"></i> <i class="fa fa-rss"></i> <span class="hidden-xs hidden-sm">Messages</span>
	    </button>
	    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Organisations" type="organizations">
	      <i class="fa fa-check-circle-o search_organizations"></i> <i class="fa fa-group"></i> <span class="hidden-xs hidden-sm">Organisations</span>
	    </button>
	    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Projets" type="projects">
	      <i class="fa fa-check-circle-o search_projects"></i> <i class="fa fa-lightbulb-o"></i> <span class="hidden-xs hidden-sm">Projets</span>
	    </button>
	    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Évènements" type="events">
	      <i class="fa fa-check-circle-o search_events"></i> <i class="fa fa-calendar"></i> <span class="hidden-xs hidden-sm">Évènements</span>
	    </button>
	    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Besoins" type="needs">
	      <i class="fa fa-check-circle-o search_needs"></i> <i class="fa fa-cubes"></i> <span class="hidden-xs hidden-sm">Besoins</span>
	    </button>
	  </div>
	  
	  <div class="lbl-scope-list text-red hidden"></div>

		</div>
	</div>

	<div class="col-xs-12 no-padding hidden"><hr></div>

	<?php //$this->renderPartial("first_step_news"); ?> 
	<?php //$this->renderPartial("news/index"); ?> 
	<div class="col-xs-12 no-padding" id="newsstream"></div>
</div>


<div class="col-xs-12 col-md-3 col-updated">
	
	<h3 class="text-red homestead titleNowEvents">
		<div class="btn-group inline-block pull-right" id="menu-directory-type">
			<a href="javascript:toggle('.el-nowList','.el-nowList')" 	class="btnhidden btn btn-sm btn-default tooltips" data-toggle="tooltip" ><?php echo Yii::t("common","All") ; ?></a>
			<a href="javascript:toggle('.event,.events','.el-nowList',1)" class="eventBtn el-nowListBtn btnhidden btn btn-sm btn-default tooltips" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Events") ; ?>"><i class="fa fa-calendar "></i></a>
			<a href="javascript:toggle('.entry,.action,.discuss','.el-nowList',1)" class="entryBtn el-nowListBtn btnhidden btn btn-sm btn-default tooltips" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Cooperative space") ; ?>"><i class="fa fa-archive "></i></a>
			<a href="javascript:toggle('.project,.projects','.el-nowList',1)" 	class="projectBtn el-nowListBtn btnhidden btn btn-sm btn-default tooltips" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Projects") ; ?>"><i class="fa fa-lightbulb-o "></i></a>
			<a href="javascript:toggle('.organization,.organisations','.el-nowList',1)" class="organizationBtn el-nowListBtn btnhidden btn btn-sm btn-default tooltips" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Organisations") ; ?>"><i class="fa fa-users "></i></a>
			<a href="javascript:enlargeNow();" class="btn btn-sm btn-default"><i class="fa fa-caret-left " id="enlargeNow"></i></a>
			
		</div>
		<span class="pull-right"><i class="fa fa-clock-o"></i> En ce moment</span>
	</h3>
	
	<div class="space20"></div>
	<div class="col-xs-12 no-padding col-nowListC" id="nowList"></div>

</div>

<!-- end: PAGE CONTENT-->
<script>

<?php  $parent = Person::getById(@Yii::app()->session["userId"]); ?>

var searchType = ["organizations", "projects", "events", "needs"];
var allNewsType = ["news", "idea", "question", "announce", "information"];

var liveTypeName = { "news":"<i class='fa fa-rss'></i> Les messages",
					 "idea":"<i class='fa fa-info-circle'></i> Les idées",
					 "question":"<i class='fa fa-question-circle'></i> Les questions",
					 "announce":"<i class='fa fa-ticket'></i> Les annonces",
					 "information":"<i class='fa fa-newspaper-o'></i> Les informations"
					};

var zone =  <?php echo json_encode($zone) ?>;
var liveScopeType = "global";

<?php if(@$type && !empty($type)){ ?>
	searchType = ["<?php echo $type; ?>"];
<?php }else{ ?>
	searchType = $.merge(allNewsType, searchType);
<?php } ?>

var loadContent = '<?php echo @$_GET["content"]; ?>';
jQuery(document).ready(function() {
	//$("#falseInput").on('load',function(){
			//});
	
	var liveType = "<?php echo (@$type && !empty($type)) ? $type : ''; ?>";
	if(typeof liveTypeName[liveType] != "undefined") 
		 liveType = " > "+liveTypeName[liveType];
	else liveType = ", la boite à outils citoyenne connectée " + liveType;

	setTitle("Communecter" + liveType, "<i class='fa fa-heartbeat '></i>");
	
	//showTagsScopesMin("#list_tags_scopes");
	if(typeof zone != "undefined")
		lockScopeOnCityId(zone);
	else
		rebuildSearchScopeInput();
	

    $("#btn-slidup-scopetags").click(function(){
      slidupScopetagsMin();
    });
	$('#btn-start-search').click(function(e){ //mylog.log("alo");
		startSearchLive(false);
    });
	$(".btn-filter-type").click(function(e){
	    var type = $(this).attr("type");
	    var index = searchType.indexOf(type);
	
	    if(type == "all" && searchType.length > 1){
	      $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
	    }
	    if(type == "all" && searchType.length == 1){
	      $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
	    }
	
	    if (index > -1) removeSearchType(type);
	    else addSearchType(type);
  	});

	//initSelectTypeNews();
	/*$(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
	$(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");*/
    $('.tooltips').tooltip();
    searchPage = true;
    createLocalityForSearch(zone);
	startSearchLive(true);
	$(".titleNowEvents .btnhidden").hide();
});








</script>

<?php  
  	HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/default/live.css'), Yii::app()->theme->baseUrl);
	HtmlHelper::registerCssAndScriptsFiles(array('/js/default/live.js'), $this->module->assetsUrl); ?>

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
<script type="text/javascript" >

<?php  $parent = Person::getById(@Yii::app()->session["userId"]); ?>

var searchType = ["organizations", "projects", "events", "needs"];
var allNewsType = ["news", "idea", "question", "announce", "information"];

var liveTypeName = { "news":"<i class='fa fa-rss'></i> Les messages",
					 "idea":"<i class='fa fa-info-circle'></i> Les idées",
					 "question":"<i class='fa fa-question-circle'></i> Les questions",
					 "announce":"<i class='fa fa-ticket'></i> Les annonces",
					 "information":"<i class='fa fa-newspaper-o'></i> Les informations"
					};


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
	<?php if(@$lockCityKey){ ?>
		lockScopeOnCityKey("<?php echo $lockCityKey; ?>");
	<?php }else{ ?>
		rebuildSearchScopeInput();
	<?php } ?>
    $("#btn-slidup-scopetags").click(function(){
      slidupScopetagsMin();
    });
	$('#btn-start-search').click(function(e){ //mylog.log("alo");
		startSearch(false);
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
	startSearch(true);
	$(".titleNowEvents .btnhidden").hide();
});


var timeout;
function startSearch(isFirst){
	//Modif SBAR
	//$(".my-main-container").off();
	if(liveScopeType == "global"){
		showNewsStream(isFirst);
	}else{
		showNewsStream(isFirst);//loadStream(0,5);
	}
	loadLiveNow();
}


function loadLiveNow () { 

    var searchParams = {
      "name":$('.input-global-search').val(),
      "tpl":"/pod/nowList",
      "latest" : true,
      "searchType" : ["<?php echo Event::COLLECTION?>","<?php echo Project::COLLECTION?>",
      				  "<?php echo Organization::COLLECTION?>","<?php echo ActionRoom::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 10 
    };

    
    ajaxPost( "#nowList", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if($('.el-nowList').length==0)
        	$('.titleNowEvents').addClass("hidden");
        else
        	$('.titleNowEvents').removeClass("hidden");
     } , "html" );

    /*searchParams.searchType = ["<?php echo Project::COLLECTION?>"];
    ajaxPost( "#nowListprojects", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if( !$(".titleNowDDA").length ){
            $("#nowListprojects").prepend('<h3 class="text-red homestead pull-left titleNowProject"><i class="fa fa-clock-o"></i> En ce moment : projets</h3>');
            $("#nowListprojects").append('<a href="#project.projectsv" class="lbh btn btn-sm btn-default">Vous créez localement ?</a>');
        }
     } , "html" );

    searchParams.searchType = ["<?php echo Organization::COLLECTION?>"];
    ajaxPost( "#nowListorga", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if( !$(".titleNowDDA").length ){
            $("#nowListorga").prepend('<h3 class="text-red homestead pull-left titleNowOrga"><i class="fa fa-clock-o"></i> En ce moment : organisations</h3>');
            $("#nowListorga").append('<a href="#organization.addorganizationform" class="lbh btn btn-sm btn-default">Vous agissez localement ?</a>');
        }
     } , "html" );

    searchParams.searchType = ["<?php echo ActionRoom::COLLECTION?>"];
    ajaxPost( "#nowListDDA", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if( !$(".titleNowDDA").length )
            $("#nowListDDA").prepend('<h3 class="text-red homestead pull-left titleNowDDA"><i class="fa fa-clock-o"></i> En ce moment : D.D.A</h3>');
     } , "html" );*/
}


function showNewsStream(isFirst){ mylog.log("showNewsStream");

	scrollEnd = false;

	var isFirstParam = isFirst ? "?isFirst=1" : "";
	var tagSearch = $('#searchTags').val().split(',');; //$('#searchBarText').val();
	var levelCommunexionName = { 1 : "CITYKEY",
	                             2 : "CODE_POSTAL",
	                             3 : "DEPARTEMENT",
	                             4 : "REGION"
	                           };
	
	var thisType="ko";
	var urlCtrl = ""
	if(liveScopeType == "global") {
		thisType = "city";
		urlCtrl = "/news/index/type/city";
	}
	<?php if(@Yii::app()->session["userId"]){ ?>
	else if(liveScopeType == "community"){
		thisType = "citoyens";
		urlCtrl = "/news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>/isLive/true";
	}
	<?php } ?>
	
	var dataNewsSearch = {};
	if(liveScopeType == "global")
		dataNewsSearch = {
	      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
	      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
	      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
	      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),

	    };

    dataNewsSearch.tagSearch = tagSearch;
    dataNewsSearch.searchType = searchType; 
    dataNewsSearch.textSearch = $('#searchBarText').val();
       
    //dataNewsSearch.type = thisType;
    //var myParent = <?php echo json_encode(@$parent)?>;
    //dataNewsSearch.parent = { }

  var loading = "<div class='loader text-dark '>"+
		"<span style='font-size:25px;' class='homestead'>"+
			"<i class='fa fa-spin fa-circle-o-notch'></i> "+
			"<span class='text-dark'>Chargement en cours ...</span>" + 
	"</div>";

	//loading = "";

	if(isFirst){ //render HTML for 1st load
		$("#newsstream").html(loading);
		ajaxPost("#newsstream",baseUrl+"/"+moduleId+urlCtrl+"/date/0"+isFirstParam,dataNewsSearch, function(news){
			showTagsScopesMin(".list_tags_scopes");
			if(loadContent != ''){
				if(userId){
					showFormBlock(true);
					if(loadContent.indexOf("%hash%"))
						loadContent = loadContent.replace("%hash%", "#");
					$("#get_url").val(loadContent);
					$("#get_url").trigger("input");
				}
				else {
					toastr.error('you must be loggued to post on communecter!');
				}
			}
			else
				showFormBlock(false);
			bindTags();
			//$("#newLiveFeedForm").hide();
	 	},"html");
	}else{ //data JSON for load next
		dateLimit=0;currentMonth = null;
		$(".newsTL").html(loading);
		$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+urlCtrl+"/date/"+dateLimit,
		       	dataType: "json",
		       	data: dataNewsSearch,
		    	success: function(data){
			    	//mylog.log("LOAD NEWS BY AJAX");
			    	//mylog.log(data.news);
			    		
			    	var string_tag = getStringTag();

			    	if (string_tag !== '') {
			    		$(".newsTL").html(
			    		'<div class="spine"></div>' + 
						'<div id="div_rss">' + 
							'<a target="_blank" id="btn-rss" class="tooltips btn btn-default  communityBtn btn-menu-element btn-menu-element-directory" role ="button" href="http://127.0.0.1/ph/api/news/get/tags/'+string_tag+'/format/rss">'+
								'<i class="fa fa-rss" aria-hidden="true"></i> ' +
							'</a>' +
						'<div id="btn-rss-test"></div>'
    					);
			    	} else {
			    		$(".newsTL").html(
			    		'<div class="spine"></div>' + 
						'<div id="div_rss">' + 
							'<a target="_blank" id="btn-rss" class="tooltips btn btn-default  communityBtn btn-menu-element btn-menu-element-directory" role ="button" href="http://127.0.0.1/ph/api/news/get/format/rss">'+
								'<i class="fa fa-rss" aria-hidden="true"></i> ' +
							'</a>' +
						'<div id="btn-rss-test"></div>'
    					);
			    	}
		    	
					if(data){
						buildTimeLine (data.news, 0, 5);
						bindTags();
						if(typeof(data.limitDate.created) == "object")
							dateLimit=data.limitDate.created.sec;
						else
							dateLimit=data.limitDate.created;
					}
					loadingData = false;
					$(".my-main-container").bind('scroll', function(){ mylog.log("in linve", loadingData, scrollEnd);
					    if(!loadingData && !scrollEnd){
					          var heightContainer = $("#timeline").height(); mylog.log("heightContainer", heightContainer);
					          var heightWindow = $(window).height();
					          if( ($(this).scrollTop() + heightWindow) >= heightContainer - 200){
					            mylog.log("scroll in news/index MAX");
					            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
					        	
					          }
					    }
					});
				},
				error: function(){
					loadingData = false;
				}
			});
	}
	$("#dropdown_search").hide(300);
	
}


function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
    mylog.log(searchType);
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
  mylog.log(searchType);
}


function hideNewLiveFeedForm(){
	//$("#newLiveFeedForm").hide(200);
	showFormBlock(false);
}

function getStringTag() {
	if (myMultiTags !== "undefined") {

		var string_tag ='';
		var i = 0;

		Object.keys(myMultiTags).forEach(function(tags) {
				  		
			if (myMultiTags[tags].active === true) {
				  	
				if (i == 0) {
					console.log('Un seul tag actif');
					string_tag = tags;
					console.log(string_tag);
	  			} 
	  			else if (i > 0) {
  				console.log('Plusieurs tags actifs')
  				string_tag += ',' + tags;
	  			}
	  			i++;
	  			console.log('i = ' + i);
	  			//console.log(tags);
	  			console.log(string_tag);
			}	 
 	
  		});
	} 
	if (i > 1) {
		string_tag = string_tag + '/multiTags/true';
	}

	return string_tag;

}

</script>
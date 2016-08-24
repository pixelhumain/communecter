<style type="text/css">
	.border-dark{
		border:1px solid #ccc;
	}
	.btn-filter-type{
		font-size:13px;
	}
	.timeline-scrubber{
		display:none;
	}


	#newsHistory .col-md-11{
		width:100% !important;
	}

	.border-dark {
	    border: 1px solid #ccc;
	    box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.3);
	}

	
	#newsFeedForm{
		display:none;
	}

	#menu-directory-type{
		margin-top:-5px;
		margin-left:10px;
	}
	.titleNowEvents{
		margin-top:30px;
	}
	
	#footerDropdown {
	    position: absolute;
	    width: 100%;
	    background-color: white;
	}
	

@media screen and (max-width: 1500px) {	
	.newsFeed{
		width:100% !important;
	}
	.timeline_element{
		margin-left:0px !important;
		margin-right:0px !important;
		max-width:100% !important;
		width:100% !important;	
	}
	.timeline_element::before {
		border:0!important;
	}
	.timeline_element .ico-type-account {
	    text-align: center;
	    height: 40px;
	    width: 40px;
	    font-size: 20px;
	    padding: 5px;
	    float: left;
	    margin-left: -25px;
	    border-radius: 3px 0px 0px 3px;
	    margin-top: 5px;
	    margin-right: 37px;
	}
}
</style>


<div class="row headerHome">
<?php 
	if(!@Yii::app()->session["userId"])
		$this->renderPartial('../pod/headerHome');
?>
</div>

<div class="col-xs-12 col-md-9 col-feed"  data-tpl="default.live">

	  <h3 class="text-dark homestead pull-left hidden">
		<i class="fa fa-angle-down"></i> <i class="fa fa-send"></i> Publier
	  </h3>
	  
	<div class="col-xs-12 center ">
		
	  <div class="col-md-12 no-padding margin-top-15 hidden">
	  	<div class="input-group col-xs-12 pull-left">
	        <input id="searchBarText" data-searchPage="true" type="text" placeholder="rechercher ..." class="input-search form-control">

	        <!-- <span class="input-group-btn">
	              <button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
	                      data-toggle="tooltip" data-placement="bottom" title="Actualiser les résultats">
	                      <i class="fa fa-refresh"></i>
	              </button>
	        </span> -->
	    </div> 
	    <button class="btn btn-sm tooltips hidden-xs pull-left hidden" id="btn-slidup-scopetags" 
	            style="margin-left:15px;margin-top:5px;"
	            data-toggle="tooltip" data-placement="bottom" title="Afficher/Masquer les filtres">
	            <i class="fa fa-minus"></i>
	    </button>
	    <button data-id="explainNews" class="explainLink btn btn-sm tooltips hidden-xs hidden  pull-left" 
	            style="margin-left:7px;margin-top:5px;"
	            data-toggle="tooltip" data-placement="bottom" title="Comment ça marche ?">
	          <i class="fa fa-question-circle"></i>
	    </button>
	  </div>
	</div>

	<div id="list_filters">
	 <!--  <div class="col-xs-12 margin-top-15 no-padding">
	    <div id="list_tags_scopes" class="hidden-xs list_tags_scopes"></div>
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

	<div class="col-xs-12 no-padding hidden"><hr></div>

	<?php //$this->renderPartial("first_step_news"); ?> 
	<?php //$this->renderPartial("news/index"); ?> 
	<div class="col-xs-12 no-padding" id="newsstream"></div>
</div>


<div class="col-xs-12 col-md-3 col-updated">
	
	<h3 class="text-red homestead titleNowEvents">
		<div class="btn-group inline-block pull-right" id="menu-directory-type">
			<a href="javascript:toggle('.el-nowList','.el-nowList')" 	class="btnhidden btn btn-sm btn-default">Tout</a>
			<a href="javascript:toggle('.event,.events','.el-nowList')" class="btnhidden btn btn-sm btn-default"><i class="fa fa-calendar "></i></a>
			<a href="javascript:toggle('.entre,.action,.discuss','.el-nowList')" class="btnhidden btn btn-sm btn-default"><i class="fa fa-archive "></i></a>
			<a href="javascript:toggle('.project,.projects','.el-nowList')" 	class="btnhidden btn btn-sm btn-default"><i class="fa fa-lightbulb-o "></i></a>
			<a href="javascript:toggle('.organization,.organisations','.el-nowList')" class="btnhidden btn btn-sm btn-default"><i class="fa fa-users "></i></a>
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


var liveScopeType = "global";

<?php if(@$type && !empty($type)){ ?>
	searchType = ["<?php echo $type; ?>"];
<?php }else{ ?>
	searchType = $.merge(allNewsType, searchType);
<?php } ?>

jQuery(document).ready(function() {
	var liveType = "<?php echo (@$type && !empty($type)) ? $type : ''; ?>";
	if(typeof liveTypeName[liveType] != "undefined") 
		 liveType = liveTypeName[liveType];
	else liveType = "Toute l'actu";

	setTitle("Live'n'Direct > " + liveType, "<i class='fa fa-heartbeat '></i>");
	
	//showTagsScopesMin("#list_tags_scopes");
	<?php if(@$lockCityKey){ ?>
		lockScopeOnCityKey("<?php echo $lockCityKey; ?>");
	<?php } ?>
	
    $("#btn-slidup-scopetags").click(function(){
      slidupScopetagsMin();
    });
	$('#btn-start-search').click(function(e){ console.log("alo");
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
	$(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
	$(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");
    $('.tooltips').tooltip();
    searchPage = true;
	startSearch(true);
	$(".titleNowEvents .btnhidden").hide();
});

function slidupScopetagsMin(show){
	if($("#list_filters").hasClass("hidden")){
	    $("#list_filters").removeClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else{
	    $("#list_filters").addClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}

	if(show==true){
	    $("#list_filters").removeClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else if(show==false){
	    $("#list_filters").addClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}
}

var timeout;
function startSearch(isFirst){
	$(".my-main-container").off();
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
      "searchType" : ["<?php echo Event::COLLECTION?>","<?php echo Project::COLLECTION?>","<?php echo Organization::COLLECTION?>","<?php echo ActionRoom::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 40 
    };

    ajaxPost( "#nowList", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
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


function showNewsStream(isFirst){ console.log("showNewsStream");
	isFirst = isFirst ? "?isFirst=1" : "";
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
		urlCtrl = "/news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>";
	}
	<?php } ?>
	
	var dataNewsSearch = {};
	if(liveScopeType == "global")
		dataNewsSearch = {
	      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
	      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
	      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
	      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(',')
	    };

    dataNewsSearch.tagSearch = tagSearch;
    dataNewsSearch.searchType = searchType; 
        
    //dataNewsSearch.type = thisType;
    //var myParent = <?php echo json_encode(@$parent)?>;
    //dataNewsSearch.parent = { }

  var loading = "<div class='loader text-dark '>"+
		"<span style='font-size:25px;' class='homestead'>"+
			"<i class='fa fa-spin fa-circle-o-notch'></i> "+
			"<span class='text-dark'>Chargement en cours ...</span>" + 
	"</div>";

	

	if(isFirst){ //render HTML for 1st load
		$("#newsstream").html(loading);
		ajaxPost("#newsstream",baseUrl+"/"+moduleId+urlCtrl+"/date/0"+isFirst,dataNewsSearch, function(news){
			showTagsScopesMin(".list_tags_scopes");
			showFormBlock(false);
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
			    	//console.log("LOAD NEWS BY AJAX");
			    	//console.log(data.news);
			    	$(".newsTL").html('<div class="spine"></div>');
					if(data){
						buildTimeLine (data.news, 0, 5);
						//bindTags();
						if(typeof(data.limitDate.created) == "object")
							dateLimit=data.limitDate.created.sec;
						else
							dateLimit=data.limitDate.created;
					}
					loadingData = false;
					$(".my-main-container").scroll(function(){ console.log(loadingData, scrollEnd);
				    if(!loadingData && !scrollEnd){
				          var heightContainer = $("#timeline").height(); console.log("heightContainer", heightContainer);
				          var heightWindow = $(window).height();
				          if( ($(this).scrollTop() + heightWindow) >= heightContainer - 200){
				            console.log("scroll in news/index MAX");
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
    console.log(searchType);
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
  console.log(searchType);
}


function hideNewLiveFeedForm(){
	//$("#newLiveFeedForm").hide(200);
	showFormBlock(false);
}

</script>
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
	#newsHistory .col-md-11{
		width:100% !important;
	}
</style>



<div class="col-sm-12 col-xs-12 col-md-9">

	  <h3 class="text-dark homestead pull-left hidden">
		<i class="fa fa-angle-down"></i> <i class="fa fa-send"></i> Publier
	  </h3>
	  <div class="pull-left col-md-12 col-sm-12 col-xs-12" style="margin:15px 15px 0 0;">
	  	  <div class="col-md-12 col-sm-12 col-xs-12" 
	  	  style="margin-top: 10px; margin-bottom: 5px; margin-left: 0px;padding: 0px 10px;"  id="list_type_news">
		  
		  <div class="btn-group btn-group-sm inline-block" id="menu-type-news">
		    <button class="btn btn-success disabled" 
		    		data-toggle="tooltip" data-placement="bottom" title="Choisissez le type de message que vous souhaitez partager" data-type="news">
		      <i class="fa fa-check-circle-o search_news hidden"></i> <i class="fa fa-plus"></i>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="bottom" title="Publier un messages" data-type="news">
		      <i class="fa fa-check-circle-o search_news hidden"></i> <i class="fa fa-rss"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Message</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="bottom" title="Partager une idée" data-type="idea">
		      <i class="fa fa-circle-o search_organizations hidden"></i> <i class="fa fa-info-circle"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Idée</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="bottom" title="Poser une question" data-type="question">
		      <i class="fa fa-circle-o search_projects hidden"></i> <i class="fa fa-question-circle"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Question</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="bottom" title="Diffuser une annonce" data-type="announce">
		      <i class="fa fa-circle-o search_events hidden"></i> <i class="fa fa-ticket"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Annonce</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="bottom" title="Partager une information" data-type="information">
		      <i class="fa fa-circle-o search_needs hidden"></i> <i class="fa fa-newspaper-o"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Information</span>
		    </button>
		  </div>

		  <a href="#organization.addorganizationform" class="lbh btn btn-sm bg-green tooltips"  style="margin-left:5px;"
		  		data-toggle="tooltip" data-placement="bottom" title="Créer une organisation" type="needs">
		  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-group"></i> 
		  	<span class="hidden-xs hidden-sm hidden">Organisation</span>
		  </a>
		  <a href="#project.projectsv" class="lbh btn btn-sm bg-purple tooltips" style="margin-left:5px;"
		  		data-toggle="tooltip" data-placement="bottom" title="Créer un projet" type="needs">
		  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-lightbulb-o"></i> 
		  	<span class="hidden-xs hidden-sm hidden">Projet</span>
		  </a> 
		  <a href="#event.eventsv" class="lbh btn btn-sm bg-orange tooltips"  style="margin-left:5px;"
		  		data-toggle="tooltip" data-placement="bottom" title="Créer un événement" type="needs">
		  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-calendar"></i> 
		  	<span class="hidden-xs hidden-sm hidden">Événement</span>
		  </a> 
		  
	  </div>
	  </div>
	
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div id="newLiveFeedForm" style="margin-top: 15px;"></div>
	</div>

	

	<div class="col-md-12 col-sm-12 col-xs-12 center">
		
	  <div class="col-md-12 no-padding margin-top-15">
	  	<div class="input-group col-md-12 col-sm-12 col-xs-12 pull-left">
	        <input id="searchBarText" type="text" placeholder="rechercher ..." class="input-search form-control">
	        <span class="input-group-btn">
	              <button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
	                      data-toggle="tooltip" data-placement="bottom" title="Actualiser les résultats">
	                      <i class="fa fa-refresh"></i>
	              </button>
	        </span>
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

	<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; margin-bottom: 0px; margin-left: 0px;"  id="list_filters">
	  <div class="col-md-12 col-sm-12 col-xs-12 margin-top-15 no-padding">
	    <div id="list_tags_scopes" class="hidden-xs list_tags_scopes"></div>
	  </div>
	  
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

	<div class="col-md-12 col-sm-12 col-xs-12 no-padding"><hr></div>

	<?php //$this->renderPartial("first_step_news"); ?> 
	<?php //$this->renderPartial("news/index"); ?> 
	<div class="col-md-12 col-sm-12 col-xs-12 no-padding" id="newsstream"></div>
</div>


<div class="col-sm-12 col-xs-12 col-md-3">
	
	<h3 class="col-sm-12 text-red homestead"><i class="fa fa-clock-o"></i> En ce moment : évènements</h3>
	<div class="col-sm-12 col-xs-12" id="nowListevents"></div>
	<h3 class="col-sm-12 text-red homestead"><i class="fa fa-clock-o"></i> En ce moment : projets</h3>
	<div class="col-sm-12 col-xs-12" id="nowListprojects"></div>
	<h3 class="col-sm-12 text-red homestead"><i class="fa fa-clock-o"></i> En ce moment : organisations</h3>
	<div class="col-sm-12 col-xs-12" id="nowListorga"></div>
	
	
</div>

<!-- end: PAGE CONTENT-->
<script>
var searchType = ["organizations", "projects", "events", "needs", "news"];
var allNewsType = ["news", "idea", "question", "announce", "information"];

<?php if(@$type && !empty($type)){ ?>
	searchType = ["<?php echo $type; ?>"];
<?php }else{ ?>
	searchType = $.merge(allNewsType, searchType);
<?php } ?>

jQuery(document).ready(function() {
	setTitle("Live'n'Direct","<i class='fa fa-heartbeat '></i>");
	
	showTagsScopesMin("#list_tags_scopes");
	
	$('#btn-start-search').click(function(e){
        startSearch();
    });
    $("#btn-slidup-scopetags").click(function(){
      slidupScopetagsMin();
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

	initSelectTypeNews();
	startSearch();

	loadLiveNow();

});

function loadLiveNow () { 

var searchParams = {
	  "name":"",
	  "tpl":"/pod/nowList",
      "latest" : true,
      "searchType" : ["<?php echo Event::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityNAME" : $('#searchLocalityNAME').val().split(','),
      "searchLocalityCODE_POSTAL_INSEE" : $('#searchLocalityCODE_POSTAL_INSEE').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityINSEE" : $('#searchLocalityINSEE').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 10 
  	};

	ajaxPost( "#nowListevents", baseUrl + "/" + moduleId + '/search/globalautocomplete' , searchParams, function() { 
		bindLBHLinks();
		$("#nowListevents").append('<a href="#event.eventsv" class="lbh btn btn-sm btn-default">Vous bougez localement ?</a>');
	 } , "html" );

	var searchParams = {
	  "name":"",
	  "tpl":"/pod/nowList",
      "latest" : true,
      "searchType" : ["<?php echo Project::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityNAME" : $('#searchLocalityNAME').val().split(','),
      "searchLocalityCODE_POSTAL_INSEE" : $('#searchLocalityCODE_POSTAL_INSEE').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityINSEE" : $('#searchLocalityINSEE').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 10 
  	};

	ajaxPost( "#nowListprojects", baseUrl + "/" + moduleId + '/search/globalautocomplete' , searchParams, function() { 
		bindLBHLinks();
		$("#nowListprojects").append('<a href="#project.projectsv" class="lbh btn btn-sm btn-default">Vous créez localement ?</a>');
	 } , "html" );

	

	var searchParams = {
	  "name":"",
	  "tpl":"/pod/nowList",
      "latest" : true,
      "searchType" : ["<?php echo Organization::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityNAME" : $('#searchLocalityNAME').val().split(','),
      "searchLocalityCODE_POSTAL_INSEE" : $('#searchLocalityCODE_POSTAL_INSEE').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityINSEE" : $('#searchLocalityINSEE').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 10 
  	};

	ajaxPost( "#nowListorga", baseUrl + "/" + moduleId + '/search/globalautocomplete' , searchParams, function() { 
		bindLBHLinks();
		$("#nowListorga").append('<a href="#organization.addorganizationform" class="lbh btn btn-sm btn-default">Vous agissez localement ?</a>');
	 } , "html" );

}

function buildHotStuffList(list) { 
	$.each(list,function(i,v) { 
		
	html = '<div class="border-dark margin-bottom-30 col-xs-12 col-md-12 no-padding">'+
		'<div class=" "><img src="http://placehold.it/250x100" class="img-responsive"></div>'+
	    '<div class="padding-5 ">'+
			'<br/>'+
			'<div class="text-right">'+
				'<i class="fa fa-<?php echo Element::getFaIcon(@$v["type"])?>"></i> <?php echo Element::getLink(@$v["type"],(string)@$v["_id"])?>'+
			'</div>'+
	    '</div>'+
	'</div>';
	$('#nowList').html(html);
	});
}	

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
function startSearch(){
	$(".my-main-container").off();
	var name = $('#searchBarText').val();
	if(inseeCommunexion != ""){
		if(name.length>=3 || name.length == 0){
	      var locality = "";
	      if(communexionActivated){
		    if(typeof(cityInseeCommunexion) != "undefined"){
				if(levelCommunexion == 1) locality = cpCommunexion;
				if(levelCommunexion == 2) locality = inseeCommunexion;
			}else{
				if(levelCommunexion == 1) locality = inseeCommunexion;
				if(levelCommunexion == 2) locality = cpCommunexion;
			}
	        if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
	        if(levelCommunexion == 4) locality = inseeCommunexion;
	        if(levelCommunexion == 5) locality = "";
	      } 
	      showNewsStream(name, locality);
	    }else{
	      
	    }   
    }
}


function showNewsStream(name,locality){
	if(typeof(cityInseeCommunexion) != "undefined"){
	    var levelCommunexionName = { 1 : "CODE_POSTAL_INSEE",
		                             2 : "INSEE",
		                             3 : "DEPARTEMENT",
		                             4 : "REGION"
		                           };
	}else{
		var levelCommunexionName = { 1 : "INSEE",
		                             2 : "CODE_POSTAL_INSEE",
		                             3 : "DEPARTEMENT",
		                             4 : "REGION"
		                           };
	}
	var dataNewsSearch = {
      "tagSearch" : name, 
      "searchLocalityNAME" : $('#searchLocalityNAME').val().split(','),
      "searchLocalityCODE_POSTAL_INSEE" : $('#searchLocalityCODE_POSTAL_INSEE').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityINSEE" : $('#searchLocalityINSEE').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "searchType" : searchType, 
      //"searchBy" : levelCommunexionName[levelCommunexion]
  };

	$("#newsstream").html("<div class='loader text-dark '>"+
		"<span style='font-size:25px;' class='homestead'>"+
			"<i class='fa fa-spin fa-circle-o-notch'></i> "+
			"<span class='text-dark'>Chargement en cours ...</span>" + 
	"</div>");
	ajaxPost("#newsstream",baseUrl+"/"+moduleId+"/news/index/type/city?isFirst=1",dataNewsSearch, function(){
		showTagsScopesMin("#scopeListContainer");
		showFormBlock(false);
		$("#newLiveFeedForm").hide();
 	},"html");
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

function initSelectTypeNews(){

	var msgTypesNews = { 
		"news" 			: "<i class='fa fa-file-text-o'></i> Rédiger votre message",
		"idea" 			: "<i class='fa fa-info-circle'></i> Partager, expliquer, détailler votre idée",
		"question" 		: "<i class='fa fa-question-circle'></i> Poser votre question",
		"announce" 		: "<i class='fa fa-ticket'></i> Rédiger votre annonce, dans ses moindre détails",
		"information" 	: "<i class='fa fa-newspaper-o'></i> Partager votre information"
	};

	$(".btn-type-news").click(function(e){
	    var type = $(this).data("type");
	    
	    $(".btn-type-news").removeClass("active");
	    $(this).addClass("active");
	    
	    $("input[name='type']").val(type);

	    var msg = typeof msgTypesNews[type] != "undefined" ? msgTypesNews[type] : "";
	    msg+='<button class="btn pull-right" onclick="hideNewLiveFeedForm()" style="margin-top: -10px;margin-right: -10px;">'+
	    		'<i class="fa fa-times"></i>'+
	    	 '</button>';
	    $(".header-form-create-news").html("<i class='fa fa-angle-down'></i> "+msg);

	    //showFormBlock(true);
	    $("#newLiveFeedForm").show(200);
	    showFormBlock(true);
  	});
}

function hideNewLiveFeedForm(){
	$("#newLiveFeedForm").hide(200);
	showFormBlock(false);
}
</script>
<style>
.btn-type-news, .btn-scope-type{
	background-color: rgb(255, 255, 255);
	border-color: #C9C9C9;
	padding: 5px 10px !important;
	font-size: 15px !important;
}
.btn-type-news.active{
	background-color: #3C5665;
	border-color: #3C5665;
	color:white !important;
}
.btn-scope-type.active{
	background-color: #2BB0C6;
	border-color: #2BB0C6;
	color:white !important;
}
#list_type_news .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    width:50px;
    border-radius:0 5px 5px 0 !important;
    border-color: #C9C9C9;
	padding: 10px !important;
	font-size: 15px !important;
}
button.btn-start-search{
	font-size:12px!important;
	height:30px!important;
	width:40px!important;
}
button.btn-start-search:hover{
	border-radius:0 4px 4px 0!important;
}
#searchBarText{
	font-size:14px!important;
	height:30px!important;
	padding: 0px 10px !important;
}


div.timeline .date_separator{
	display: none;
}
div.timeline #backToTop.date_separator{
	display: inherit;
}

input.form-control.input-search{
	border-radius:4px 0 0 4px !important;
}
</style>

<!-- <span class='text-dark'><i class='fa fa-angle-down'></i> Filtrer par type</span>
<hr style='margin-top:0px;margin-bottom:0px;border:0!important;'> -->

<div class="col-xs-12 no-padding " 
	 style="margin-top: 0px; margin-bottom: 10px; margin-left: 0px;padding: 0px 10px;"  
	 id="list_type_news">
			  
  <div class="btn-group btn-group-sm inline-block margin-top-10 hidden" id="menu-type-news">
    <button class="btn btn-default btn-type-news tooltips text-dark active" 
    		data-toggle="tooltip" data-placement="top" title="Toute l'actu" data-type="all">
      <i class="fa fa-heartbeat"></i> 
      <span class="hidden-xs hidden-sm hidden-md"></span>
    </button>
    <button class="btn btn-default btn-type-news disabled tooltips text-dark hidden" 
    		data-toggle="tooltip" data-placement="top" title="Messages">
      <i class="fa fa-angle-down"></i> <i class="fa fa-filter"></i> 
      <span class="hidden-xs hidden-sm hidden-md"></span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Messages" data-type="news">
      <i class="fa fa-check-circle-o search_news hidden"></i> <i class="fa fa-rss"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Message</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Idée" data-type="idea">
      <i class="fa fa-circle-o search_organizations hidden"></i> <i class="fa fa-info-circle"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Idée</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Question" data-type="question">
      <i class="fa fa-circle-o search_projects hidden"></i> <i class="fa fa-question-circle"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Question</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Annonce" data-type="announce">
      <i class="fa fa-circle-o search_events hidden"></i> <i class="fa fa-ticket"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Annonce</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Information" data-type="information">
      <i class="fa fa-circle-o search_needs hidden"></i> <i class="fa fa-newspaper-o"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Information</span>
    </button>

    
   <!--  <button class="btn btn-success tooltips" id="btn-start-search"
              data-toggle="tooltip" data-placement="right" title="Actualiser les résultats">
              <i class="fa fa-refresh"></i>
    </button> -->
  </div>

<div class="hidden">
  <button class="btn btn-default  tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Point d'interet" data-type="poi" onclick="openForm ( 'poi' );" >
      <i class="fa fa-map-marker search_needs hidden"></i> <i class="fa fa-map-marker"></i> 
      <span class="hidden-xs hidden-sm hidden-md">POI</span>
    </button>
    <button class="btn btn-default  tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Organisation" data-type="organization" onclick="openForm ( 'organization' );" >
      <i class="fa fa-map-marker search_needs hidden"></i> <i class="fa fa-group"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Organisation</span>
    </button>

    <button class="btn btn-default  tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Évènement" data-type="event" onclick="openForm ( 'event' );" >
      <i class="fa fa-map-marker search_needs hidden"></i> <i class="fa fa-calendar"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Evenement</span>
    </button>

    <button class="btn btn-default  tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Projet" data-type="project" onclick="openForm ( 'project' );" >
      <i class="fa fa-map-marker search_needs hidden"></i> <i class="fa fa-lightbulb-o"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Projet</span>
    </button>
</div>


  <?php if(@$type=="city" && @Yii::app()->session["userId"]){ ?>
  	<div class="pull-left margin-top-10">
  		
  		<div class="btn-group btn-group-sm inline-block scope-global-community">
		  <button class="btn btn-sm btn-default tooltips btn-scope-type text-dark active" data-scope-type="global"
		    data-msg-info="Live public : retrouvez tous les messages publics selon vos lieux favoris"
	  		data-write-info="Envoyez un message public en sélectionnant des lieux"
	  		data-toggle="tooltip" data-placement="bottom" title="Afficher les messages publics">
		  	<i class="fa fa-globe"></i> Public
		  </button>
		  <button style="margin-right:10px;" 
		  	class="btn btn-sm btn-default btn-scope-type tooltips text-dark" data-scope-type="community"
		    data-msg-info="Live communauté : retrouvez tous les messages de vos contacts"
	  		data-write-info="Envoyez un message à vos contacts"
	  		data-toggle="tooltip" data-placement="bottom" title="Afficher les messages de ma communauté">
		  	<i class="fa fa-users"></i> Ma communauté
		  </button>
		  <span class="inline-block text-dark" style="padding:10px 0px;">
		  	<i class="fa fa-angle-down" style="margin-left:5px;"></i> <i class="fa fa-info-circle"></i> 
		  	<span id='msg_live_type'>Live public : retrouvez tous les messages publics selon vos lieux favoris</span>
		  </span>
		</div>
  	<!--
	  <a href="#organization.addorganizationform" class="lbh btn btn-sm btn-default tooltips"  style="margin-left:5px;"
  		data-toggle="tooltip" data-placement="bottom" title="Créer une organisation">
	  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i>
	  	<span class="hidden-xs hidden-sm hidden">Organisation</span>
	  </a>
	  <a href="#organization.addorganizationform" class="lbh btn btn-sm bg-green tooltips"  style="margin-left:5px;"
	  		data-toggle="tooltip" data-placement="bottom" title="Créer une organisation">
	  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-group"></i> 
	  	<span class="hidden-xs hidden-sm hidden">Organisation</span>
	  </a>
	  <a href="#project.projectsv" class="lbh btn btn-sm bg-purple tooltips" style="margin-left:5px;"
	  		data-toggle="tooltip" data-placement="bottom" title="Créer un projet">
	  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-lightbulb-o"></i> 
	  	<span class="hidden-xs hidden-sm hidden">Projet</span>
	  </a> 
	  <a href="#event.eventsv" class="lbh btn btn-sm bg-orange tooltips"  style="margin-left:5px;"
	  		data-toggle="tooltip" data-placement="bottom" title="Créer un événement">
	  	<i class="fa fa-plus hidden-xs hidden-sm hidden-md"></i> <i class="fa fa-calendar"></i> 
	  	<span class="hidden-xs hidden-sm hidden">Événement</span>
	  </a>--> 
	</div>
  <?php } ?>

</div>

<div id="newLiveFeedForm" class="col-xs-12 no-padding margin-bottom-15"></div>

<div id="toogle_filters">
	<div class="space-20"></div>
	<div class='text-dark col-xs-12 no-padding pull-left margin-top-15 hidden'>
		<i class='fa fa-angle-down'></i> Filtrer par tags et lieux<br>
		<hr style='margin-top:5px;margin-bottom:5px; width:100%;'>
	</div>

	<div id="scopeListContainer" class="list_tags_scopes col-xs-12 no-padding"></div>

	<?php if(@$filterTypeNews!="" && false) { ?>
		<?php $spec = Element::getElementSpecsByType($filterTypeNews); ?>
		<div class='text-dark col-xs-12 no-padding pull-left margin-bottom-15'>
			<hr style='margin-top:5px;margin-bottom:0px; width:100%;'>
			<h3 class="text-<?php echo $spec["text-color"]; ?> homestead text-center">
				<i class="fa fa-angle-down"></i> <i class="fa fa-<?php echo $spec["icon"]; ?>"></i> Actus <?php echo Yii::t("common",$filterTypeNews)."s"; ?>
			</h3>
		</div>
	<?php } ?>



	<div class="col-sm-offset-3 col-md-offset-3 col-lg-offset-4 col-sm-6 col-md-6 col-lg-4 col-xs-12" style="margin-top:15px!important;">
	  	<div class="input-group col-xs-12 pull-left">	        
	        <input id="searchBarText" data-searchPage="true" type="text" placeholder="rechercher ..." class="input-search form-control">
	        <span class="input-group-btn">
	              <button class="btn bg-azure btn-start-search tooltips" id="btn-start-search"
	                      data-toggle="tooltip" data-placement="bottom" title="Actualiser les résultats">
	                      <i class="fa fa-refresh"></i>
	              </button>
	        </span>
	        
	    </div> 
	    <!-- <button class="btn btn-sm tooltips hidden-xs pull-left hidden" id="btn-slidup-scopetags" 
	            style="margin-left:15px;margin-top:5px;"
	            data-toggle="tooltip" data-placement="bottom" title="Afficher/Masquer les filtres">
	            <i class="fa fa-minus"></i>
	    </button>
	    <button data-id="explainNews" class="explainLink btn btn-sm tooltips hidden-xs hidden  pull-left" 
	            style="margin-left:7px;margin-top:5px;"
	            data-toggle="tooltip" data-placement="bottom" title="Comment ça marche ?">
	          <i class="fa fa-question-circle"></i>
	    </button> -->
	</div>
</div>
<script type="text/javascript">

var currentType = "<?php echo @$type ? $type : ""; ?>";

jQuery(document).ready(function() 
{
	initSelectTypeNews();
	showTagsScopesMin("#scopeListContainer");

	$('#btn-start-search').click(function(e){
		scrollEnd = false;
		if(location.hash.indexOf("#default.live")==0)
	    	startSearch(false);
		else{
			dateLimit = 0;
			loadStream(0, 5);
		}
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


  if(currentType == "city"){
  	$(".btn-scope-type").click(function(){

  		var scopeType = $(this).data("scope-type");
  		if(scopeType == "global" || scopeType == "community") 
  			liveScopeType = scopeType;

  		if(scopeType == "community") {
  			parent = "<?php echo @Yii::app()->session["userId"]; ?>";
  			parentType = "citoyens";
  			contextParentType = "citoyens";
  			contextParentId = "<?php echo @Yii::app()->session["userId"]; ?>";
  			$("input[name='scope']").val("restricted");
  			showTagsScopesMin("#scopeListContainer");
  			$(".list_tags_scopes").addClass("tagOnly");
  		}else{
  			parent = null;
  			parentType = "city";
  			contextParentType = "city";
  			contextParentId = "";
  			$("input[name='scope']").val("public");
  			showTagsScopesMin("#scopeListContainer");
  			$(".list_tags_scopes").removeClass("tagOnly");
  		}
		$(".btn-scope-type").removeClass("active");
		$(this).addClass("active");

		console.log("liveScopeType", liveScopeType);
		//scrollEnd = false;
		showNewsStream(false);
  	});
  }

});

var allNewsType = ["news", "idea", "question", "announce", "information"];

function initSelectTypeNews(){

	var msgTypesNews = { 
		"all" 			: "<i class='fa fa-file-text-o'></i> Rédiger un message",
		"news" 			: "<i class='fa fa-file-text-o'></i> Rédiger un message",
		"idea" 			: "<i class='fa fa-info-circle'></i> Partager, expliquer, détailler une idée",
		"question" 		: "<i class='fa fa-question-circle'></i> Poser une question",
		"announce" 		: "<i class='fa fa-ticket'></i> Rédiger une annonce, dans ses moindre détails",
		"information" 	: "<i class='fa fa-newspaper-o'></i> Partager une information"
	};

	$(".btn-type-news").click(function(e){
	    var type = $(this).data("type");

	    //searchType = [];
	    $(".btn-type-news").removeClass("active");
	    $(this).addClass("active");
	    
	    var newsType = type != "all" ? type : "news";
	    $("input[name='type']").val(newsType);

	    var msg = typeof msgTypesNews[type] != "undefined" ? msgTypesNews[type] : "";
	    // msg+='<button class="btn pull-right" onclick="hideNewLiveFeedForm()" style="margin-top: -10px;margin-right: -10px;">'+
	    // 		'<i class="fa fa-times"></i>'+
	    // 	 '</button>';
	    $(".header-form-create-news").html("<i class='fa fa-angle-down'></i> "+msg);

	    
	    if(type != "all")
	    searchType = [type];
		else 
		searchType = $.merge( ["organizations", "projects", "events", "needs"], allNewsType);

		if(location.hash.indexOf("#default.live")==0)
	    	startSearch(false);
		else{
			dateLimit = 0;
			loadStream(0, 5);
		}
	    
	    //showFormBlock(true);
  	});

  	$(".btn-scope-type").click(function(){
  		$("#msg_live_type").html($(this).data("msg-info"));
  		$("#info-write-msg").html($(this).data("write-info"));

  	});
}

</script>
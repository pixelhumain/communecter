<style>
.btn-type-news, .btn-scope-type{
	background-color: rgb(255, 255, 255);
	border-color: #C9C9C9;
	padding: 10px !important;
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
</style>

<!-- <span class='text-dark'><i class='fa fa-angle-down'></i> Filtrer par type</span>
<hr style='margin-top:0px;margin-bottom:0px;border:0!important;'> -->

<div class="col-md-12 col-sm-12 col-xs-12 no-padding" 
	 style="margin-top: 10px; margin-bottom: 10px; margin-left: 0px;padding: 0px 10px;"  
	 id="list_type_news">
			  
  <div class="btn-group btn-group-sm inline-block margin-top-10" id="menu-type-news">
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
    <button class="btn btn-success tooltips" id="btn-start-search"
              data-toggle="tooltip" data-placement="right" title="Actualiser les résultats">
              <i class="fa fa-refresh"></i>
    </button>
  </div>



  <?php if(@$type=="city"){ ?>
  	<div class="pull-right margin-top-10">
  		<i class="fa fa-eye text-dark hidden" style="margin-right:5px;"></i> 
  		<div class="btn-group btn-group-sm inline-block">
		  <button class="btn btn-sm btn-default tooltips btn-scope-type text-dark active" data-scope-type="global"
	  		data-toggle="tooltip" data-placement="bottom" title="Tout le réseau">
		  	<i class="fa fa-globe"></i>
		  </button>
		  <button class="btn btn-sm btn-default btn-scope-type tooltips text-dark" data-scope-type="community"
	  		data-toggle="tooltip" data-placement="bottom" title="Seulement ma communauté">
		  	<i class="fa fa-users"></i>
		  </button>
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

<div id="newLiveFeedForm" class="col-md-12 col-sm-12 no-padding margin-bottom-10"></div>

<div id="toogle_filters">
	<div class="space-20"></div>
	<div class='text-dark col-xs-12 no-padding pull-left margin-top-15 hidden'>
		<i class='fa fa-angle-down'></i> Filtrer par tags et lieux<br>
		<hr style='margin-top:5px;margin-bottom:5px; width:100%;'>
	</div>

	<div id="scopeListContainer" class="list_tags_scopes col-md-12 col-sm-12 col-xs-12 no-padding"></div>

	<div class='text-dark col-xs-12 no-padding pull-left margin-bottom-15'>
		<hr style='margin-top:5px;margin-bottom:0px; width:100%;'>
	</div>
</div>
<script type="text/javascript">

var currentType = "<?php echo @$type ? $type : ""; ?>";

jQuery(document).ready(function() 
{
	initSelectTypeNews();
	showTagsScopesMin("#scopeListContainer");

	$('#btn-start-search').click(function(e){
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


  if(currentType == "city"){
  	$(".btn-scope-type").click(function(){

  		var scopeType = $(this).data("scope-type");
  		if(scopeType == "global" || scopeType == "community") 
  			liveScopeType = scopeType;

  		if(scopeType == "community") {
  			parent = "<?php echo @Yii::app()->session["userId"]; ?>";
  			parentType = "citoyens";
  		}else{
  			parent = null;
  			parentType = "city";
  		}
		$(".btn-scope-type").removeClass("active");
		$(this).addClass("active");

		console.log("liveScopeType", liveScopeType);
		startSearch(false);
  	});
  }

});



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
	    
	    $("input[name='type']").val(type);

	    var msg = typeof msgTypesNews[type] != "undefined" ? msgTypesNews[type] : "";
	    // msg+='<button class="btn pull-right" onclick="hideNewLiveFeedForm()" style="margin-top: -10px;margin-right: -10px;">'+
	    // 		'<i class="fa fa-times"></i>'+
	    // 	 '</button>';
	    $(".header-form-create-news").html("<i class='fa fa-angle-down'></i> "+msg);

	    //showFormBlock(true);
	    //$("#newLiveFeedForm").show(200);

	    //var allNewsType = ["news", "idea", "question", "announce", "information"];
	    if(type != "all")
	    searchType = [type];
		else 
		searchType = $.merge( ["organizations", "projects", "events", "needs"], allNewsType);

	    startSearch(false);
	    
	    //showFormBlock(true);
  	});
}

</script>
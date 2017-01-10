<?php 

	HtmlHelper::registerCssAndScriptsFiles( array('/css/timeline2.css',
											) , Yii::app()->theme->baseUrl. '/assets');


	$cssAnsScriptFilesModule = array(
		'/js/news/index.js',
		'/js/news/autosize.js',
		'/js/news/newsHtml.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "freedom") ); 
?>
<style>
	
.btn-create-news{
    margin-top:0px;
    z-index: 10;
    border-radius: 0 50%;
    -ms-transform: rotate(7deg);
    -webkit-transform: rotate(7deg);
    transform: rotate(-45deg);
}
.btn-create-news:hover{
    background-color: white!important;
    color:#34a853!important;
    border: 2px solid #34a853!important;

}

.main-btn-scopes {
    margin-top: -57px;
}

#formCreateNewsTemp{
	display: none!important;
}
#formCreateNewsTemp .form-create-news-container, #formActivity{
    max-width: 60%;
    margin-left:20%;
}
#sub-menu-left{
    margin-top:1px;
    /*text-align: left;*/
}
#sub-menu-left .btn{
    background-color: #4285f4;
    border-color: #4285f4;
	color:white;
    /*border-radius:80px;*/
    font-weight: 700;
}
#sub-menu-left .btn.active{
    background-color: #fff;
    color: #4285f4;
}
#sub-menu-left .btn:hover{
    background-color: #1c6df5;
    border-color: #4285f4;
}
#sub-menu-left .btn.active:hover{
    background-color: #fff;
    color: #4285f4;
}
#sub-menu-left .btn.bg-yellow{
	border-color: transparent;
}


#sub-menu-left.subsub .btn{
	width:100%;    
	text-align: left;
	background-color: white;
    border-color: white;
	color:#4285f4;
}
#sub-menu-left.subsub{
	min-width: 180px;
}

.btn-menu-left-add{
	background-color: transparent !important;
    border-color: transparent !important;
}

</style>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding">

	<div class="col-md-12 col-sm-12 inline page-header text-center margin-top-20">


	    <!-- <h3 id="timeline"><i class="fa fa-newspaper-o"></i><br>Le fil d'actu commun<br><i class="fa fa-angle-down"></i></h3> -->
	    <?php //if(!@$medias || sizeOf($medias) <= 0){ ?>
	    	<!-- <div class="initStream">
		    	<button class="btn btn-success" id="btn-init-stream">Actualiser le fil d'actu</button></br>
		    	<span>lancer le processus d'import de données</span>
	    	</div> -->
	    <?php //} ?>


	    <h5 class="text-center letter-red">
	        <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5" 
	            data-target="#modalScopes" data-toggle="modal"
	            data-toggle="tooltip" data-placement="top" 
	                                title="Sélectionner des lieux de recherche">
	            <!-- <i class="fa fa-bullseye" style="font-size:18px;"></i> -->
	            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=42>
	        </button><br>
	        recherche ciblée
	    </h5>
	    <!-- <h5 class="text-center letter-red">choisir des sources</h5> -->

	    <br>
	    <div class="scope-min-header list_tags_scopes hidden-xs hidden-sm"></div>
	    
	<div class="col-md-12 col-sm-12 col-xs-12 padding text-center hidden" id="sub-menu-left">
		<hr>
	    <h5 class="letter-blue">Catégories<br><i class="fa fa-angle-down"></i></h5>
	    <div class="col-md-4 col-sm-4 text-right">
		    <button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-money hidden-xs"></i> Je vends</button> 
			<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-gift hidden-xs"></i> Je donne</button> 
			<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-eye hidden-xs"></i> Je cherche</button> 
		</div>
		<div class="col-md-4 col-sm-4 no-padding">
			<div class="col-md-6 text-right no-padding">
				<button class="btn btn-default margin-bottom-5 margin-left-25"><i class="fa fa-heartbeat hidden-xs"></i> Coup de coeur</button> 
			</div>
			<div class="col-md-6 text-left no-padding">
				<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-thumbs-o-down hidden-xs"></i> Coup de gueule</button> 
			</div>
		</div>
		<div class="col-md-4 col-sm-4 text-left"> 
			<button class="btn btn-default margin-bottom-5 margin-left-25"><i class="fa fa-file-text-o hidden-xs "></i> Annonces publiques</button> 
			<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-exclamation-triangle hidden-xs"></i> Urgence</button> 
		</div>
	</div>

	</div>

	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 padding-25 text-right" id="sub-menu-left">
		<button href="#co2.referencement" class="lbh btn btn-default letter-green hidden-xs btn-menu-left-add">
			<i class="fa fa-plus"></i> Publier une annonce
		</button>
		<hr>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-circle-o hidden-xs"></i> Tout</button><br>
		<hr>
		<button class="btn btn-default margin-bottom-5 margin-left-5 active"><i class="fa fa-money hidden-xs"></i> Vente</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-external-link hidden-xs"></i> Location</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-gift hidden-xs"></i> Dons</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-exchange  hidden-xs"></i> Partage</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-eye hidden-xs"></i> Recherche</button><br>
		<hr>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-heartbeat hidden-xs"></i> Coup de coeur</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-thumbs-o-down hidden-xs"></i> Coup de gueule</button><br>
		<hr>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-briefcase hidden-xs"></i> Offre d'emplois</button><br>
		<hr>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-comment hidden-xs"></i> Annonces publiques</button><br>
		<button class="btn btn-default margin-bottom-5 margin-left-5"><i class="fa fa-exclamation-triangle hidden-xs"></i> Urgence</button><br>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 padding-25 text-left subsub" id="sub-menu-left" style="margin-top:160px; padding-left:0px!important;">
		<?php $categories = CO2::getAnnounceCategories();
			  foreach ($categories as $key => $cat) {
		?>
				<?php if(is_array($cat)) { ?>
					<button class="btn btn-default margin-bottom-5 margin-left-5">
						<i class="fa fa-chevron-circle-down hidden-xs"></i> <?php echo $key; ?>
					</button><br>
					<?php foreach ($cat as $key2 => $cat2) { ?>
						<button class="btn btn-default margin-bottom-5 margin-left-25">
							<?php echo $cat2; ?>
						</button><br>
					<?php } ?>
				<?php } ?>
			</button>
		<?php } ?>
	</div>
	<div class="col-lg-5 col-md-6 col-sm-6 no-padding" id="newsstream">
	
		<?php  
			//if(@$medias && sizeOf($medias) > 0)
			//$this->renderPartial('liveStream', array("medias"=>$medias)); 
		?>
	</div>


</div>



<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"freedom")); ?>

<script>

<?php  $parent = Person::getById(@Yii::app()->session["userId"]); ?>

var indexStepInit = 5;
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

	//initKInterface({"affixTop":250});
	initKInterface();
    
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

	//init loading in scroll
    $(window).off().bind("scroll",function(){ 
	    if(!loadingData && !scrollEnd){
	          var heightWindow = $("html").height() - $("body").height();
	          //console.log(heightWindow);
	          if( $(this).scrollTop() >= heightWindow - 400){
	            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
	          }
	    }
	});

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
	//loadLiveNow();
}


function loadStream(indexMin, indexMax){ console.log("LOAD STREAM FREEDOM");
	loadingData = true;
	currentIndexMin = indexMin;
	currentIndexMax = indexMax;

	//isLive = isLiveBool==true ? "/isLive/true" : "";
	var url = "news/index/type/city/isLive/true/date/"+dateLimit+"?tpl=co2&renderPartial=true&nbCol=1";
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+'/'+url,
        data: { indexMin: indexMin, 
        		indexMax:indexMax, 
        		renderPartial:true 
        	},
        success:
            function(data) {
                if(data){ //alert(data);
                	$("#news-list").append(data);
                	//bindTags();
					
				}
				loadingData = false;
				$(".stream-processing").hide();
            },
        error:function(xhr, status, error){
            loadingData = false;
            $("#newsstream").html("erreur");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    $("#newsstream").html("not found");
            }
        }
    });
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


function showNewsStream(isFirst){ mylog.log("showNewsStream freedom");

	scrollEnd = false;

	var isFirstParam = isFirst ? "?isFirst=1&tpl=co2" : "?tpl=co2";
	isFirstParam += "&nbCol=1";
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
		        url: baseUrl+"/"+moduleId+urlCtrl+"/date/"+dateLimit+"?tpl=co2",
		       	dataType: "json",
		       	data: dataNewsSearch,
		    	success: function(data){
			    	//mylog.log("LOAD NEWS BY AJAX");
			    	//mylog.log(data.news);
			    	$(".newsTL").html('<div class="spine"></div>');
					if(data){
						buildTimeLine (data.news, 0, 5);
						bindTags();
						if(typeof(data.limitDate.created) == "object")
							dateLimit=data.limitDate.created.sec;
						else
							dateLimit=data.limitDate.created;
					}
					loadingData = false;
					// $(".my-main-container").bind('scroll', function(){ mylog.log("in linve", loadingData, scrollEnd);
					//     if(!loadingData && !scrollEnd){
					//           var heightContainer = $("#timeline").height(); mylog.log("heightContainer", heightContainer);
					//           var heightWindow = $(window).height();
					//           if( ($(this).scrollTop() + heightWindow) >= heightContainer - 200){
					//             mylog.log("scroll in news/index MAX");
					//             loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
					        	
					//           }
					//     }
					// });
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

</script>
</script>
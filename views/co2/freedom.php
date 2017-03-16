<?php 

	HtmlHelper::registerCssAndScriptsFiles( array('/css/timeline2.css','/css/news/index.css',
		
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
#modal-create-anc #formCreateNewsTemp{
	display: block!important;
}
#formCreateNewsTemp .form-create-news-container, #formActivity{
    max-width: 60%;
    /*margin-left:20%;*/
}
#sub-menu-left{
    margin-top:1px;
    /*text-align: left;*/
}
#sub-menu-left .btn{
    /*background-color: #4285f4;
    border-color: #4285f4;*/
	/*color:white;*/
    /*border-radius:80px;*/
    font-weight: 700;
}
#sub-menu-left .btn.active{
    /*background-color: #fff;
    color: #4285f4;*/
}
/*#sub-menu-left .btn:hover{
    background-color: #1c6df5;
    border-color: #4285f4;
}*/
/*#sub-menu-left .btn.active:hover{
    background-color: #fff;
    color: #4285f4;
}
#sub-menu-left .btn.bg-yellow{
	border-color: transparent;
}*/
<?php 
	$btnAnc = array("blue"		=>array("color1"=>"#4285f4", 
								  		"color2"=>"#1c6df5"),

					"green"		=>array("color1"=>"#34a853", 
								  		"color2"=>"#2b8f45"),

					"red"		=>array("color1"=>"#ea4335", 
								  		"color2"=>"#cc392d"),

					"yellow"	=>array("color1"=>"#fbbc05", 
								  		"color2"=>"#e3a800"),
					);
?>

<?php foreach($btnAnc as $color => $params){ ?>
.btn-anc-color-<?php echo $color; ?>{
    background-color: <?php echo $params["color1"]; ?>;
    border-color: <?php echo $params["color1"]; ?>!important;
    color: #fff!important;
}

.btn-anc-color-<?php echo $color; ?>:hover{
    background-color: <?php echo $params["color2"]; ?>!important;
    border-color: <?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active{ 
	background-color:#fff!important;
	color:<?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active:hover{
    background-color: #fff;
    color: <?php echo $params["color1"]; ?>;
}
<?php } ?>

.keycat:hover,
.keycat.active,
.btn-select-category-1:hover,
.btn-select-category-1.active{
	background-color: #2C3E50!important;
    color: #fff!important;
    border-color:transparent!important;
}


#sub-menu-left.subsub .btn{
	width:95%;    
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

#photoAddNews{
	text-align: left;
}

.tagstags, .form-actions{
	/*display: none!important;*/
}


@media (max-width: 768px) {
	.btn-select-type-anc.col-xs-5{
		width:48%!important;
	}
}

  @media screen and (min-width: 768px) and (max-width: 1024px) {
    .btn-select-type-anc.col-xs-5{
		font-size:0.8em;
	}
  }

/*
.elemt_name, .elemt_date{
	display: none;
}*/
</style>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white top-page no-padding" id="" style="padding-top:0px!important;">

	<div class="col-lg-1  hidden-md col-sm-1 hidden-xs"></div>
	<div class="col-lg-2 col-md-3 hidden-sm col-xs-12 padding-20 text-right hidden-xs" id="sub-menu-left">
		<button class="btn btn-default letter-green hidden-xs btn-menu-left-add margin-top-5" 
				data-target="#modal-create-anc" data-toggle="modal">
			<i class="fa fa-plus"></i> Publier une annonce
		</button><hr>
		<?php 
				$freedomTags = CO2::getFreedomTags();
				$currentSection = 1;
				foreach ($freedomTags as $key => $tag) { ?>
					<?php if($tag["section"] > $currentSection){ $currentSection++; ?>
					<hr>
					<?php } ?>
					<button class="btn btn-default margin-bottom-5 margin-left-5 btn-select-type-anc btn-anc-color-<?php echo @$tag["color"]; ?>" 
									data-type-anc="<?php echo @$tag["key"]; ?>">
						<i class="fa fa-<?php echo @$tag["icon"]; ?> hidden-xs"></i> <?php echo @$tag["label"]; ?>
					</button>
					<br>	
		<?php } ?>
		
	</div>

	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 margin-top-25 text-left subsub" id="sub-menu-left">
		<h4 class="text-dark padding-bottom-5"><i class="fa fa-angle-down"></i> Catégories</h4>
		<hr>
		<h4 class="padding-top-10 padding-bottom-10 letter-blue label-category" id="title-sub-menu-category">
			<i class="fa fa-money"></i> A vendre
		</h4>
		<hr>
		<?php $categories = CO2::getAnnounceCategories();
			  foreach ($categories as $key => $cat) {
		?>
				<?php if(is_array($cat)) { ?>
					<button class="btn btn-default text-dark margin-bottom-5 btn-select-category-1" style="margin-left:-5px;" data-keycat="<?php echo $key; ?>">
						<i class="fa fa-chevron-circle-down hidden-xs"></i> <?php echo $key; ?>
					</button><br>
					<?php foreach ($cat as $key2 => $cat2) { ?>
						<button class="btn btn-default text-dark margin-bottom-5 margin-left-15 hidden keycat keycat-<?php echo $key; ?>">
							<i class="fa fa-angle-right"></i> <?php echo $cat2; ?>
						</button><br class="hidden">
					<?php } ?>
				<?php } ?>
			</button>
		<?php } ?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 no-padding margin-top-10">
		<h4 class="text-dark padding-bottom-5 margin-top-25 text-center">
			<i class="fa fa-angle-down"></i> Les annonces
			<i class="fa fa-angle-right hidden fa-title-list"></i> <span class="letter-blue label-category"><i class="fa fa-"></i> </span>
		</h4>
		<hr>

		<h5 class="text-center letter-red">
	        <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5 margin-top-5" 
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
	    <div class="scope-min-header list_tags_scopes hidden-xs hidden-sm text-center"></div>
	    

		<div id="newsstream"></div>
	</div>	

	<div class="pull-right col-lg-3 col-md-3 col-sm-4 hidden-xs padding-20 margin-top-50" id="nowList">
	
	</div>
</div>



<?php $this->renderPartial('../news/modalCreateAnc'); ?>

<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"freedom")); ?>

<script type="text/javascript" >

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

	$(".subsub").hide();

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
	          console.log(heightWindow);
	          if( $(this).scrollTop() >= heightWindow - 400){
	            //loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
	            showNewsStream(false);
	          }
	    }
	});

    initKInterface();//{"affixTop":10});
    initFreedomInterface();

    //KScrollTo(".main-btn-scopes");

	
});

var freedomCategories = <?php echo json_encode($freedomTags); ?>

function initFreedomInterface(){
	$(".btn-select-type-anc").click(function(){

	  $(".btn-select-type-anc").removeClass("active");
	  $(this).addClass("active");

      var typeAnc = $(this).data("type-anc");
      if(typeAnc == "forsale" || typeAnc == "location" || typeAnc == "donation" || 
      	typeAnc == "sharing" || typeAnc == "lookingfor"){
      	$(".subsub").show(300);
      }else{
      	$(".subsub").hide(300);
      }

      if(typeof freedomCategories[typeAnc] != "undefined")
      		$(".label-category").html("<i class='fa fa-"+ freedomCategories[typeAnc]["icon"] + "'></i> " + freedomCategories[typeAnc]["label"]);
      		$(".label-category").removeClass("letter-blue letter-red letter-green letter-yellow").addClass("letter-"+freedomCategories[typeAnc]["color"])
		    $(".fa-title-list").removeClass("hidden");
		    KScrollTo(".top-page");
    });

    $(".btn-select-category-1").click(function(){
    	$(".btn-select-category-1").removeClass("active");
	  	$(this).addClass("active");

    	var keycat = $(this).data("keycat");
    	$(".keycat").addClass("hidden");
    	$(".keycat-"+keycat).removeClass("hidden");   	
    });

    $(".keycat").click(function(){
    	$(".keycat").removeClass("active");
	  	$(this).addClass("active");
	});

	initFormImages();

	//loadLiveNow();
}

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
	//var url = "news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>"+isLive+"/date/"+dateLimit+"?isFirst=1&tpl=co2&renderPartial=true";
		
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
      "name":"",
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
		urlCtrl = "/news/index/type/city/isLive/true";
	}
	/*<?php if(@Yii::app()->session["userId"]){ ?>
	else if(liveScopeType == "community"){
		thisType = "citoyens";
		urlCtrl = "/news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>/isLive/true";
	}
	<?php } ?>*/
	
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
    dataNewsSearch.textSearch = $('#main-search-bar').val();
       
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

			$("#formCreateNewsTemp").appendTo("#modal-create-anc #formCreateNews");
			$("#info-write-msg").html("Conseil : donnez un maximum de détails");
			$("#info-write-msg").html("Conseil : donnez un maximum de détails");
			showFormBlock(true);
			//$("#formCreateNewsTemp").html("");

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

var timeout;
function startSearch(isFirst){
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
      "searchType" : searchType,// [typeObj["event"]["col"],typeObj["project"]["col"],
      				 // typeObj["organization"]["col"],typeObj["action"]["col"]], 
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
	//<?php if(@Yii::app()->session["userId"]){ ?>
	else if(liveScopeType == "community"){
		thisType = "citoyens";
		urlCtrl = "/news/index/type/citoyens/id/"+userId;
	}
	//<?php } ?>
	
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
					$(".my-main-container").bind("scroll", function(){ mylog.log("in linve", loadingData, scrollEnd);
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
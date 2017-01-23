var timeout;
function startSearchLive(isFirst){
	mylog.log("startSearch Live", isFirst);
	showNewsStream(isFirst);
	loadLiveNow();
}

function loadLiveNow () { 

	mylog.log("loadLiveNow");
    var searchParams = {
      "name":$('.input-global-search').val(),
      "tpl":"/pod/nowList",
      "latest" : true,
      "locality" : localitySearch,
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

    mylog.dir(searchParams);

    ajaxPost( "#nowList", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if($('.el-nowList').length==0)
        	$('.titleNowEvents').addClass("hidden");
        else
        	$('.titleNowEvents').removeClass("hidden");
     } , "html" );
}


function showNewsStream(isFirst){ 
	mylog.log("showNewsStream2");

	scrollEnd = false;

	var isFirstParam = isFirst ? "?isFirst=1" : "";
	var tagSearch = $('#searchTags').val().split(','); //$('#searchBarText').val();
	/*var levelCommunexionName = { 1 : "CITYKEY",
	                             2 : "CODE_POSTAL",
	                             3 : "DEPARTEMENT",
	                             4 : "REGION"
	                           };*/
	
	var thisType="ko";
	var urlCtrl = "";
	var dataNewsSearch = {};

	if(liveScopeType == "global") {
		thisType = "city";
		urlCtrl = "/news/index/type/city";
		dataNewsSearch = {
	      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
	      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
	      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
	      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
	    };
	}else if (liveScopeType == "community" && typeof userId != "undefined"){
		thisType = "citoyens";
		urlCtrl = "/news/index/type/citoyens/id/"+userId+"/isLive/true";
	}		

    dataNewsSearch.tagSearch = tagSearch;
    dataNewsSearch.searchType = searchType; 
    dataNewsSearch.textSearch = $('#searchBarText').val();

    var loading = "	<div class='loader text-dark '>"+
						"<span style='font-size:25px;' class='homestead'>"+
							"<i class='fa fa-spin fa-circle-o-notch'></i> "+
							"<span class='text-dark'>Chargement en cours ...</span>" + 
					"</div>";

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
		    		mylog.log("data",data);
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
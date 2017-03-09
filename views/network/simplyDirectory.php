<div class="col-md-12 no-padding" id="repertory" >
  <div id="dropdown_search" class="col-md-12 container list-group-item"></div>
</div>
<div class="col-md-12 padding-10" id="ficheInfoDetail" style="top: 0px;
    opacity: 1;
    display: block;display:none;">
</div>

<?php

	$this->renderPartial(@$path."first_step_directory"); ?>

<script type="text/javascript">
  //Icons by default categories
  var linksTagImages = new Object();
  var params= <?php echo json_encode($params) ?>;
  var contextMapNetwork = [];
  
  console.log("Params //////////////////");
  console.log(params);
  <?php
    if(isset($params['filter']['linksTag'])){
      foreach($params['filter']['linksTag'] as $key => $val){
        if(isset($val['image'])){?>
        linksTagImages.<?php echo $val['tagParent']; ?> = {};
      <?php
      }
    }
  }
  // echo "console.log(linksTagImages);";
  ?>
  //********** FILTER TYPE ITEM **********
  <?php if(isset($params['request']['searchType']) && is_array($params['request']['searchType'])){ ?>
    // var searchType = <?php echo json_encode($params['request']['searchType']); ?>;
    // var allSearchType = <?php echo json_encode($params['request']['searchType']); ?>;
  <?php } ?>
  //********** FILTERS **********
   console.log(<?php echo json_encode($params) ?>);
  <?php

  $allSearchParams = array("mainTag", "sourceKey", "searchType", "searchTag","searchCategory","searchLocalityNAME","searchLocalityCODE_POSTAL_INSEE","searchLocalityDEPARTEMENT","searchLocalityINSEE","searchLocalityREGION");
  foreach ($allSearchParams as $oneSearchParam) {
    //In params set with value
    if(isset($params['request'][$oneSearchParam]) && is_array($params['request'][$oneSearchParam])){ ?>
    <?php echo "var ".$oneSearchParam;?> = <?php echo json_encode($params['request'][$oneSearchParam]); ?>;
    <?php echo "var all".$oneSearchParam;?> = <?php echo json_encode($params['request'][$oneSearchParam]); ?>;
  <?php
    }//Set with no value
    else{
       echo "var ".$oneSearchParam;?> = [];
       <?php echo "var all".$oneSearchParam;?> = [];
    <?php }
  }?>
  var allElement = new Array();
  var allTags = new Object();
  var allTypes = new Object();
  var indexStepInit = 100;
  var  searchPrefTag = null;
  <?php if(!empty($params['request']['searchPrefTag'])){ ?>
   searchPrefTag = "<?php echo $params['request']['searchPrefTag'] ;?>";
  <?php } ?>
console.log("searchPrefTag", searchPrefTag);

var indexStep = indexStepInit;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var scrollEnd = false;
var totalData = 0;
var timeout = null;
jQuery(document).ready(function() {
    if( typeof params.request.pagination != "undefined" && params.request.pagination > 0)
        indexStepInit = params.request.pagination ;
    bindLBHLinks();
	if(location.hash == "" || location.hash == "#network.simplydirectory")
    	showMapNetwork(true);
    else
    	showMapNetwork(false);
    $(".main-menu-left.inSig").hide();
    $("#right_tool_map").removeClass("hidden-sm").hide( 700 );
    btnSearch = '<div class="btn-group btn-group-lg tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Recherche par nom">'+
					'<button type="button" class="btn btn-map " id="btn-search">'+
					'<i class="fa fa-chevron-left"></i></button>'+
				'</div>';
	$("#btn-back").parent().replaceWith(btnSearch);
    $("#btn-search").click(function(){
	    if(!$("#right_tool_map").is(":visible")){
		    $("#right_tool_map").show( 700 );
		    $("#btn-search").find("i").removeClass("fa-chevron-left").addClass("fa-chevron-right");
	    }else {
		    $("#right_tool_map").hide( 700 );
		    $("#btn-search").find("i").removeClass("fa-chevron-right").addClass("fa-chevron-left");
	    }
	    	
    });
    $('#btn-menu-launch').click(function(){
		if(!$(this).hasClass("active")){
			$(this).addClass("active");
			$(".main-menu-left").show();
			$(this).find("span").show();
			$(this).find(".firstIcon").removeClass("fa-filter").addClass("fa-angle-left");
		}else{
			$(this).removeClass("active");
			$(this).find("span").hide();
			$(".main-menu-left").hide();
			$(this).find(".firstIcon").removeClass("fa-angle-left").addClass("fa-filter");
		}
	});
	
	$(".showHideMoreTitleMap").click(function(){
	  	if($(this).find("i").hasClass("fa-angle-down")){
	  		$(".contentShortInformationMap").show("slow");
	  		$(".contentTitleMap").addClass("active");	
	  		$(this).addClass("active");
	  		$(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
	  	}else{
	  		$(this).removeClass("active");
			$(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
			$(".contentShortInformationMap").hide("slow");
			$(".contentTitleMap").removeClass("active");	
	  	}
	  	
  	});
  	
    topMenuActivated = true;
    hideScrollTop = true;
    checkScroll();
    var timeoutSearch = setTimeout(function(){ }, 100);

    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
    $(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>Cartographie des Tiers-Lieux </span> <span class='text-red'>MEL</span>");
    $('.tooltips').tooltip();
    $('#btn-toogle-map').click(function(e){ showMapNetwork(); });
    $('#breadcum_search').click(function(e){ showMapNetwork();    });
    <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>

    <?php } else { ?>
      $('#searchBarText').keyup(function(e){
          clearTimeout(timeoutSearch);
          timeoutSearch = setTimeout(function(){ 
            startSearchSimply(0, indexStepInit); 
        }, 800);
      });
    <?php } ?>
    /***** CHANGE THE VIEW PARAMS  *****/
    // $('#dropdown_params').show();
    $('#dropdown_paramsBtn').click(function(event){
      event.preventDefault();
      if($('#dropdown_paramsBtn').hasClass('active')){
        $('#dropdown_params').fadeOut();
        $('#dropdown_params').removeClass('col-md-3');
        $('#dropdown_search').removeClass('col-md-9');
        $('#dropdown_search').addClass('col-md-12');
        $('#dropdown_paramsBtn').removeClass('active');
      }
      else{
        $('#dropdown_params').addClass('col-md-3');
        $('#dropdown_params').fadeIn();
        $('#dropdown_search').addClass('col-md-9');
        $('#dropdown_search').removeClass('col-md-12');
        $('#dropdown_paramsBtn').addClass('active');
      }

    });
    /***** CHANGE THE VIEW GRID OR LIST *****/
    $('#grid').hide();
    $('#list').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').addClass('list-group-item');
      $('.entityTop').removeClass('row');
      $('.entityMiddle').removeClass('row');
      $('.entityBottom').removeClass('row');
      $('.entityTop').addClass('col-md-2');
      $('.entityMiddle').addClass('col-md-12');
      $('.entityBottom').addClass('col-md-4');
      $('#grid').show();
      $('#list').hide();
    });
   $('#grid').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').removeClass('list-group-item');
      $('#dropdown_search .item').addClass('grid-group-item');
      $('.entityTop').addClass('row');
      $('.entityMiddle').addClass('row');
      $('.entityBottom').addClass('row');
      $('.entityTop').removeClass('col-md-2');
      $('.entityMiddle').removeClass('col-md-12');
      $('.entityBottom').removeClass('col-md-4');
      $('#list').show();
      $('#grid').hide();
    });
    /******** EVENTS ********/


    $('#reset').off().on('click', function() {
      searchTag = allsearchTag;
      searchLocalityNAME = allsearchLocalityNAME;
      searchCategory = allsearchCategory;
      $('.tagFilter').removeClass('active');
      $('.villeFilter').removeClass('active');
      $('.categoryFilter').removeClass('active');
      startSearchSimply(0, indexStepInit);
    });
    <?php if(@$params['mode'] && $params['mode'] == "client"){ ?>

        //Charger tous les éléments

    <?php } else{ ?>
      $(".my-main-container").scroll(function(){
        mylog.log("__________________________ YO _________________");
        if(!loadingData && !scrollEnd){
            var heightContainer = $(".my-main-container")[0].scrollHeight;
            var heightWindow = $(window).height();
            //console.log("scroll : ", scrollEnd, heightContainer, $(this).scrollTop() + heightWindow);
            if(scrollEnd == false){
              var heightContainer = $(".my-main-container")[0].scrollHeight;
              var heightWindow = $(window).height();
              if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
                // console.log("scroll MAX");
                startSearchSimply(currentIndexMin+indexStep, currentIndexMax+indexStep);
              }
            }
        }
      });
        /*$(".btn-filter-type").click(function(e){
            mylog.log("__________________________ YO2 _________________");
            var type = $(this).attr("type");
            var index = params.request.searchType.indexOf(type);
            if(type == "all" && params.request.searchType.length > 1){
                $.each(allSearchType, function(index, value){ 
                    removeSearchType(value); 
                }); 
                return;
            }
            if(type == "all" && params.request.searchType.length == 1){
                $.each(allSearchType, function(index, value){ 
                    addSearchType(value); 
                }); 
                return;
            }
            if (index > -1) 
                removeSearchType(type);
            else 
                addSearchType(type);
        });*/
        /*$(".btn-filter-type").click(function(e){
            mylog.log("__________________________ YO2 _________________");
            var type = $(this).attr("type");
            var index = searchType.indexOf(type);
            if(type == "all" && searchType.length > 1){
                $.each(allSearchType, function(index, value){ 
                    removeSearchType(value); 
                }); 
                return;
            }
            if(type == "all" && searchType.length == 1){
                $.each(allSearchType, function(index, value){ 
                    addSearchType(value); 
                }); 
                return;
            }
            if (index > -1) 
                removeSearchType(type);
            else 
                addSearchType(type);
        });*/
      //initBtnToogleCommunexion();
      //$(".btn-activate-communexion").click(function(){
      //  toogleCommunexion();
      //});
    <?php } ?>
    //initBtnScopeList();
    console.log("test ", indexStepInit);
    startSearchSimply(0, indexStepInit);
  });
function startSearchSimply(indexMin, indexMax){
     console.log("startSearch2", indexMin, indexMax, indexStep);
    $("#listTagClientFilter").html('spiner');
    if(loadingData) return;
    loadingData = true;

    // console.log("loadingData true");
    indexStep = indexStepInit;
    var name = $('#searchBarText').val();
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;
    currentIndexMin = indexMin;
    currentIndexMax = indexMax;
    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array();
    }
    // if(name.length>=3 || name.length == 0){
      var locality = "";
      communexionActivated=true;
      levelCommunexion = 1;
      if(communexionActivated){
        if(levelCommunexion == 1) locality = inseeCommunexion;
        if(levelCommunexion == 2) locality = cpCommunexion;
        if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      }
      autoCompleteSearchSimply(name, locality, indexMin, indexMax);
}
/*function addSearchType(type){
  var index = params.request.searchType.indexOf(type);
  if (index == -1) {
    params.request.searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
}
function removeSearchType(type){
  var index = params.request.searchType.indexOf(type);
  if (index > -1) {
    params.request.searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
}*/
function addSearchCategory(category){
  console.log('add'+category+' dans '+searchCategory);
  var index = searchCategory.indexOf(category);
  if (index == -1) searchCategory.push(category);
  // var index = searchCategory.indexOf(category);
  // if (index == -1) {
  //   //Ajoute tous les tags des catégories
  //   $('.checkbox[data-parent="'+category+'"]').each(function(){
  //     addSearchTag($(this).attr("value"));
  //   });
  //   // searchCategory.push(category);
  //   $('.categoryFilter[value="'+category+'"]').addClass('active');
  //   // console.log($('.checkbox[data-parent="'+category+'"]'));
  //   $('.checkbox[data-parent="'+category+'"]').prop( "checked", true );
  // }
  if($('.checkbox[data-parent="'+category+'"]').length){
    $('.checkbox[data-parent="'+category+'"]').each(function(){
      addSearchTag($(this).attr("value"));
    });
  }
}
function removeSearchCategory(category){
  console.log('remove '+category+' dans '+searchCategory);
  var index = searchCategory.indexOf(category);
  if (index > -1) searchCategory.splice(index, 1);
  if($('.checkbox[data-parent="'+category+'"]').length){
    $('.checkbox[data-parent="'+category+'"]').each(function(){
      removeSearchTag($(this).attr("value"));
    });
  }
  // var index = searchCategory.indexOf(category);

  // if (index > -1) {
  //   //Masquer tous les tags des catégories
  //   $('.checkbox[data-parent="'+category+'"]').each(function(){
  //     removeSearchTag($(this).attr("value"));
  //   });
  //   searchCategory.splice(index, 1);
  //   $('.categoryFilter[value="'+category+'"]').removeClass('active');
  //   $('.checkbox[data-parent="'+category+'"]').prop( "checked", false );
  // }
}
function addSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index == -1) {
    searchTag.push(tag);
    $('.tagFilter[value="'+tag+'"]').addClass('active');
    $('.tagFilter[value="'+tag+'"]').prop("checked", true );
  }
}

function removeSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index > -1) {
    searchTag.splice(index, 1);
    $('.tagFilter[value="'+tag+'"]').removeClass('active');
    $('.tagFilter[value="'+tag+'"]').prop("checked", false );
  }
}

function addSearchVille(ville){
  var index = searchLocalityNAME.indexOf(ville);
  if (index == -1) {
    searchLocalityNAME.push(ville);
    $('.villeFilter[value="'+ville+'"]').addClass('active');
    $('.villeFilter[value="'+ville+'"]').prop("checked", true );
  }
}
function removeSearchVille(ville){
  var index = searchLocalityNAME.indexOf(ville);
  if (index > -1) {
    searchLocalityNAME.splice(index, 1);
    $('.villeFilter[value="'+ville+'"]').removeClass('active');
    $('.villeFilter[value="'+ville+'"]').prop("checked", false );
  }
}

var loadingData = false;
var mapElements = new Array();
var tagsFilter = new Array();
var mix = "";
<?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
  mix = "mix";
<?php } ?>

function autoCompleteSearchSimply(name, locality, indexMin, indexMax){
    console.log("autoCompleteSearchSimply", indexMax);
    var levelCommunexionName = { 1 : "INSEE",
                             2 : "CODE_POSTAL_INSEE",
                             3 : "DEPARTEMENT",
                             4 : "REGION"
                           };
    // console.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    // locality = "RENNES";
    var searchBy = levelCommunexionName[levelCommunexion];
    // searchBy = "NAME";
    console.log("searchLocalityNAME : ",searchLocalityNAME);
    console.log("searchLocalityCODE_POSTAL_INSEE : ",searchLocalityCODE_POSTAL_INSEE);
    console.log("searchLocalityDEPARTEMENT : ",searchLocalityDEPARTEMENT);
    console.log("searchLocalityINSEE : ",searchLocalityINSEE);
    console.log("searchLocalityREGION : ",searchLocalityREGION);
    console.log("searchTag : ",searchTag);
    console.log("searchCategory : ",searchCategory);

    //To merge Category and tags which are finally all tags
    var searchTagGlobal = [];
    if (undefined !== searchTag && searchTag.length)$.merge(searchTagGlobal,searchTag);
    if (undefined !== searchCategory && searchCategory.length)$.unique($.merge(searchTagGlobal,searchCategory));
    console.log("searchTagGlobal : "+searchTagGlobal);

    var searchTagsSimply = {} ;
    $.each(searchTagGlobal, function(i, o) {

        $.each(networkJson.filter.linksTag, function(keyNet, valueNet){

            mylog.log("networkTags", o, valueNet.tags, jQuery.inArray(o, valueNet.tags));
            if(typeof valueNet.tags[o] != "undefined"){
                if(typeof searchTagsSimply[keyNet] == "undefined")
                  searchTagsSimply[keyNet] = [];

                if(typeof valueNet.tags[o] == "string")
                  searchTagsSimply[keyNet].push(o);
                else{
                    $.each(valueNet.tags[o], function(keyTags, valueTags){
                      searchTagsSimply[keyNet].push(valueTags);
                    });
                }
            }  
        });
    });

    mylog.log("searchTagsSimply", searchTagsSimply);

    var data = {
      "name" : name,
      "locality" : "xxxx",
      "searchType" : params.request.searchType,
      //"searchTag" : searchTagGlobal,
      "searchTag" : searchTagsSimply,
      "searchLocalityNAME" : searchLocalityNAME,
      "searchLocalityCODE_POSTAL_INSEE" : searchLocalityCODE_POSTAL_INSEE,
      "searchLocalityDEPARTEMENT" : searchLocalityDEPARTEMENT,
      "searchLocalityINSEE" : searchLocalityINSEE,
      "searchLocalityREGION" : searchLocalityREGION,
      "searchBy" : searchBy,
      "indexMin" : indexMin,
      "indexMax" : indexMax,
      "sourceKey" : sourceKey,
      "mainTag" : mainTag,
      "searchPrefTag" : searchPrefTag,
      
    };

    if(typeof params.filter.paramsFiltre != "undefined")
      data.paramsFiltre = params.filter.paramsFiltre;
    //console.log("loadingData true");
    loadingData = true;

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    //$("#dropdown_search").css({"display" : "inline" });
    if(indexMin > 0)
    $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $("#dropdown_search").html("<center><span class='search-loaderr text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
    if(isMapEnd)
      $.blockUI({
        message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i><span class='text-dark'> En cours ...</span></h1>"
      });
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/simplyautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error");
             console.dir(data);
          },
          success: function(data){
            if(!data.res){ toastr.error(data.content); }
            else
            {
              var countData = 0;
              $.each(data.res, function(i, v) { if(v.length!=0){ countData++; } });

              totalData += countData;

              str = "";
              var city, postalCode = "";
              var mapElements = new Array();
              allTags = data.filters;
              //parcours la liste des résultats de la recherche
              $.each(data.res, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];
                  // mapElements.push(o);
                  // allElement.push(o);


                  typeIco = o.type;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];

                  htmlIco ="<i class='fa "+ ico +" text-"+color+"'></i>";
                  if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                    var htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>";
                  }

                  // o.profilImageUrl = "/upload/communecter/network/Alimentation/fa-cutlery505719fabnone.png";
                  // o.profilMarkerImageUrl = "/upload/communecter/network/Alimentation/thumb/profil-marker.png";
                  // o.profilThumbImageUrl = "/upload/communecter/network/Alimentation/thumb/profil-resized.png";
                  city="";
                  var postalCode = o.cp
                  if (o.address != null) {
                    city = o.address.addressLocality;
                    postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                  }

                  //console.dir(o);
                  var id = getObjectId(o);
                  var tagsClasses = "";
                  var insee = o.insee ? o.insee : "";
                  type = o.type;
                  if(type=="citoyen") type = "person";

                  //Consolidate types
                  if(type != "undefined" && type != null){
                    if(typeof allTypes[type] != "undefined"){
                      allTypes[type] = allTypes[type] + 1;
                    }
                    else{
                      allTypes[type] = 1;
                    }
                  }
                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var url = baseUrl+'/'+moduleId+ "/default/dir#" + type + ".simply.id." + id;
                 // var onclick = 'loadByHash("#organization.simply.id.' + id + '");';
                  var onclick = 'getAjaxFiche("#element.detail.type.'+o.typeSig+'.id.'+id+'",1);';
                  var onclickCp = "";
                  var target = " target='_blank'";
                  var dataId = "";
                  if(type == "city"){
                    url = "javascript:"; //#main-col-search";
                    onclick = 'setScopeValue($(this))'; //"'+o.name.replace("'", "\'")+'");';
                    onclickCp = 'setScopeValue($(this));';
                    target = "";
                    dataId = o.name; //.replace("'", "\'");
                  }
                  var tags = "";
                  var find = false;
                  if(typeof o.tags != "undefined" && o.tags != null){
                    $.each(o.tags, function(key, value){
                      if(value != ""){
                        //Display info in item
                        tags +=   "<a href='javascript:' class='badge bg-red btn-tag tagFilter padding-5' value='"+ value +"'>#" + value + "</a>";
                        // manageTagFilter("#"+value);
                        //Consolidate tags
                        // if(typeof allTags[value] != "undefined"){
                        //   allTags[value] = allTags[value] + 1;
                        // }
                        // else{
                        //   allTags[value] = 1;
                        // }
                        //Default Image adn color
                        if(find == false && value in linksTagImages == true){
                          find = true;
                          // $.each(linksTagImages[value], function(key2, value2){
                          //   o[key2] = value2;
                          // });
                          o.typeSig = "organizations";
                          o.type = "organizations";
                        }
                        //Filter Client (Attention erreur firefox js)
                        // tagsClasses += ' '+value.replace("/[^A-Za-z0-9]/", "", value) ;
                      }
                    });
                  }
                  mapElements.push(o);
                  contextMapNetwork.push(o);
                  // console.log(tagsClasses);
                  var name = typeof o.name != "undefined" ? o.name : "";
                  var website = typeof o.url != "undefined" ? o.url : "";
                  var postalCode = (typeof o.address != "undefined" &&
                            typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";

                  if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                  var cityName = (typeof o.address != "undefined" &&
                          typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";

                  var fullLocality = postalCode + " " + cityName;
                  var description = (typeof o.shortDescription != "undefined" &&
                            o.shortDescription != null) ? o.shortDescription : "";
                  if(description == "") description = (typeof o.description != "undefined" &&
                                     o.description != null) ? o.description : "";
                  description = "";
                  if(o.profilMediumImageUrl != "undefined" && o.profilMediumImageUrl != "")
                  	pathmedium = baseUrl+o.profilMediumImageUrl;
                  else
                  	pathmedium = "<?php echo $this->module->assetsUrl ?>/images/thumbnail-default.jpg";
                  shortDescription = (typeof o.shortDescription != "undefined" &&
                                     o.shortDescription != null) ? o.shortDescription : "";

                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;
                  /***** VERSION SIMPLY *****/
                  str += "<div id='"+id+"' class='row list-group-item item searchEntity "+mix+" "+tagsClasses+" "+fullLocality+"' >";
                  <?php if(isset($params['result']['displayImage']) && $params['result']['displayImage']) { ?>
                  	str += '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">'+
				  				'<img class="img-responsive thumbnail" src="'+pathmedium+'">'+
				  			'</div>';
                    <?php } ?>
                   // str += "<div class='entityTop col-md-2' onclick='"+onclick+"'>";
                      //  str += "<img class='image' src='http://paniersdumarais.weebly.com/uploads/1/4/6/5/1465996/5333680.jpg' />";
                    //str += "</div>";

                    str += "<div class='entityMiddle col-md-5 name' onclick='"+onclick+"'>";
                        str += "<a class='entityName text-dark'>" + name + "</a><br/>";
                        if(website != "" && website != " ")
                        str += "<i class='fa fa-desktop fa_url'></i><a href='"+website+"' target='_blank'>"+website+"</a><br/>";
                        <?php if(isset($params['result']['fullLocality']) && $params['result']['fullLocality']) { ?>
                          if(fullLocality != "" && fullLocality != " ")
                          str += "<div class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</div><br/>";
                        <?php } ?>
                    str += "</div>";

                    <?php if(isset($params['result']['displayType']) && $params['result']['displayType']) { ?>
                      str += "<div class='entityMiddle col-md-2 type '>";
                        typeIco = "";
                         str += htmlIco+"" + typeIco + "";
                      str += "</div>";
                    <?php } ?>
                    <?php if(isset($params['result']['displayShortDescription']) && $params['result']['displayShortDescription']) { ?>
						str += "<div class='entityMiddle col-md-5 type '>";
                        str += 		shortDescription;
						str += "</div>";
                       <?php } ?>

                    target = "";
                         str += "<div class='entityBottom col-md-5'>";
                         str += "<hr>";
                      if(tags=="") tags = "<a href='#' class='badge bg-red btn-tag'>#</a>";
                      str += tags;
                    str += "</div>";
                  str += "</div>";
              }); //end each
              if(str == "") {
                  $(".btn-start-search").html("<i class='fa fa-search'></i>");
                  if(indexMin == 0){
                    //ajout du footer
                    var msg = "Aucun résultat";
                    if(name == "" && locality == "") msg = "<h3 class='text-dark'><i class='fa fa-3x fa-keyboard-o'></i><br> Préciser votre recherche pour plus de résultats ...</h3>";
                    str += '<div class="center" id="footerDropdown">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-white'>"+msg+"</label><br/>";
                    str += "</div>";
                    $("#dropdown_search").html(str);
                    $("#searchBarText").focus();
                  }
              }
              else
              {
                //ajout du footer

                  str += '</div><div class="center col-md-12" id="footerDropdown">';
                  str += "<hr style='float:left; width:100%;'/><label id='countResult' class='text-white'></label><br/>";
                  <?php if(isset($params['mode']) && $params['mode'] != "client"){ ?>
                    str += '<button class="btn btn-default" id="btnShowMoreResult"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                    str += "</div>";
                  <?php } ?>
                //si on n'est pas sur une première recherche (chargement de la suite des résultat)
                if(indexMin > 0){
                  //on supprime l'ancien bouton "afficher plus de résultat"
                  $("#btnShowMoreResult").remove();
                  //on supprimer le footer (avec nb résultats)
                  $("#footerDropdown").remove();
                  //on calcul la valeur du nouveau scrollTop
                  var heightContainer = $(".my-main-container")[0].scrollHeight - 180;

                  //on affiche le résultat à l'écran
                  $("#dropdown_search").append(str);

                //si on est sur une première recherche
                }else{
                  //on affiche le résultat à l'écran
                  $("#dropdown_search").html(str);
                  //on scroll pour coller le haut de l'arbre au menuTop
                  // $(".my-main-container").scrollTop(95);
                }

                //On met à jour les filtres
                <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
                  loadClientFilters(allTypes, allTags);
                <?php } else{ ?>
                  loadServerFilters(allTypes, allTags);
                <?php } ?>
                //on affiche par liste par défaut
                $('#list').click();
                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-search'></i>");

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResult").mouseenter(function(){
                  mylog.log("__________________________ YO3 _________________");
                  if(!loadingData){
                    startSearchSimply(indexMin+indexStep, indexMax+indexStep);
                    $("#btnShowMoreResult").mouseenter(function(){});
                  }
                });

                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                // initBtnLink();
              } //end else (str=="")
              //signal que le chargement est terminé
              // console.log("loadingData false");
              loadingData = false;
              <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
               loadClientFeatures();
              <?php } else{ ?>
                loadServerFeatures();
              <?php } ?>
              //quand la recherche est terminé, on remet la couleur normal du bouton search
              $(".btn-start-search").removeClass("bg-azure");
            }
            // console.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);

            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResult").remove();
              scrollEnd = true;
            }else{
              scrollEnd = false;
            }
           //affiche les éléments sur la carte
            Sig.showMapElements(Sig.map, mapElements);
           //on affiche le nombre de résultat en bas
            var s = "";
            var length = ($( "div.searchEntity" ).length);
            if(length > 1) s = "s";
            $("#countResult").html(length+" résultat"+s);
            $.unblockUI();
          }
    });
  }

  function setSearchValue(value){
    $("#searchBarText").val(value);
    startSearchSimply(0, 100);
  }
  function manageTagFilter(tag){
    var index = tagsFilter.indexOf(tag);
    if (index > -1) {
      tagsFilter.splice(index, 1);
    }
    else{
      tagsFilter.push(tag);
    }
  }

  function loadServerFeatures(){

  }
  function loadServerFilters(types,tags){
    var displayLimit = 10;
    var classToHide = "";
    var i = 0;

    var breadcum  = "";
    //All desacactivate
    $('.villeFilter').prop("checked", false );
    $('.tagFilter').prop("checked", false );
    $('.categoryFilter').prop("checked", false );
    //One by One Tag
    $.each(searchTag, function(index, value){
      //Display
      $('.tagFilter[value="'+value+'"]').prop("checked", true );
      if($('.tagFilter[value="'+value+'"]').length)breadcum = breadcum+"<span class='label label-danger tagFilter' value='"+value+"'>"+$('.tagFilter[value="'+value+'"]').attr("data-label")+"</span> ";
      //Open menu
      manageCollapse(value,true);
    });
    $.each(searchLocalityNAME, function(index, value){
      //Display
      $('.villeFilter[value="'+value+'"]').prop("checked", true );
      //Open menu
      manageCollapse(value,true);
    });
    //One by One Category
    $.each(searchCategory, function(index, value){
      $('.categoryFilter[value="'+value+'"]').prop( "checked", true );
      // $('.tagFilter[data-parent="'+value+'"]').prop("checked", true );
      // breadcum = breadcum+"#"+value+", ";
      breadcum = breadcum+"<span class='label label-danger categoryFilter' value='"+value+"'>"+value+"</span> ";
      // manageCollapse(value,true);
    });
    /*if(breadcum != ""){
      $('#breadcum').html('<i id="breadcum_search" class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i>'+breadcum+'<i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><label id="countResult" class="text-dark"></label>');
    }
    else{
      $('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><label id="countResult" class="text-dark"></label>');
    }*/

    $(".tagFilter").off().click(function(e){
      var tag = $(this).attr("value");
      var index = searchTag.indexOf(tag);
      if(tag == "all"){
        searchTag = [];
        $('.tagFilter[value="all"]').addClass('active');
        startSearchSimply(0, indexStepInit);
        return;
      }
      else{
        $('.tagFilter[value="all"]').removeClass('active');
      }
      if (index > -1) removeSearchTag(tag);
      else addSearchTag(tag);
      startSearchSimply(0, indexStepInit);
    });
    $(".villeFilter").off().click(function(e){
      var ville = $(this).attr("value");
      var index = searchLocalityNAME.indexOf(ville);
      if(ville == "all"){
        searchLocalityNAME = [];
        $('.villeFilter[value="all"]').addClass('active');
        startSearchSimply(0, indexStepInit);
        return;
      }
      else{
        $('.villeFilter[value="all"]').removeClass('active');
      }
      if (index > -1) removeSearchVille(ville);
      else addSearchVille(ville);
      startSearchSimply(0, indexStepInit);
    });
    $(".categoryFilter").off().click(function(e){
      var category = $(this).attr("value");
      if($(this).is(':checked') == false){
        removeSearchCategory(category);
      }
      else{
        addSearchCategory(category);
      }
      startSearchSimply(0, indexStepInit);
    });
  }
  // function loadClientFilters(types, tags){
  //   var displayLimit = 10;
  //   var classToHide = "";
  //   var i = 0;
  //   $("#listTypesClientFilter").html(' ');
  //   $.each(types, function(index, value){
  //     i+=1;
  //     $("#listTypesClientFilter").append('<div class="checkbox typeHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTypesClientFilter").append('<div id="moreTypes"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTypes").click(function(){
  //      $(".typeHidden").removeClass("hidden");
  //      $("#moreTypes").hide();
  //   });
  //   i=0;
  //   classToHide = "";
  //   $("#listTagClientFilter").html(' ');
  //   $.each(tags, function(index, value){
  //     i+=1;
  //     $("#listTagClientFilter").append('<div class="checkbox tagHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>#'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTagClientFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTag").click(function(){
  //      $(".tagHidden").removeClass("hidden");
  //      $("#moreTag").hide();
  //   });
  //   loadClientFeatures();
  // }
  function breadcrumGuide(level, url){
	  newLevel=$(".breadcrumAnchor").length;

	  if(level==0){
		  reverseToRepertory();
	  }
	  else{
    		if(level < newLevel){
      			newLevel=false;
      			$(".breadcrumAnchor").each(function(){
        				value=$(this).data("value");
        				if(value > level){
        					$(this).remove();
        					$(".breadcrumChevron[data-value='"+value+"']").remove();
        				}
      			});
    		}
    		if(newLevel == 5){
      			$(".breadcrumChevron[data-value='4']").remove();
      			$(".breadcrumAnchor[data-value='4']").remove();
      			newLevel=4;
    		}
    		getAjaxFiche(url, newLevel); 
	  }
  }

function getAjaxFiche(url, breadcrumLevel){
	$("#ficheInfoDetail").empty();
	if(location.hash == ""){
    history.pushState(null, "New Title", url);
  }

  if(isMapEnd){
    pathTitle="Cartographie";
		pathIcon = "map-marker";
    showMapNetwork();
  }else{
    pathTitle="Annuaire";
    pathIcon = "list";
  }

  isEntityView=true;
	allReadyLoad = true;
	location.hash = url;
  urlHash=url;

  if( urlHash.indexOf("type") < 0 && 
      urlHash.indexOf("default.view") < 0 && 
      urlHash.indexOf("gallery") < 0 && 
      urlHash.indexOf("news") < 0 &&
      urlHash.indexOf("network") < 0 && 
      urlHash.indexOf("invite") < 0){
    
      urlSplit=urlHash.replace( "#","" ).split(".");
      console.log(urlHash);

      if(urlSplit[0]=="person")
        urlType="citoyens";
      else
        urlType=urlSplit[0]+"s";
      
      urlHash="#element."+urlSplit[1]+".type."+urlType+".id."+urlSplit[3];
  }

  if(urlHash.indexOf("news") >= 0){
    urlHash=urlHash+"&isFirst=1";
  }
  url= "/"+urlHash.replace( "#","" ).replace( /\./g,"/" );
  $("#repertory").hide( 700 );
  $(".main-menu-left").hide( 700 );
  $("#ficheInfoDetail").show( 700 );
  $(".main-col-search").removeClass("col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3").addClass("col-md-12 col-sm-12");
  $.blockUI({
    message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
  });

  getAjax('#ficheInfoDetail', baseUrl+'/'+moduleId+url+'?network='+networkParams, function(){
    $.unblockUI();
    console.log(contextData);
    //Construct breadcrumb
    if(breadcrumLevel != false){
      $html= '<i class="fa fa-chevron-right fa-1x text-red breadcrumChevron" style="padding: 0px 10px 0px 10px;" data-value="'+breadcrumLevel+'"></i>'+'<a href="javascript:;" onclick="breadcrumGuide('+breadcrumLevel+',\''+urlHash+'\')" class="breadcrumAnchor text-dark" data-value="'+breadcrumLevel+'">'+contextData.name+'</a>';
      $("#breadcrum").append($html);
		}
  },"html");
}


function reverseToRepertory(){
	  if(isMapEnd){
	    showMapNetwork();
    }
	isEntityView=false;
    $("#ficheInfoDetail").hide( 700 );
    $(".main-col-search").removeClass("col-md-12 col-sm-12").addClass("col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3");
    $("#repertory").show( 700 );
    $(".main-menu-left").show( 700 );
   // $(".panel-group .panel-default").fadeIn();
   // $(".panel-group .panel-back").hide();
	$html = ' <a href="#network.simplydirectory" onclick="breadcrumGuide(0)" class="breadcrumAnchor text-dark" style="font-size:20px;">Liste</a>';
	$("#breadcrum").html($html);
	history.replaceState(null, '', window.location.href.split('#')[0]);
    Sig.restartMap();
	Sig.showMapElements(Sig.map, contextMapNetwork);
}

function showMapNetwork(show)
{
	//if(typeof Sig == "undefined") { alert("Pas de SIG"); return; }
	console.log("typeof SIG : ", typeof Sig);
	if(typeof Sig == "undefined") show = false;

	console.log("showMap");
	console.warn("showMap");
	if(show === undefined) show = !isMapEnd;
	if(show){
		isMapEnd =true;
		showNotif(false);

		$("#mapLegende").html("");
		$("#mapLegende").hide();

		showMenuNetwork(true);
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.fire('click');
		}

		$(".btn-group-map").show( 700 );
		$(".main-bottom-menu").show( 700 );
		$(".btn-menu5, .btn-menu-add").hide();
		$("#btn-toogle-map").css("display","inline !important");
		$("#btn-toogle-map").show();
		$(".my-main-container").animate({
     							top: -1000,
     							opacity:0,
						      }, 'slow' );

		setTimeout(function(){ $(".my-main-container").hide(); }, 1000);
		var timer = setTimeout("Sig.constructUI()", 1000);


	}else{
		isMapEnd =false;
		hideMapLegende();
		$(".btn-group-map").hide( 700 );
		$(".main-bottom-menu").hide( 700 );
		$("#dropdown_params").show( 700 );
		showMenuNetwork(false);
		$(".btn-menu5, .btn-menu-add").show();
		$(".panel_map").hide(1);
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
		$(".my-main-container").animate({
     							top: 50,
     							opacity:1
						      }, 'slow' );
		setTimeout(function(){ $(".my-main-container").show();
			if(!$('#ficheInfoDetail').is(":visible"))
				$(".main-menu-left").show( 700 );
 		}, 100);

		if(typeof Sig != "undefined")
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.closePopup();
		}

		if($(".box-add").css("display") == "none" && <?php echo isset(Yii::app()->session['userId']) ? "true" : "false"; ?>)
			$("#ajaxSV").show( 700 );

		checkScroll();
	}

}
var topMenuActivated = true;
function showMenuNetwork(show){ 

	if(typeof show == "undefined") 
		show = $("#main-top-menu").css("opacity") == 1;
	
	if(show){
		$("#titleMapTop").show( 700 );
		$("#btn-menu-launch").show( 700 );
		$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
		$(".main-menu-left").hide( 700 );
		$("#menuTopList").hide( 700 );
		$(".main-top-menu").removeClass("bg-white");
		//$(".main-top-menu").animate({ top: 0, opacity:1 }, 500 );
	}
	else{
		$("#titleMapTop").hide( 700 );
		$("#btn-menu-launch").hide( 700 );
		$("#btn-toogle-map").html("<i class='fa fa-map-marker'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Carte");
		$("#menuTopList").show( 700 );
		$(".main-top-menu").addClass("bg-white");
		if($("#btn-menu-launch").hasClass("active"))
			$("#btn-menu-launch").trigger("click");
		if($(".contentTitleMap").hasClass("active"))
			$(".showHideMoreTitleMap").trigger("click");
		if($("#right_tool_map").is(":visible"))
			$("#btn-search").trigger("click");

			
		//$(".main-top-menu").animate({ top: -60, opacity:0 }, 500 );
	}
}

</script>

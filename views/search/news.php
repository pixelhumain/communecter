
<style>

.searchEntity{
	margin-bottom:10px;
	margin-left:5px;
	display: inline-block;
}
.searchEntity .entityRight{
	text-align: center;
	padding: 10px 20px !important;
	margin-left: -1%;
	border-radius: 30px;
}
.searchEntity .entityRight .entityLocality{
	color:white !important;
	display: inline;
}
.searchEntity .entityRight .entityName{
	color:white !important;
	display: inline;
}
.lbl-title-newsstream{
	display: none;
}
.img-logo{
	height:250px;
}

#newsHistory{
	padding:1px !important;
}
#newsHistory .title-processing{
	display: none;
}

#newsHistory .timeline-scrubber{
	top:0px !important;
}
#newsHistory #timeline{
	width:100%;
}
#newsHistory #top{
	padding:0px !important;
}
#newsHistory .panel.panel-white{
	box-shadow: 0px 0px;
}
</style>

<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-rss"></i> L'Actualité</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉE</span></h1>

<?php $this->renderPartial("short_info_profil", array("type" => "main")); ?> 

<button class="menu-button btn-menu btn-menu-top bg-azure tooltips main-btn-toogle-map"
		data-toggle="tooltip" data-placement="right" title="Carte" alt="Localisation automatique">
		<i class="fa fa-map-marker"></i>
</button>

<div class="img-logo bgpixeltree_little">
	<button class="menu-button btn-geolocate bg-red tooltips" data-toggle="tooltip" data-placement="bottom" title="Trouver votre position actuelle" alt="Rechercher votre position">
		<i class="fa fa-crosshairs"></i>
	</button>
	<button class="menu-button btn-infos bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search text-red">
	<?php 
		$where = isset( Yii::app()->request->cookies['cityName'] ) ? 
		   			    Yii::app()->request->cookies['cityName'] : "";
		if($where == "") 
				 isset( Yii::app()->request->cookies['HTML5CityName'] ) ? 
			   			Yii::app()->request->cookies['HTML5CityName'] : "";
	?>
	<input id="searchBarPostalCode" type="text" placeholder="Où ?" class="text-red input-search postalCode" 
		   value="<?php echo $where; ?>" >

	<?php $this->renderPartial("dropdown_scope"); ?> 

	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
	<!-- <center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center> -->
</div>


<?php $this->renderPartial("first_step_agenda"); ?> 

<div class="" id="dropdown_search"></div>
<div class="" id="newsstream"></div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	topMenuActivated = true;
	hideScrollTop = true; 
	checkScroll();
	
	$('.tooltips').tooltip();

	$('.main-btn-toogle-map').click(function(e){ showMap(); });
	
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Actualité</span> <span class='text-red'>COMMUNE</span>CTÉE");

	$('#searchBarText').keyup(function(e){
        startSearch();
    });
    $('#searchBarPostalCode').keyup(function(e){
        startSearch();
    });
    $('#btn-start-search').click(function(e){
        startSearch();
    });
    $('#link-start-search').click(function(e){
        startSearch();
    });
    $(".btn-geolocate").click(function(e){
    	initHTML5Localisation('prefillSearch');
    });

    initBtnScopeList();
	startSearch();
});



function autoCompleteSearch(name, locality){
    var data = {"name" : name, "locality" : locality, "searchType" : [ "cities" ]  };
    $("#shortDetailsEntity").hide();
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error");
          	console.dir(data);
            
          },
          success: function(data){
          	console.log("success, try to load sig");
          	console.dir(data);
            if(!data){
              toastr.error(data.content);
            }else{

            var countData = 0;
          	$.each(data, function(i, v) {
	            if(v.length!=0){
	              $.each(v, function(k, o){
	              	countData++;
	              });
	            }
	        });

	        if(countData == 0){
	        	$("#dropdown_search").html("<center><span class='search-loader text-red' style='font-size:20px;'><i class='fa fa-ban'></i> Aucun résultat</span></center>");
    			$("#dropdown_search").show();
	        	toastr.error('Aucune donnée');
	        }

          var mapElements = new Array();  	
          
          str = "<div class='col-md-12 center'>";
          str += "<h3 class='text-dark'><i class='fa fa-angle-down'></i> Quelle commune souhaitez-vous consulter ?</h3>";
          var city, postalCode = "";
          $.each(data, function(i, v) {
            var typeIco = i;
            var ico = mapIconTop["default"];
            var color = mapColorIconTop["default"];

            
            if(v.length!=0){
              $.each(v, function(k, o){

               mapElements.push(o);

				typeIco = o.type;
                ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                
                htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
               	if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                  var htmlIco= "<img width='80' height='80' alt='image' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                }

                city="";

                var postalCode = o.cp
                if (o.address != null) {
                  city = o.address.addressLocality;
                  postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                }
                
                
                var id = getObjectId(o);
                var insee = o.insee ? o.insee : "";
                type = o.type;
                if(type=="citoyen") type = "person";
                var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                var onclick = 'loadByHash("#' + type + '.detail.id.' + id + '");';
                var onclickCp = "";
                var target = " target='_blank'";
                if(type == "city"){
                	url = "javascript:";
                	onclick = 'setScopeValue("'+o.name+'", "'+o.insee+'");';
                	onclickCp = 'setScopeValue("'+o.cp+'", "");';
                	target = "";
                }

                var tags = "";
                if(typeof o.tags != "undefined" && o.tags != null){
					$.each(o.tags, function(key, value){
						if(value != "")
		                tags +=   "<span class='badge bg-red'>#" + value + "</span>";
		            });
                }

                var name = typeof o.name != "undefined" ? o.name : "";
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
         
                var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                //template principal
                str += "<div class='searchEntity'>";
	     			target = "";
	                str += "<div class='entityRight bg-red badge'>";
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName'>" + name + "</a></br>";
	                	if(fullLocality != "" && fullLocality != " ")
	                	str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+"  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a> ";
	                	
	                str += "</div>";
	                					
				str += "</div>";

			
              })
            }
            }); 
            if(str == "") {
            	//$("#dropdown_search").html("");
            	$(".btn-start-search").html("<i class='fa fa-ban'></i>");
            	//$("#dropdown_search").css({"display" : "none" });	             
            }else{
            	//str += '<div class="col-md-5 no-padding" id="shortDetailsEntity"></div>';
            	str += '</div>';
	            $("#dropdown_search").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	            $("#dropdown_search").css({"display" : "inline" });
	           	$(".my-main-container").scrollTop(95);
	           	$("#link-start-search").html("Rechercher");
	            //$("#link-start-search").removeClass("badge");
	        }
	        $(".btn-start-search").removeClass("bg-azure");
    		//$(".btn-start-search").addClass("bg-dark");
          }

          console.log("ALL MAP ELEMTN");
          console.dir(mapElements);
          Sig.showMapElements(Sig.map, mapElements);
      }
    });

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $("#link-start-search").html("Recherche en cours ...");
    $(".btn-start-search").removeClass("bg-dark");
    $("#dropdown_search").html("<center><span class='search-loader text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
    $("#dropdown_search").css({"display" : "inline" });
                    
  }

var timeout;
function startSearch(){
	var name = $('#searchBarText').val();
    var locality = $('#searchBarPostalCode').val();

    //name = name.replace(/[^\w\s']/gi, '');
   // locality = locality.replace(/[^\w\s']/gi, '');

    //verification si c'est un nombre
    if(!isNaN(parseInt(locality))){
        if(locality.length == 0 || locality.length > 5) locality = "";
    }

    if(name.length>=3 || name.length == 0){
      clearTimeout(timeout);
      timeout = setTimeout('autoCompleteSearch("'+name+'", "'+locality+'")', 500);
    }else{
      
    }   
	
}

function setScopeValue(valText, insee){
	$("#searchBarPostalCode").val(valText);
	if(insee != "")
	  	showNewsStream(insee);
	else
		startSearch();
}

// function initScrolling(){
		
// 		var offset=newsReferror.news.offset;
// 		minusOffset=730;
			
// 		$(".my-main-container").off().on("scroll",function(){
// 			console.log($(".my-main-container").scrollTop());
// 			console.log(offset.top, minusOffset, offset.top - minusOffset, $(".my-main-container").scrollTop())
// 			//console.log((offset.top - minusOffset) + " <= " + $("#newsHistory").scrollTop());
// 			if(offset.top - minusOffset <= $(".my-main-container").scrollTop()) {
// 				if (lastOffset != offset.top){
// 					lastOffset=offset.top;
// 					loadStream();
// 				}
// 			}
// 		});
// }

function showNewsStream(insee){
	if(insee == "") insee = "<?php echo Yii::app()->request->cookies['insee'] ?>";
	//var insee = "<?php echo Yii::app()->request->cookies['insee'] ?>";//$("#searchBarPostalCode").val();
	
	if(insee != ""){
		$("#newsstream").html("<div class='loader text-dark '>"+
				"<span style='font-size:25px;' class='homestead'>"+
					"<i class='fa fa-spin fa-circle-o-notch'></i> "+
					"<span class='text-dark'>Chargement en cours ...</span>" + 
			"</div>");
		getAjax("#newsstream",baseUrl+"/"+moduleId+"/news/index/type/city/insee/"+insee+"?isNotSV=1",null,"html");
		
	}
}
</script>


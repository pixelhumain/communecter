
<div class="" id="scope-list">
	
</div>

<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-connectdevelop"></i> L'Annuaire</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1>

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
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search">
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



<div class="" id="dropdown_searchTop"></div>

<?php $this->renderPartial("first_step_directory"); ?> 

<script type="text/javascript">
jQuery(document).ready(function() {
	
	topMenuActivated = true;
	hideScrollTop = true; 
	checkScroll();
	
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Annuaire</span> <span class='text-red'>COMMUNE</span>CTÉ");

	$('.tooltips').tooltip();

	$('.main-btn-toogle-map').click(function(e){ showMap(); });

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
		if(geolocHTML5Done == false)
    		initHTML5Localisation('prefillSearch');
    	else
    		$("#modal-select-scope").modal("show");
    });

    initBtnScopeList();
    startSearch();
});


var timeout = null;
function startSearch(){
	var name = $('#searchBarText').val();
    var locality = $('#searchBarPostalCode').val();

    name = name.replace(/[^\w\s']/gi, '');
    locality = locality.replace(/[^\w\s']/gi, '');

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


function autoCompleteSearch(name, locality){
    var data = {"name" : name, "locality" : locality, "searchType" : [ "persons", "organizations", "projects", "cities" ]  };
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
	        	$("#dropdown_searchTop").html("<center><span class='search-loader text-red' style='font-size:20px;'><i class='fa fa-ban'></i> Aucun résultat</span></center>");
    			$("#dropdown_searchTop").show();
	        	toastr.error('Aucune donnée');
	        }

          var mapElements = new Array();  	
          
          str = "";
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
                	url = "#main-col-search";
                	onclick = 'setScopeValue("'+o.name+'");';
                	onclickCp = 'setScopeValue("'+o.cp+'");';
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
                str += "<div class='col-md-11 searchEntity'>";
	                str += "<div class='col-md-5 entityLeft'>";
						str += tags;
	                str += "</div>";

	                str += "<div class='col-md-2 entityCenter'>";
						str += "<a href='"+url+"' target='_blank' >" + htmlIco + "</a>";
	                str += "</div>";
					target = "";
	                str += "<div class='col-md-5 entityRight no-padding'>";
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
	                	if(fullLocality != "" && fullLocality != " ")
	                	str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+"  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
	                	if(startDate != null)
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
	                	if(endDate != null)
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
	                	if(description != "")
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDescription'>" + description + "</a>";
	                str += "</div>";
	                					
				str += "</div>";

			
              })
            }
            }); 
            if(str == "") {
            	//$("#dropdown_searchTop").html("");
            	$(".btn-start-search").html("<i class='fa fa-ban'></i>");
            	//$("#dropdown_searchTop").css({"display" : "none" });	             
            }else{
            	str += '<div class="col-md-5 no-padding" id="shortDetailsEntity"></div>';

	            $("#dropdown_searchTop").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	            $("#dropdown_searchTop").css({"display" : "inline" });
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
    $("#dropdown_searchTop").html("<center><span class='search-loader text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
    $("#dropdown_searchTop").css({"display" : "inline" });
                    
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      
      //toastr.success($("#dropdown_searchTop").position().top);
      var top = $(this).position().top;// + $("#dropdown_searchTop").position().top;

      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("insee"), top );
    });
  }


</script>
<style>
	.btn-add-to-directory{
		font-size: 14px;
		margin-right: 0px;
		border-radius: 6px;
		color: #666;
		border: 1px solid rgba(188, 185, 185, 0.69);
		margin-left: 3px;
		float: right;
		padding: 1px;
		width: 24px;
		margin-top: 4px;
	}
</style>


<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-connectdevelop"></i> L'Annuaire</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1>

<?php $this->renderPartial("short_info_profil", array("type" => "main")); ?> 

<button class="menu-button btn-menu btn-menu-top bg-azure tooltips main-btn-toogle-map"
		data-toggle="tooltip" data-placement="right" title="Carte">
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
				 $where = isset( Yii::app()->request->cookies['postalCode'] ) ? 
			   			  Yii::app()->request->cookies['postalCode'] : "";
	?>
	<input id="searchBarPostalCode" type="text" placeholder="Où ?" class="text-red input-search postalCode" 
		   value="<?php echo $where; ?>" >

	<?php $this->renderPartial("dropdown_scope"); ?> 

	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
	<!-- <center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center> -->

  <div class="col-md-12 center" style="margin-top:45px;margin-bottom:0px;">
    <div class="btn-group inline-block" id="menu-directory-type">
      <!-- <button class="btn btn-default bg-dark"><i class="fa fa-angle-right fa-2x"></i> Filtrer</button> -->
     <!--  <button class="btn btn-default btn-filter-type tooltips text-azure" data-toggle="tooltip" data-placement="top" title="Tous" type="all">
        <i class="fa fa-asterisk"></i>
      </button> -->
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Citoyens" type="persons">
        <i class="fa fa-check-circle-o search_persons"></i> <i class="fa fa-user"></i> Citoyens
      </button>
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Organisations" type="organizations">
        <i class="fa fa-check-circle-o search_organizations"></i> <i class="fa fa-group"></i> Organisations
      </button>
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Projets" type="projects">
        <i class="fa fa-check-circle-o search_projects"></i> <i class="fa fa-lightbulb-o"></i> Projets
      </button>
    </div>
  </div>

</div>



<div style="margin-top:30px;" class="col-md-12" id="dropdown_search"></div>

<?php $this->renderPartial("first_step_directory"); ?> 

<script type="text/javascript">
jQuery(document).ready(function() {
	
	topMenuActivated = true;
	hideScrollTop = true; 
	checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);

	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Annuaire</span> <span class='text-red'>COMMUNE</span>CTÉ");

	$('.tooltips').tooltip();

	$('.main-btn-toogle-map').click(function(e){ showMap(); });

	$('#searchBarText').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  });
  $('#searchBarPostalCode').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  });
  $('#btn-start-search').click(function(e){
      startSearch();
  });
  $('#link-start-search').click(function(e){
      startSearch();
  });

  $(".btn-geolocate").click(function(e){
		if(geolocHTML5Done == false){
    		initHTML5Localisation('prefillSearch');
        $("#modal-select-scope").modal("show");
        $("#main-title-modal-scope").html('<i class="fa fa-spin fa-circle-o-notch"></i> Recherche de votre position ... Merci de patienter ...'); 
        //<i class="fa fa-angle-right"></i> Dans quelle commune vous situez-vous en ce moment ?
    }	else{
    		$("#modal-select-scope").modal("show");
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
 

  initBtnScopeList();
  startSearch();
});

function setScopeValue(value){
      value = value.replace("#", "'");
      $("#searchBarPostalCode").val(value);
      startSearch();
    }


var timeout = null;
function startSearch(){
	  var name = $('#searchBarText').val();
    var locality = $('#searchBarPostalCode').val();

    name = name.replace(/[^\w\s']/gi, '');
    ///locality = locality.replace(/[^\w\s']/gi, '');

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

var searchType = [ "persons", "organizations", "projects", "cities" ];
//var minSearchType = [ "cities" ];
var allSearchType = [ "persons", "organizations", "projects" ];

function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
  console.log("addSearchType");
  console.dir(searchType);
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
  console.log("removeSearchType");
  console.dir(searchType);
}

function autoCompleteSearch(name, locality){
    
    var data = {"name" : name, "locality" : locality, "searchType" : searchType  };
    console.log("autocomplete searchType");
    console.dir(searchType);

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
    			  //$("#dropdown_search").show();
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
                  var htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
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
                	onclick = 'setScopeValue("'+o.name.replace("'", "#")+'");';
                	onclickCp = 'setScopeValue("'+o.cp+'");';
                	target = "";
                }

                var tags = "";
                if(typeof o.tags != "undefined" && o.tags != null){
					$.each(o.tags, function(key, value){
						if(value != "")
		                tags +=   "<a href='javascript:' class='badge bg-red btn-tag'>#" + value + "</a>";
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
                str += "<div class='col-md-12 searchEntity'>";
	                str += "<div class='col-md-5 entityLeft'>";
	                	
	                	<?php if( isset( Yii::app()->session['userId']) ) { ?>
	                	if(type!="city")
        						str += "<a href='javascript:' class='followBtn btn btn-sm btn-add-to-directory bg-white tooltips'" + 
            							'data-toggle="tooltip" data-placement="left" title="Ajouter dans votre répertoire"'+
            							" data-ownerlink='knows' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"'>"+
            									"<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
            								"</a>";
        						<?php } ?>
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
	                	str += "<div onclick='"+onclick+"'"+target+"  class='entityDescription'>" + description + "</div>";
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

	            $("#dropdown_search").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	            $("#dropdown_search").css({"display" : "inline" });
	           	$(".my-main-container").scrollTop(95);
	            //$("#link-start-search").html("Rechercher");

	            initBtnLink();

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

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      
      //toastr.success($("#dropdown_search").position().top);
      var top = $(this).position().top;// + $("#dropdown_search").position().top;

      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("insee"), top );
    });
  }

  function initBtnLink(){

  	//parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
  	$.each($(".followBtn"), function(index, value){
    	var id = $(value).attr("data-id");
   		var type = $(value).attr("data-type");
   		if(type == "person") type = "people";
   		else type = type + "s";

   		//console.log("#floopItem-"+type+"-"+id);
   		if($("#floopItem-"+type+"-"+id).length){
   			//console.log("I FOLLOW THIS");
   			$(value).html("<i class='fa fa-chain text-green'></i>");
   			$(value).attr("title", "Supprimer de votre répertoire");
   		}
   	});

  	//on click sur les boutons link
   	$(".followBtn").click(function(){
   		var id = $(this).attr("data-id");
   		var type = $(this).attr("data-type");
   		var name = $(this).attr("data-name");

   		//traduction du type pour le floopDrawer
   		var typeOrigine = type + "s";
   		if(typeOrigine != "person") typeOrigine + "s";
   		
   		if(type == "person") type = "people";
   		else type = type + "s";

   		//si l'entité n'existe pas dans le floopDrawer == on l'ajoute
   		if(!$("#floopItem-"+type+"-"+id).length){
   			//cas du type people
   			if(type == "people"){
   				var thiselement = this;
   				$(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>")
				connectPerson(id, function(entityValue){
           			console.log("connecting entity");
           			console.log(entityValue);
           			$(thiselement).html("<i class='fa fa-chain text-green'></i>")
           			addFloopEntity(id, type, entityValue);
           			showFloopDrawer(true);
           		});
			}
			//cas du type orga
			else if(type == "organizations"){
				toastr.info('TODO : link with orga');
			}
			//cas du type project
			else if(type == "projects"){
				toastr.info('TODO : link with projects');
			}
		}
		//si l'entité existe déjà dans le floopDrawer == on la supprime
		else{
			disconnectPerson(id, typeOrigine, name, function(entityValue){
       			console.log("disconnect");
       			console.log(entityValue);
       			removeFloopEntity(id, type, entityValue);
       			showFloopDrawer(true);
       		});
		}
   	});

    $(".btn-tag").click(function(){
      setSearchValue($(this).html());
    });
  }
</script>
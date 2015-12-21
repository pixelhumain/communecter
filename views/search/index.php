<?php 
$cs = Yii::app()->getClientScript();
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
//geolocalisation nominatim et byInsee
//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);
	
?>

<style type="text/css">



.container-lbl-info-search{
	position: absolute;
	width: 290px;
	top: -25px;
	background-color: rgba(58, 89, 111, 0.79); /*rgba(76, 98, 117, 0.74);*/	
	border-radius: 50%;
	height: 290px;
	left: 235px;
	display: none;
	-moz-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    -webkit-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    -o-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
.container-lbl-info-search .lbl-info-search{
	height: 20px;
	position: absolute;
	width: 100%;
	color: #FFF;
	font-weight: 700;
	font-size: 12px;
	margin-left: 133px;
	margin-top: 65px;
	z-index: 10;
}
.container-lbl-info-search .lbl-info-search span{
	padding:3px 7px;
	background-color: transparent;
	
}

.lbl-info-search.lbl1{
	-ms-transform: rotate(340deg); /* IE 9 */
    -webkit-transform: rotate(340deg); /* Chrome, Safari, Opera */
    transform: rotate(340deg);
    top: -21px !important;
	left: -19px;
}

.lbl-info-search.lbl2{
	-ms-transform: rotate(350deg); /* IE 9 */
    -webkit-transform: rotate(350deg); /* Chrome, Safari, Opera */
    transform: rotate(350deg);
    top: 16px;
	left: 8px;
}

.lbl-info-search.lbl3{
	-ms-transform: rotate(0deg); /* IE 9 */
    -webkit-transform: rotate(0deg); /* Chrome, Safari, Opera */
    transform: rotate(0deg);
    left: 17px;
	top: 65px;
}

.lbl-info-search.lbl4{
	-ms-transform: rotate(10deg); /* IE 9 */
    -webkit-transform: rotate(10deg); /* Chrome, Safari, Opera */
    transform: rotate(10deg);
    top: 113px;
	left: 8px;
}
.lbl-info-search.lbl5{
	-ms-transform: rotate(20deg); /* IE 9 */
    -webkit-transform: rotate(20deg); /* Chrome, Safari, Opera */
    transform: rotate(20deg);
    left: -19px;
	top: 152px;
}

.elementIcons{
  z-index:0;
  display:none;
  position:absolute;
  bottom:0px; 
  cursor:pointer;
}
/*-------*-------*-------*-------*-------*-------*-------*-------*/
.img-logo{
	width: 600px;
	max-width: 600px;
	min-width: 600px;
	height: 350px;
	top: 150px;
	margin-left: auto;
	margin-right: auto;
}
input.input-search{
	margin-top: 100px;
	margin-left: 16%;
	padding-right:10px;
	width: 70%;
	border-radius: 50px !important;
	height: 70px;
	font-size: 20px !important;
	padding: 10px !important;
	text-align: center;
	font-weight: 300;
	border-color: #C5C5C5 !important;

	-moz-box-shadow: 0px 0px 5px -2px #656565 !important;
	-webkit-box-shadow: 0px 0px 5px -2px #656565 !important;
	-o-box-shadow: 0px 0px 5px -2px #656565 !important;
	box-shadow: 0px 0px 5px -2px #656565 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}
input.input-search:focus{
	/*border-color: #3C5665 !important;*/
	-moz-box-shadow: 0px 0px 5px 2px #3C5665 !important;
	-webkit-box-shadow: 0px 0px 5px 2px #3C5665 !important;
	-o-box-shadow: 0px 0px 5px 2px #3C5665 !important;
	box-shadow: 0px 0px 5px 2px #3C5665 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}
input.input-search.postalCode{
	margin-top: 10px;
	margin-left: 34%;
	width: 36%;
	height: 35px;
	font-size: 16px !important;
	padding: 0px !important;
	
}
input.input-search.postalCode:focus{
	/*border-color: #CC3939 !important;*/
	-moz-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	-webkit-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	-o-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	box-shadow: 0px 0px 5px 0px #CC3939 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#CC3939, Direction=NaN, Strength=5) !important;
}

button.btn-start-search{
	margin-top: 70px;
	/*width: 25%;*/
	margin-left: 47%;
	background-color: #3C5665 !important;
	color:white;
	border-color: #3C5665 !important;
	border-radius: 30px;
	font-weight: 300;
	font-size: 18px;
	padding: 10px;
	width: 50px;
	height: 50px;
	-moz-box-shadow: 0px 0px 5px -2px #656565 !important;
	-webkit-box-shadow: 0px 0px 5px -2px #656565 !important;
	-o-box-shadow: 0px 0px 5px -2px #656565 !important;
	box-shadow: 0px 0px 5px -2px #656565 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}

button.btn-start-search:hover{
	background-color: white !important;
	color:#3C5665;
}

/* * * * * * * * * * * BIG BUTTONS MENU CUSTOM * * * * * * * * */
button.menu-button{
	position: fixed;
	height: 35px;
	width: 35px;
	border-radius: 25px;
	border: none;
}
button.btn-login{
	right: 100px;
	top: 40px;
	background-color: #E33551;
	color: #FFF;
	font-size: 17px;
	-moz-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	-webkit-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	-o-box-shadow: 0px 0px 5px 0px #CC3939 !important;
	box-shadow: 0px 0px 5px 0px #CC3939 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#CC3939, Direction=NaN, Strength=5) !important;
}
button.btn-geolocate{
	left: 110px;
	top: 50px;
	background-color: #54B736;
	color: #FFF;
	font-size: 17px;
	-moz-box-shadow: 0px 0px 5px 0px #54B736 !important;
	-webkit-box-shadow: 0px 0px 5px 0px #54B736 !important;
	-o-box-shadow: 0px 0px 5px 0px #54B736 !important;
	box-shadow: 0px 0px 5px 0px #54B736 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#54B736, Direction=NaN, Strength=5) !important;
}
/* * * * * * * * * * * BIG BUTTONS MENU CUSTOM * * * * * * * * */

.main-col-search{
	padding-top: 10px;
	margin-bottom: 100px;
	padding-bottom: 40px;
	background-color: white !important;
	-moz-box-shadow: 0px 5px 5px -2px #656565 !important;
	-webkit-box-shadow: 0px 5px 5px -2px #656565 !important;
	-o-box-shadow: 0px 5px 5px -2px #656565 !important;
	box-shadow: 0px -5px 5px -2px #656565 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}
#dropdown_searchTop .li-dropdown-scope ol{
	width:50%;
	font-size: 17px;
	font-weight: 400;
}
#dropdown_searchTop .li-dropdown-scope ol .light{
	font-size: 14px;
	font-weight: 300;
}

#dropdown_searchTop .li-dropdown-scope ol:hover{
	background-color: transparent !important;
	color:inherit !important;
}

.li-dropdown-scope.li-center{
	width:30%;
	margin-left:auto;
	margin-right: auto;
}

.li-dropdown-scope{
	width:100%;
	text-align: right;
	margin-left:auto;
	margin-right: auto;
}
#dropdown_searchTop .li-dropdown-scope ol i.fa, #dropdown_searchTop .li-dropdown-scope ol img.img-circle{
	margin-left:10px !important;
	margin-right: -55px;
}
@media screen and (max-width: 1024px) {
	.img-logo{
		width: 400px;
		max-width: 400px;
		min-width: 400px;
		height: 350px;
		top: 150px;
		margin-left: auto;
		margin-right: auto;
	}

	input.input-search{
		margin-top: 65px;
		margin-left: 16%;
		width: 70%;
		border-radius: 50px !important;
		height: 46px;
		font-size: 17px !important;
		padding: 10px !important;
		text-align: center;
		font-weight: 300;
		border-color: #C5C5C5 !important;
	}

	input.input-search.postalCode{
		margin-top: 10px;
		margin-left: 34%;
		width: 36%;
		height: 30px;
		font-size: 14px !important;
		padding: 0px !important;
		
	}


	button.btn-start-search{
		margin-top: 45px;
		margin-left: 45%;
		background-color: #3C5665 !important;
		color:white;
		border-color: #3C5665 !important;
		border-radius: 30px;
		font-weight: 300;
		font-size: 15px;
	}
}
</style>


<button class="menu-button btn-login tooltips" data-toggle="tooltip" data-placement="bottom" title="Se connecter" alt="Se connecter">
	<i class="fa fa-sign-in"></i>
</button>
<button class="menu-button btn-geolocate tooltips" data-toggle="tooltip" data-placement="bottom" title="Localisation automatique" alt="Localisation automatique">
	<i class="fa fa-crosshairs"></i>
</button>

<div class="col-sm-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-col-search">
	<h1 class="homestead text-dark text-center" 
		style="font-size:25px;margin-bottom: 0px; margin-left: -112px;">L'annuaire</span></h1>

	<h1 class="homestead text-red  text-center" 
		style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTER</span></h1>
	
	<div class="img-logo bgpixeltree_little">
		<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search">
		<input id="searchBarPostalCode" type="text" placeholder="un code postal ?" class="input-search postalCode">
		<button class="btn btn-primary btn-start-search "><i class="fa fa-search"></i></button>
	</div>

	<ul class="" id="dropdown_searchTop" style="">
	  <!-- <ol class="li-dropdown-scope"><?php echo Yii::t("common","Searching",null,Yii::app()->controller->module->id) ?></ol> -->
	</ul>
</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	$('.tooltips').tooltip();

	var timeout = null;
	$('#searchBarText').keyup(function(e){
	        var name = $('#searchBarText').val();
	        $(this).css("color", "#58879B");
	        if(name.length>=3){
	          clearTimeout(timeout);
	          timeout = setTimeout('autoCompleteSearch("'+name+'")', 500);
	        }else{
	          //$("#dropdown_searchTop").css("display", "none");
	          //$('#notificationPanel').hide("fast");
	        }   
	    });

});


/*SEARCH BAR*/
var mapIconTop = {
    "default" : "fa-arrow-circle-right",
    "citoyen":"<?php echo Person::ICON ?>", 
    "NGO":"<?php echo Organization::ICON ?>",
    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
    "Group" : "<?php echo Organization::ICON_GROUP ?>",
    "group" : "<?php echo Organization::ICON ?>",
    "association" : "<?php echo Organization::ICON ?>",
    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
    "event":"<?php echo Event::ICON ?>",
    "project":"<?php echo Project::ICON ?>",
    "city": "<?php echo City::ICON ?>"
  };
var mapColorIconTop = {
    "default" : "dark",
    "citoyen":"yellow", 
    "NGO":"green",
    "LocalBusiness" :"green",
    "Group" : "green",
    "group" : "green",
    "association" : "green",
    "GovernmentOrganization" : "green",
    "event":"orange",
    "project":"purple",
    "city": "red"
  };

function autoCompleteSearch(name){
    var data = {"name" : name};
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          success: function(data){
            if(!data){
              toastr.error(data.content);
            }else{
          str = "";
          var city, postalCode = "";
          $.each(data, function(i, v) {
            var typeIco = i;
            var ico = mapIconTop["default"];
            var color = mapColorIconTop["default"];
            if(v.length!=0){
              $.each(v, function(k, o){
                
                typeIco = o.type;
                ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                
                htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
               
                console.dir(o);
                  
                if (o.address != null) {
                  //console.dir(o.address);
                  city = o.address.addressLocality;
                  //postalCode = o.address.postalCode;
                  //insee = o.address.insee;
                }
                
                if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                  var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                }

                var insee      = o.insee ? o.insee : "";
                var postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                str +=  //"<div class='searchList li-dropdown-scope' >"+
                          "<a href='javascript:;' data-id='"+ o.id +"' data-type='"+ i +"' data-name='"+ o.name +"' data-icon='"+ ico +"' data-insee='"+ insee +"' class='searchEntry searchList li-dropdown-scope'>"+
                          "<ol>"+
                          o.name ;

                var cityComplete = "";
                //console.log("POSTAL CODE : " + postalCode + " - " + insee + " - " + city);
                if("undefined" != typeof city && city != "Unknown") cityComplete += city;
                if("undefined" != typeof postalCode && postalCode != "Unknown" && cityComplete != "") cityComplete += " ";
                if("undefined" != typeof postalCode) cityComplete += postalCode;
                str +=   "<span class='light'> "+cityComplete+"</span>";
                str +=   "<span>"+ htmlIco +"</span>  "
                str +=  "</ol></a>";//</div>";
              })
            }
            }); 
            if(str == "") {
            	$("#dropdown_searchTop").html("");
            	$(".btn-start-search").html("<i class='fa fa-ban'></i>");
            	$("#dropdown_searchTop").css({"display" : "none" });
            
            }else{
	            $("#dropdown_searchTop").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	        	$("#dropdown_searchTop").css({"display" : "inline" });
            
	        }

            addEventOnSearch(); 
          }
      } 
    });

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $("#dropdown_searchTop").html("");
    $("#dropdown_searchTop").css({"display" : "inline" });
                    
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("name"), $(this).data("icon"), 
                     $(this).data("insee") );

      $('#dropdown_searchTop').css("display" , "none");
    });
  }

  function setSearchInput(id, type,name,icon, insee){
    if(type=="citoyen"){
      type = "person";
    }
    url = "/"+type+"/detail/id/"+id;
    
    if(type=="cities")
        url = "/city/detail/insee/"+insee+"?isNotSV=1";
    //showAjaxPanel( '/'+type+'/detail/id/'+id, type+" : "+name,icon);
    openMainPanelFromPanel( url, type+" : "+name,icon, id);
    /*
    $("#searchBar").val(name);
    $("#searchId").val(id);
    $("#searchType").val(type);
    $("#dropdown_searchTop").css({"display" : "none" });*/  
  }
</script>






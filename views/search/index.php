<?php 
$cs = Yii::app()->getClientScript();
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
//geolocalisation nominatim et byInsee
//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);
	
?>

<style type="text/css">


 html, body {
  min-height: 100%;
  height: 100%;
}

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
	height: 380px;
	/*top: 150px;*/
	margin-left: auto;
	margin-right: auto;
	position:relative;
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
	margin-bottom: 5px;
	/*width: 25%;*/
	margin-left: 47%;
	/*background-color: #3C5665 !important;*/
	background-color: rgb(122, 207, 91);
	color:white;
	border-color: rgba(180, 180, 180, 0.77) !important;
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
	color:#68AE4E !important;
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

button.btn-menu{
	color: #FFF;
	font-size: 17px;
	-moz-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

button.btn-menu0{
	left: 14px;
	top: 16px;
	font-size: 25px;
	width: 50px;
	height: 50px;
	padding: 6px;
}
button.btn-menu1{
	left: 83px;
	top: 12px;
}

button.btn-menu2{
	left: 110px;
	top: 50px;
	
}

button.btn-menu3{
	left: 88px;
	top: 100px;
}
button.btn-menu4{
	left: 47px;
	top: 131px;
	font-size: 17px;
	padding-left: 8px;
}
button.btn-menu5{
	right: 44px;
	top: 221px;
	padding-left: 10px;
	font-size: 24px;
	width: 45px;
	height: 45px;
	padding: 5px;
}
button.btn-geolocate{
	font-size: 18px;
	position: absolute;
	top: 160px;
	left: 10px;
	-moz-box-shadow: 0px 0px 5px 0px #14424A !important;
	-webkit-box-shadow: 0px 0px 5px 0px #14424A !important;
	-o-box-shadow: 0px 0px 5px 0px #14424A !important;
	box-shadow: 0px 0px 5px 0px #14424A !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}
button.btn-infos{
	font-size: 17px;
	position: absolute;
	top: 160px;
	right: 10px;
	-moz-box-shadow: 0px 0px 5px 0px #14424A !important;
	-webkit-box-shadow: 0px 0px 5px 0px #14424A !important;
	-o-box-shadow: 0px 0px 5px 0px #14424A !important;
	box-shadow: 0px 0px 5px 0px #14424A !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

/* * * * * * * * * * * BIG BUTTONS MENU CUSTOM * * * * * * * * */

.main-col-search{
	padding-top: 10px;
	padding-bottom: 40px;
	min-height: 100%;
	background-color: white !important;
	-moz-box-shadow: 0px 5px 5px -2px #656565 !important;
	-webkit-box-shadow: 0px 5px 5px -2px #656565 !important;
	-o-box-shadow: 0px 5px 5px -2px #656565 !important;
	box-shadow: 0px -5px 5px -2px #656565 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}
#dropdown_searchTop{
	padding-left: 0px;
	margin-left: 0px;
}
#dropdown_searchTop .li-dropdown-scope ol{
	width:50%;
	font-size: 17px;
	font-weight: 400;
	line-height: 1.3;
	margin-top: -10px;
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
	margin-top:6px;
	display: inline-block;
}
#dropdown_searchTop .li-dropdown-scope ol i.fa, #dropdown_searchTop .li-dropdown-scope ol img.img-circle{
	margin-left:10px !important;
	margin-right: -55px;
	float: right;
	margin-top: -50px;
}
#dropdown_searchTop .li-dropdown-scope ol .tags, #dropdown_searchTop .li-dropdown-scope ol .tags:hover{
	color:red !important;
	font-size:13px;
}
.tags {
  display: inline;
  background: #E9E9E9;
  color: white !important;
  transition: all .25s linear;
  white-space: nowrap;
  line-height: 21px; 
  padding-bottom:5px;
	}
  .tags:before {
    content: "";
    border-style: solid;
    border-color: transparent #E9E9E9 transparent transparent;
    border-width: 12px 13px 12px 0;
    position: absolute;
    left: -13px;
    top: 0;
    transition: all .25s linear; }
  .tags:hover {
    background-color: #E9E9E9;
    color: red; }
  .tags:hover:before {
    border-color: transparent #E9E9E9 transparent transparent; }
  .tags:after {
    background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 50% 50% 50% 50%;
    content: "";
    height: 5px;
    left: -1px;
    position: absolute;
    top: 10px;
    width: 5px; }

    .elipsis{
    	text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		max-width: 98%;
		height: 40px;
    }

    #shortDetailsEntity{
    	position: absolute;
		right: 15px;
		top: 480px;
		/*min-height: 100px;*/
		border: 1px solid #E1E1E1;
		border-radius: 4px;    
		display: none;
	}

	.fa.loader_short_details{
		margin:10px;
	}

	.corner-fa{
      left: -10px;
      font-size: 30px;
      position: absolute;
      color: #BABABA;
      top: 5px;
    }

@media screen and (max-width: 1024px) {
	.img-logo{
		width: 400px;
		max-width: 400px;
		min-width: 400px;
		height: 350px;
		/*top: 150px;*/
		margin-left: auto;
		margin-right: auto;
		position: relative;
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
		color:white;
		border-radius: 30px;
		font-weight: 300;
		font-size: 15px;
		margin-bottom: 20px;
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

	.searchEntity .entityLeft{
		text-align: center !important;
	}
	.searchEntity .entityRight{
		text-align: center !important;
	}


	button.btn-geolocate{
		top: 103px;
		left: 0px;
	}
	button.btn-infos{
		top: 103px;
		right: 0px;
	}
}

.searchEntity{
	margin-bottom:10px;
	margin-left:7px;
}
.searchEntity .entityLeft{
	text-align: right;
	padding-top:30px;
	/*margin-right: -3%;
	margin-left: 3%;*/
}
.searchEntity .entityLeft .badge{
	margin:2px;
}
.searchEntity .entityCenter{
	text-align: center;
}
.searchEntity .entityCenter i.fa, 
.searchEntity .entityCenter img{
	width: 70px;
	height: 70px;
	border-radius: 50%;
	font-size: 33px;
	padding: 19px 21px;
}
.searchEntity .entityCenter img{
	padding: 10px;
	/*background-color: #CADDE9 !important;*/
}
.searchEntity .entityCenter i.fa.fa-calendar{
	font-size: 28px;
	padding: 21px;
}
.searchEntity .entityCenter i.fa.fa-user{
	font-size: 32px;
	padding: 17px;
}
.searchEntity .entityCenter i.fa.fa-users{
	font-size: 27px;
	padding: 21px 20px;
}
.searchEntity .entityCenter i.fa.fa-university{
	font-size: 27px;
	padding: 20px 21px;
}
.searchEntity .entityCenter i.fa.fa-lightbulb-o{
	font-size: 30px;
	padding: 20px 27px;
}
.searchEntity .entityRight{
	text-align: left;
	padding-top: 10px !important;
	margin-left: -1%;
}

.searchEntity .entityRight .entityName{
	font-size:18px;
	line-height: 20px;
	font-weight: 300;
	width:100%;
	display: block;
}
.searchEntity .entityRight .entityLocality{
	font-size: 13px;
	line-height: 17px;
	font-weight: 600;
	width:100%;
	display: block;
	margin-bottom: 2px;
}
.searchEntity .entityRight .entityDescription{
	font-size: 14px;
	line-height: 17px;
	width: 100%;
	display: block;
	font-weight: 300;
	max-height: 205px;
	overflow: hidden;
}

.searchEntity .entityRight .entityDate{
	font-size: 12px;
	line-height: 17px;
	margin-right:4px;
	display: inline-block;
	max-height: 205px;
	overflow: hidden;
	text-align: left;
	padding: 2px 9px;
	background-color: rgb(190, 223, 228) !important;
	color: rgb(45, 99, 125) !important;
	font-weight: 500;
}

</style>


<button class="menu-button btn-login tooltips" data-toggle="tooltip" data-placement="left" title="Se connecter" alt="Se connecter">
	<i class="fa fa-sign-in"></i>
</button>
<button class="menu-button btn-menu btn-menu0 bg-red tooltips" data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
	<i class="fa fa-home"></i>
</button>

<button class="menu-button btn-menu btn-menu1 bg-azure tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter quelque chose dans l'annuaire ..." alt="Localisation automatique">
	<i class="fa fa-plus-circle"></i>
</button>

<button class="menu-button btn-menu btn-menu2 bg-azure tooltips" data-toggle="tooltip" data-placement="right" title="L'Annuaire Communecté" alt="Localisation automatique">
	<i class="fa fa-connectdevelop"></i>
</button>

<button class="menu-button btn-menu btn-menu3 bg-azure tooltips" data-toggle="tooltip" data-placement="right" title="L'Agenda Communecté" alt="Localisation automatique">
	<i class="fa fa-calendar"></i>
</button>
<button class="menu-button btn-menu btn-menu4 bg-azure tooltips" data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="Localisation automatique">
	<i class="fa fa-rss"></i>
</button>

<button class="menu-button btn-menu btn-menu5 bg-azure tooltips" data-toggle="tooltip" data-placement="left" title="Afficher la carte géographique" alt="Localisation automatique">
	<i class="fa fa-map-marker"></i>
</button>

<div class="col-sm-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-col-search">
	<h1 class="homestead text-dark text-center" 
		style="font-size:25px;margin-bottom: 0px; margin-left: -112px;">L'annuaire</span></h1>

	<h1 class="homestead text-red  text-center" 
		style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1>
	
	<div class="img-logo bgpixeltree_little">
		<button class="menu-button btn-geolocate bg-dark tooltips" data-toggle="tooltip" data-placement="bottom" title="Trouver votre position actuelle" alt="Rechercher votre position">
			<i class="fa fa-crosshairs"></i>
		</button>
		<button class="menu-button btn-infos bg-dark tooltips" data-toggle="tooltip" data-placement="right" title="Comment ça marche ?" alt="Comment ça marche ?">
			<i class="fa fa-question-circle"></i>
		</button>
		<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search">
		<input id="searchBarPostalCode" type="text" placeholder="Où ?" class="input-search postalCode" 
			   value="<?php echo isset( Yii::app()->request->cookies['cityName'] ) ? 
			   					 Yii::app()->request->cookies['cityName'] : ""; ?>" >
		<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
		<center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center>
	</div>

	<div class="" id="dropdown_searchTop" style="">
	  <!-- <ol class="li-dropdown-scope"><?php echo Yii::t("common","Searching",null,Yii::app()->controller->module->id) ?></ol> -->
	</div>

	
</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	$('.tooltips').tooltip();

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

});

var timeout = null;
function startSearch(){
	var name = $('#searchBarText').val();
    var locality = $('#searchBarPostalCode').val();

    //verification si c'est un nombre
    if(!isNaN(parseInt(locality))){
        if(locality.length == 0 || locality.length > 5) locality = "";
    }

    //$(this).css("color", "#58879B");
    if(name.length>=3 || name.length == 0){
      clearTimeout(timeout);
      timeout = setTimeout('autoCompleteSearch("'+name+'", "'+locality+'")', 500);
    }else{
      //$("#dropdown_searchTop").css("display", "none");
      //$('#notificationPanel').hide("fast");
    }   
}

/*SEARCH BAR*/
var mapIconTop = {
    "default" : "fa-arrow-circle-right",
    "citoyen":"<?php echo Person::ICON ?>", 
    "NGO":"<?php echo Organization::ICON ?>",
    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
    "Group" : "<?php echo Organization::ICON_GROUP ?>",
    "group" : "<?php echo Organization::ICON ?>",
    "association" : "<?php echo Organization::ICON ?>",
    "organization" : "<?php echo Organization::ICON ?>",
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
    "organization" : "green",
    "GovernmentOrganization" : "green",
    "event":"orange",
    "project":"purple",
    "city": "red"
  };

function autoCompleteSearch(name, locality){
    var data = {"name" : name, "locality" : locality };
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
          	console.log("error");
          	console.dir(data);
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
               	if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                  var htmlIco= "<img width='80' height='80' alt='image' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                }

                console.dir(o);
                  
                city="";

                var postalCode = o.cp
                if (o.address != null) {
                  city = o.address.addressLocality;
                  postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                }
                
                
                var id = getObjectId(o);
                var insee = o.insee ? o.insee : "";
                var url = baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                var onclick = "";
                var onclickCp = "";
                var target = " target='_blank'";
                if(o.type == "city"){
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
                str += "<div class='col-md-12 searchEntity'>";
	                str += "<div class='col-md-5 entityLeft'>";
						str += tags;
	                str += "</div>";

	                str += "<div class='col-md-2 entityCenter'>";
						str += "<a href='"+url+"' target='_blank' >" + htmlIco + "</a>";
	                str += "</div>";
					
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
            	$("#dropdown_searchTop").html("");
            	$(".btn-start-search").html("<i class='fa fa-ban'></i>");
            	$("#dropdown_searchTop").css({"display" : "none" });
            
            }else{
            	str += '<div class="col-md-5 no-padding" id="shortDetailsEntity"></div>';

	            $("#dropdown_searchTop").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	        	$("#dropdown_searchTop").css({"display" : "inline" });
	        }
	        $(".btn-start-search").removeClass("bg-azure");
    		//$(".btn-start-search").addClass("bg-dark");
          }
      } 
    });

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
   // $(".btn-start-search").removeClass("bg-dark");
    $("#dropdown_searchTop").html("");
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

  function setSearchInput(id, type, insee, top){
    if(type=="citoyen"){ type = "person"; }
    
    $("#shortDetailsEntity").hide();
    $("#shortDetailsEntity").html("<i class='fa fa-caret-left corner-fa'></i><center><i class='fa fa-2x fa-circle-o-notch fa-spin loader_short_details'></i></center>");
    $("#shortDetailsEntity").css({"top":top-5});
    $("#shortDetailsEntity").show(400);
    
    $.ajax({
		url: baseUrl+'/'+moduleId+"/search/getshortdetailsentity/",
		data: {id : id, type : type },
		type: 'post',
		global: false,
		async: true,
		success: function(data) { 
			$("#shortDetailsEntity").html(data);
			
		},
		error: function(error){
			console.dir(error);
			toastr.error('error!');
		}
	});

  }

  function setScopeValue(value){
  	$("#searchBarPostalCode").val(value);
  	startSearch();
  }

</script>






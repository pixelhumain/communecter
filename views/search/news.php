

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
	<button class="menu-button btn-geolocate bg-dark tooltips" data-toggle="tooltip" data-placement="bottom" title="Trouver votre position actuelle" alt="Rechercher votre position">
		<i class="fa fa-crosshairs"></i>
	</button>
	<button class="menu-button btn-infos bg-dark tooltips" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search text-red">
	<input id="searchBarPostalCode" type="text" placeholder="Où ?" class="input-search postalCode" 
		   value="<?php echo isset( Yii::app()->request->cookies['cityName'] ) ? 
		   					 Yii::app()->request->cookies['cityName'] : ""; ?>" >
	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
	<center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center>
</div>

<div class="" id="dropdown_searchTop" style="">
</div>


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

	startSearch();
});


function startSearch(){
	var insee = $("#searchBarPostalCode").val();
	if(insee != "")
		getAjax("#dropdown_searchTop",baseUrl+"/"+moduleId+"/news/index/type/city/insee/"+insee+"?isNotSV=1",null,"html");
	
}
</script>


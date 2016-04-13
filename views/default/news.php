<?php 
$cssAnsScriptFilesModule = array(
  
  '/plugins/select2/select2.min.js'

);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>
<style>

.lbl-title-newsstream{
	display: none;
}
.img-logo{
	height:250px;
}
.btn-scope{
  /*display: none;*/
}

@media screen and (max-width: 1024px) {
  button.btn-start-search {
    margin-top: -40px;
    margin-left: 47%;
    color: white;
    border-radius: 30px;
    font-weight: 300;
    font-size: 19px;
    margin-bottom: 20px;
    height: 45px;
    width: 45px;
    padding: 0px;
  }

  .img-logo {
    height: 170px;
  }
  #newsHistory #timeline {
    margin-top: -50px;
  }


}

.lbl-scope-list{
    top:130px !important;
  }

  #btn-filter-scope-news{
    display:none;
  }

</style>

<!-- <h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-rss"></i> L'Actualité</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉE</span></h1> -->

<div class="lbl-scope-list text-red"></div>


<div class="img-logo bgpixeltree_little hidden">
	<!-- <button class="menu-button btn-activate-communexion bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Activer / Désactiver la communection" alt="Activer / Désactiver la communection">
		<i class="fa fa-university"></i>
	</button> -->
	<button data-id="explainNews" class="explainLink menu-button btn-infos bg-red tooltips hidden-xs" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>

	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search text-red">
	
	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
	<!-- <center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center> -->
</div>


<?php //$this->renderPartial("first_step_news"); ?> 
<?php //$this->renderPartial("news/index"); ?> 


<div class="" id="dropdown_search"></div>
<div class="col-md-12" id="newsstream"></div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
  	topMenuActivated = true;
  	hideScrollTop = true; 
  	checkScroll();
  	var timeoutSearch = setTimeout(function(){ }, 100);

    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
    
  	$('.tooltips').tooltip();

  	$('.main-btn-toogle-map').click(function(e){ showMap(); });
  	
  	
  	$('#searchBarText').keyup(function(e){
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
    	initHTML5Localisation('prefillSearch');
    });


    $(".btn-activate-communexion").click(function(){
      //toogleCommunexion();
    });
    
    $(".moduleLabel").html("<i class='fa fa-rss'></i> <span id='main-title-menu'>L'Actualité</span> <span class='text-red'>COMMUNE</span>CTÉE");
  
	 startSearch();
});


var timeout;
function startSearch(){

  if(inseeCommunexion != ""){
    showNewsStream(inseeCommunexion);
    $(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
  }

	
}


function showNewsStream(insee){
  console.log("showNewsStream", insee);
	if(insee == "") insee = "<?php echo Yii::app()->request->cookies['insee'] ?>";
	//var insee = "<?php echo Yii::app()->request->cookies['insee'] ?>";//$("#searchBarPostalCode").val();
	//alert();
	if(insee != ""){
		$("#newsstream").html("<div class='loader text-dark '>"+
				"<span style='font-size:25px;' class='homestead'>"+
					"<i class='fa fa-spin fa-circle-o-notch'></i> "+
					//"<span class='text-dark'>Chargement en cours ...</span>" + 
			"</div>");
    //$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Chargement de l'actualité ...");
		getAjax("#newsstream",baseUrl+"/"+moduleId+"/news/index/type/city/insee/"+insee,null,"html");
		$("#dropdown_search").hide(300);
	}
}
</script>


<?php 

	HtmlHelper::registerCssAndScriptsFiles( array('/js/default/formInMap.js') , $this->module->assetsUrl);

    HtmlHelper::registerCssAndScriptsFiles( 
        array(  '/css/referencement.css',) , 
        Yii::app()->theme->baseUrl. '/assets');


    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "referencement",
                                 )); 
?>

<style>
	.name .pastille {
	    margin-top: -44px;
	    display: block;
	    text-align: right;
	    max-width: 82%;
	    font-size: 0.3em;
	    margin-bottom: 22px;
	}
	
</style>

<div id="mainFormReferencement">
	<section id="portfolio">
        <div class="container">
            <?php if(!isset(Yii::app()->session["userId"])){ ?>
            <div class="row hidden">
                <div class="col-lg-12 text-center">
                    <h2 class="text-blue">
                        <i class="fa fa-user-o"></i><br>
                        Authentification
                    </h2>
                    <hr class="angle-down">
                    <div class="col-md-8 col-md-offset-2">
                		<div class="form-group">
                			<span>
	                			<small>Pour des raisons de sécurité, vous devez vous identifier sur le réseau Kgougle<br>pour bénéficier d'un référencement immédiat (sans délais).<br><br>
	                			<strong>Il est possible de continuer sans vous identifier.</strong><br>
	                			Le référencement anonyme est soumis à l'approbation des administrateurs du réseau Kgougle, <br>dans un délais de 7 jours, afin d'éviter tout abus.<br>
	                			<a href="#k.cgu" class="lbh"><u>Lire les conditions général de référencement</u></a>
	                			</small>
                			</span>
						</div>
                	</div>              	
                </div>
                <div class="col-md-4 col-md-offset-4 text-center"  style="margin-bottom:100px;">
                	<h4>connexion<br><i class="fa fa-angle-down"></i></h4>
				    <input type="text" class="form-control" placeholder="e-mail"><br>
				    <input type="password" class="form-control" placeholder="mot de passe"><br>
				    <input type="text" class="form-control hidden show-subscribe" placeholder="mot de passe (confirmation)"><br class="hidden show-subscribe">
				    <input type="text" class="form-control hidden show-subscribe" placeholder="Nom d'utilisateur"><br class="hidden show-subscribe">
				    <button class="btn btn-success pull-right hidden show-subscribe"><i class="fa fa-plus"></i> Je m'inscris</button> 
				    <button class="btn btn-danger pull-right hidden show-subscribe" id="btn-cancel-subscribe" style="margin-right:10px;"><i class="fa fa-times"></i> Annuler</button> 
				    <button class="btn btn-success pull-right hidden-subscribe"><i class="fa fa-sign-in"></i> Connexion</button> 
				    <button class="btn pull-left btn-xs hidden-subscribe" id="btn-start-subscribe"><i class="fa fa-plus"></i> Je veux m'inscrire</button> 
				    <div class="col-md-12">
				    	<hr><button class="btn btn-default" id="btn-start-anonymous"><i class="fa fa-user-secret"></i> Continuer sans identifiant</button>
				    </div>
       			</div>
            </div>
            <?php } ?>
            
            <div class="row" style="min-height:800px;" id="refStart">
            	<div class="col-lg-12 text-center">
                    <h2 class="text-blue" id="formRef">
                        <!-- <i class="fa fa-search"></i><br> -->
                        Référencer une page web
                    </h2>
                    <hr class="angle-down">
                </div>
                <div class="col-md-8 col-md-offset-2">
                	<div class="col-md-12">
                		<div class="form-group">
                			<label id="lbl-url">
                				<i class="fa fa-circle"></i> Indiquez l'URL de la page
                			</label>
						    <input type="text" class="form-control" placeholder="exemple : http://kgougle.nc" id="form-url"><br>
						    <h5 class="letter-green pull-left" id="status-ref"></h5>             		
						    <button class="btn btn-success pull-right btn-scroll" data-targetid="#formRef" id="btn-start-ref-url">
						    	<i class="fa fa-binoculars"></i> Lancer la recherche d'information
						    </button>
						</div>
                	</div>
                	<div class="col-md-12 hidden" id="refResult">
						<label id="lbl-title">
            				<i class="fa fa-circle"></i> Nom de la page <small>(complétez si besoin) *</small>
            				<small class="pull-right text-light">
            					<code>&lttitle&gt&lt/title&gt</code>
            				</small>
            			</label>
            			<input type="text" class="form-control" placeholder="Nom de la page" id="form-title"><br>
                        <input type="hidden" id="form-favicon">

                		<label id="lbl-description">
            				<i class="fa fa-circle"></i> Description de la page <small>(complétez si besoin)</small>
            				<small class="pull-right text-light">
            					<code>&ltmeta name="description"&gt</code>
            				</small>
            			</label>
            			<textarea class="form-control" placeholder="Description" id="form-description"></textarea><br>

            			<div class="col-md-12 no-padding">
	            			<label id="lbl-keywords">
	            				<i class="fa fa-circle"></i> Mots clés <small>(conseil : 3 mots max par expression)</small>	      				
	            				<small class="pull-right text-light">
	            					<code>&ltmeta name="keywords"&gt</code>
	            				</small><br>
	            				<small class="text-light">
	            					<i class="fa fa-info-circle"></i> Les mots clés servent à optimiser les résultats de recherche, choisissez les avec soins<br>
	            					<i class="fa fa-signal fa-flip-horizontal"></i> Par ordre d'importance (1 > 2 > 3 > 4)</small><br><br>
	            			</label>
            			</div>
            			<div class="col-md-3 padding-5">
            				<input type="text" class="form-control" placeholder="expression 1" id="form-keywords1"><br>
            			</div>
            			<div class="col-md-3 padding-5">
            				<input type="text" class="form-control" placeholder="expression 2" id="form-keywords2"><br>
            			</div>
            			<div class="col-md-3 padding-5">
            				<input type="text" class="form-control" placeholder="expression 3" id="form-keywords3"><br>
            			</div>
            			<div class="col-md-3 padding-5">
            				<input type="text" class="form-control" placeholder="expression 4" id="form-keywords4"><br>
            			</div>
                		
            			<div class="col-md-12 no-padding">
	            			<button class="btn btn-success text-white pull-right" id="btn-validate-information">
						    	<i class="fa fa-check"></i> Valider ces informations
						    </button>
                		</div>

                		<div class="col-md-12 no-padding hidden margin-top-50" id="refMainCategories">
	            			<label id="lbl-keywords" class="margin-top-15">
	            				<i class="fa fa-circle"></i> Choix des catégories
		       				</label>
	       					<div class="col-md-12" id="mainCategoriesEdit"></div>

		                	<div class="col-md-12 text-center margin-bottom-50 hidden" id="info-select-cat">
		                		<h4 class='col-md-12 text-center'>
									<i class='fa fa-hand-o-up fa-2x'></i>
								</h4>
								<span>
									Merci de sélectionner <b>au moins une catégorie</b> avant de continuer
								</span>
		                	</div>
       					</div>
                	</div>


                	<div class="col-md-8 col-md-offset-2 hidden text-center" id="refLocalisation">
						<h4 class='col-md-12 text-center'>
							<i class='fa fa-angle-down'></i><br>Géolocalisation
						<br>
                        <small>(facultatif)</small></h4><br>
						<span>
							Ajoutez une addresse si vous souhaitez que cette page apparaîsse aussi dans les résultats sur la carte.
						</span><br><br>
						<!-- <input type="text" class="form-control" placeholder="commune / ville / village" id="form-url"><br>
						<input type="text" class="form-control" placeholder="code postal" id="form-url"><br> -->
						<button class="btn btn-default bg-red text-white" id="btn-select-city" data-target="#portfolioModalCities" data-toggle="modal">
							<i class="fa fa-university"></i> Sélectionner une commune
						</button><br>

						<h4 class='col-md-12 text-center text-red' id="h4-name-city">
							<i class='fa fa-university'></i> <span id="name-city-selected">Nouméa</span>
						</h4><br>

						<input type="text" class="form-control" placeholder="addresse, rue" id="form-street"><br>

						<button class="btn btn-default bg-green-k text-white" id="btn-find-position">
							<i class="fa fa-map-marker"></i> Définir la position sur la carte
						</button><br><br>
						   
					</div>

       			</div>
       		</div>
		</div>
	</section>
	<section class="bg-green-k hidden" id="send-ref">
		<div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center" style="margin-bottom:50px;">
                	<button class="btn bg-white letter-green btn-lg" id="btn-send-ref">
                        <i class="fa fa-send"></i> Envoyer ma demande de référencement
                    </button><br><br>
                	<label class="text-white">(soumis à l'approbation des administrateurs sous 7 jours)</label>
                    <hr>
                    <label class="text-white">Les informations fournies à propos de cette URL seront examinées par les administrateurs du réseau avant d'être publiées, afin d'éviter tout abus et de garantir la pertinance des résultats de recherches.</label>
                    
                </div>
            </div>
        </div>
	</section>
</div>

<div class="portfolio-modal modal fade" id="portfolioModalCities" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-university fa-2x"></i><br>Sélectionner une commune</h2>
                        <hr>
                        <?php foreach(array("GN", "Sud", "Nord", "Iles") as $province){ ?>
                            <?php foreach($cities[$province] as $city){ ?>
                            	<div class="col-md-3">
                            		<button class="btn btn-scope" data-dismiss="modal"
                            				data-city-name="<?php echo $city["name"]; ?>"
                            				data-city-insee="<?php echo $city["insee"]; ?>"
                            				data-city-cp="<?php echo $city["postalCodes"][0]["postalCode"]; ?>"
                            				data-city-lat="<?php echo $city["geo"]["latitude"]; ?>"
                            				data-city-lng="<?php echo $city["geo"]["longitude"]; ?>">
                            			<i class="fa fa-bullseye"></i> <?php echo $city["name"]; ?>
                            		</button> 
                            	</div>
                            <?php } ?>
                        <?php } ?>
                        <div class="col-md-12 text-center"><hr>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial($layoutPath.'footer'); ?>

<script type="text/javascript" >

var categoriesSelected = new Array();
var urlValidated = "";
var formType = "poi";
var cities = <?php echo json_encode($cities); ?>;
var coordinatesPreLoadedFormMap = [0, 0];

console.log("CITIES", cities);

jQuery(document).ready(function() {
    initKInterface();
    buildListCategoriesForm();

    $('#form-url').val("https://fr.wikipedia.org");//"https://www.bci.nc/");//" http://groupe-vocal-nc.net/");

    $("#btn-start-ref-url").click(function(){
    	refUrl($('#form-url').val());
    });

    $("#btn-start-subscribe").click(function(){
    	$(".show-subscribe").removeClass("hidden");
    	$(".hidden-subscribe").addClass("hidden");
    });

    $("#btn-cancel-subscribe").click(function(){
    	$(".hidden-subscribe").removeClass("hidden");
    	$(".show-subscribe").addClass("hidden");
    });

    $("#h4-name-city, #form-street, #btn-find-position").hide();

    $("#btn-start-anonymous").click(function(){
    	$("#refStart").removeClass("hidden");
    	KScrollTo("#formRef");
    });

    $("#btn-validate-information").click(function(){
    	$("#refMainCategories").removeClass("hidden");
    	buildListCategoriesForm();
	    $("#btn-send-ref").off().click(function(){
	    	sendReferencement();
	    });
    	KScrollTo("#refMainCategories");

        $("#send-ref, #refLocalisation").removeClass("hidden");
        $("#info-select-cat").addClass("hidden");
    });

    $(".btn-scope").click(function(){
    	//h4-name-city btn-select-city name-city-selected
    	var cityName = $(this).data("city-name");
    	var cityCp = $(this).data("city-cp");
    	var cityInsee = $(this).data("city-insee");
    	var cityLat = $(this).data("city-lat");
    	var cityLng = $(this).data("city-lng");

    	$("#h4-name-city, #form-street, #btn-find-position").show();
    	$("#name-city-selected").html(cityName + ", " + cityCp);

    	coordinatesPreLoadedFormMap = [cityLat, cityLng];
	    showMarkerNewElement();
	    preLoadAddress(true, "NC", cityInsee, cityName, cityCp, cityLat, cityLng, "");

	    $("#btn-find-position").off().click(function(){
	    	showMap(true);

	    	if(Sig.markerFindPlace == null)
	    		showMarkerNewElement();
   	
	    	var street = $("#form-street").val();
    		preLoadAddress(true, "NC", cityInsee, cityName, cityCp, cityLat, cityLng, street);
    		
    		if(street != "")
    			searchAdressNewElement();	    	
	    });
    });

});


function buildListCategoriesForm(){
    //console.log(mainCategories);

    var html = "<h4 class='col-md-12 text-center'><i class='fa fa-angle-down'></i><br>"
                    +"Sélectionner la ou les catégories<br>qui correspondent le mieux à cette page</h4><hr>"+
    			//"<center><label></label></center><br>"+
    			"<center><label>(cliquez pour sélectionner)</label></center>";

    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";

        html    += '<section id="portfolio" class="'+classe+'">'+
                        '<div class="">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h4 class="letter-'+params.color+'">'+
                                        name+
                                    '</h4>'+
                                    '<hr class="angle-down">'+
                                '</div>'+
                            '</div>'+
                            '<div class="row text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            //console.log(keyC, val);
            html +=             '<div class="col-md-3 col-sm-4 col-xs-6 portfolio-item">'+
                                    '<button class="portfolio-link btn-select-category" data-value="'+val.name+'">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-2x"></i>'+
                                        '<h3>'+val.name+'</h3>'+
                                    '</button>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#mainCategoriesEdit").html(html);

    $(".btn-select-category").click(function(){
    	var val = $(this).data("value");
    	
    	if(categoriesSelected.indexOf(val) < 0){
    		categoriesSelected.push(val);
    		$(this).parent().addClass("selected");
    	}
    	else{
    		categoriesSelected.splice(categoriesSelected.indexOf(val), 1);
    		$(this).parent().removeClass("selected");
    	}

    	// if(categoriesSelected.length > 0){
    	// 	$("#send-ref, #refLocalisation").removeClass("hidden");
    	// 	$("#info-select-cat").addClass("hidden");
    	// }else{
    	// 	$("#send-ref, #refLocalisation").addClass("hidden");
    	// 	$("#info-select-cat").removeClass("hidden");
    	// }
    	//console.log("categoriesSelected");
    	//console.dir(categoriesSelected);
    });
}

function refUrl(url){

	$("#status-ref").html("<span class='letter-blue'><i class='fa fa-spin fa-refresh'></i> recherche en cours</span>");
	$("#refResult").addClass("hidden");
	$("#send-ref").addClass("hidden");

	urlValidated = "";

	// $.ajaxPrefilter( function (options) {
	//   if (options.crossDomain && jQuery.support.cors) {
	//     var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
	//     options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
	//     //options.url = "http://cors.corsproxy.io/url=" + options.url;
	//   }
	// });

    $.ajax({ 
    	url: "//cors-anywhere.herokuapp.com/" + url, // 'http://google.fr', 
    	//crossOrigin: true,
    	timeout:10000,
        success:
			function(data) {
				
			    var jq = $.parseHTML(data);
			    
			    var tempDom = $('<output>').append($.parseHTML(data));
			    var title = $('title', tempDom).html();
			    var stitle = "";

			    if(stitle=="" || stitle=="undefined")
			   		stitle = $('blockquote', tempDom).html();

			   	//console.log("STITLE", stitle);

				if(stitle=="" || stitle=="undefined")
			   		stitle = $('h2', tempDom).html();

				if(stitle=="" || stitle=="undefined")
			   		stitle = $('h3', tempDom).html();

				if(stitle=="" || stitle=="undefined")
			   		stitle = $('blockquote', tempDom).html();

				if(title=="" || title=="undefined")
			   		title = stitle;

                var favicon = $("link[rel*='icon']", tempDom).attr("href");
                var hostname = (new URL(url)).origin;
                var faviconSrc = "";
                if(typeof favicon != "undefined"){
                    var faviconSrc = hostname+favicon;
                    if(favicon.indexOf("http")>=0) faviconSrc = favicon;
                }

				var description = $(tempDom).find('meta[name=description]').attr("content");

				var keywords = $(tempDom).find('meta[name=keywords]').attr("content");
				//console.log("keywords", keywords);

				var arrayKeywords = new Array();
				if(typeof keywords != "undefined")
					arrayKeywords = keywords.split(",");

				//console.log("arrayKeywords", arrayKeywords);

				if(typeof arrayKeywords[0] != "undefined") $("#form-keywords1").val(arrayKeywords[0]); else $("#form-keywords1").val("");
				if(typeof arrayKeywords[1] != "undefined") $("#form-keywords2").val(arrayKeywords[1]); else $("#form-keywords2").val("");
				if(typeof arrayKeywords[2] != "undefined") $("#form-keywords3").val(arrayKeywords[2]); else $("#form-keywords3").val("");
				if(typeof arrayKeywords[3] != "undefined") $("#form-keywords4").val(arrayKeywords[3]); else $("#form-keywords4").val("");


				if(description=="" || description=="undefined")
			   		if(stitle=="" || stitle=="undefined")
			   			description = stitle;

				
				$("#form-title").val(title);
                $("#form-favicon").val(faviconSrc);
                $("#form-description").val(description);
				

				//color
				if($("#form-title").val() != "") $("#lbl-title").removeClass("letter-red").addClass("letter-green");
				else 							$("#lbl-title").removeClass("letter-green").addClass("letter-red");
			   	
			   	//color	
				if($("#form-description").val() != "") $("#lbl-description").removeClass("text-orange").addClass("letter-green");
				else 								   $("#lbl-description").removeClass("letter-green").addClass("text-orange");
			   		
			   	//color	
				if($("#form-keywords1").val() != "")   $("#lbl-keywords").removeClass("text-orange").addClass("letter-green");
				else 								   $("#lbl-keywords").removeClass("letter-green").addClass("text-orange");
			   		
			   	$("#form-title").off().keyup(function(){
			   		if($(this).val()!="")$("#lbl-title").removeClass("letter-red").addClass("letter-green");
					else 				 $("#lbl-title").removeClass("letter-green").addClass("letter-red");
					checkAllInfo();
			   	});
			   	$("#form-description").off().keyup(function(){
			   		if($(this).val()!="")$("#lbl-description").removeClass("text-orange").addClass("letter-green");
					else 				 $("#lbl-description").removeClass("letter-green").addClass("text-orange");
					checkAllInfo();
			   	});
			   	$("#form-keywords1").off().keyup(function(){
			   		if($(this).val()!="")$("#lbl-keywords").removeClass("text-orange").addClass("letter-green");
					else 				 $("#lbl-keywords").removeClass("letter-green").addClass("text-orange");
					checkAllInfo();
			   	});

			   	$("#status-ref").html("<span class='letter-green'><img src='"+faviconSrc+"' height=30 alt='x'> <i class='fa fa-check'></i> Nous avons trouvé votre page</span>");
    			$("#refResult").removeClass("hidden");
			   
			   	$("#lbl-url").removeClass("letter-red").addClass("letter-green");
			   	urlValidated = url;

			    $('<output>').remove();
			    tempDom = "";

			    checkAllInfo();			   
			},
		error:function(xhr, status, error){
			$("#lbl-url").removeClass("letter-green").addClass("letter-red");
			$("#status-ref").html("<span class='letter-red'><i class='fa fa-ban'></i> URL INNACCESSIBLE</span>");
		},
		statusCode:{
				404: function(){
				$("#lbl-url").removeClass("letter-green").addClass("letter-red");
				$("#status-ref").html("<span class='letter-red'><i class='fa fa-ban'></i> 404 : URL INTROUVABLE OU INACCESSIBLE</span>");
			}
		}
	});
}

function checkAllInfo(){
	if(	urlValidated != "" &&
		//$("#form-keywords1").val() != "" && 
		//$("#form-description").val() != "" && 
		$("#form-title").val() != "") 
   			$("#btn-validate-information").removeClass("hidden");
   	else 	$("#btn-validate-information").addClass("hidden");
}


function sendReferencement(){
	console.log("start referencement");

	var hostname = (new URL(urlValidated)).hostname;

	var title = $("#form-title").val();
    var favicon = $("#form-favicon").val();
    var description = $("#form-description").val();

	var keywords1 = $("#form-keywords1").val();
	var keywords2 = $("#form-keywords2").val();
	var keywords3 = $("#form-keywords3").val();
	var keywords4 = $("#form-keywords4").val();

	var keywords = new Array();

	if(notEmpty(keywords1)) keywords.push(keywords1);
	if(notEmpty(keywords2)) keywords.push(keywords2);
	if(notEmpty(keywords3)) keywords.push(keywords3);
	if(notEmpty(keywords4)) keywords.push(keywords4);
	
	//authorId *facultatif
	//categoriesSelected

	if(urlValidated != "" && title != "" /*&& description != "" && keywords.length > 0 && categoriesSelected.length > 0*/){

		var address = getAddressObj(); //formInMap.js


		var urlObj = {
                collection: "url",
                key: "url",
        		url: urlValidated, 
        		hostname: hostname, 
        		title: title, 
                favicon: favicon,
        		description: description,
        		tags: keywords,
        		categories : categoriesSelected,
                status: "validated"
        };

        if(address != false) {
        	urlObj["address"] = address.address;
        	urlObj["geo"] = address.geo;
        	urlObj["geoPosition"] = address.geoPosition;
        }
        console.log("address", address);

		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/element/save",
	        data: urlObj,
	       	dataType: "json",
	    	success: function(data){
	    		//if(data.valid == true) 
                    toastr.success("Votre demande a bien été enregistrée");
                    loadByHash("#co2.referencement");
	    		//else toastr.error("Une erreur est survenue pendant le référencement");
	    		console.log("save referencement success");
	    	},
	    	error: function(data){
	    		toastr.error("Une erreur est survenue pendant l'envoi de votre demande'");
	    		console.log("save referencement error");
	    	}
	    });
	}else{
		toastr.error("Merci de remplir toutes les options");
	}



}
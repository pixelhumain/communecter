<h1 class="letter-"><i class="fa fa-grav letter-red"></i> Bonjour <span class="letter-red">Super Admin</span></h1>
<h5 class="letter-">
	<button class="btn btn-sm btn-superadmin" data-action="web" data-idres="#central-container"><i class="fa fa-refresh"></i> </button>
	Section : <i class="fa fa-search letter-red"></i> 
	<span class="font-blackoutM letter-red">web</span>
</h5>

<!-- <br>
<hr>
<br>

<a href="http://www.la-nouvelle-caledonie.com/liens-utiles/">http://www.la-nouvelle-caledonie.com/liens-utiles/</a><br>
<button class="btn btn-sm btn-default btn-superadmin" data-action="scanlinks" data-idres="#res-scan">
	<i class="fa fa-terminal"></i> Scanner la page
</button> 
<i class="fa fa-check fa-2x letter-green"></i> 
<hr>
<div id="res-scan"></div> -->

<hr>

<h3><i class="fa fa-terminal fa-2x"></i> Auto-scan</h3>
<h4 class="letter-green"><?php echo sizeof($urlsLocked); ?> url <span class="letter-red">locked</span> in database</h4>
<button class="btn btn-sm btn-default btn-start-scan" data-action="scanlinks" data-idres="#res-scan">
	<i class="fa fa-terminal"></i> Run scan
</button> 
<button class="btn btn-sm btn-default btn-stop-scan" data-action="scanlinks" data-idres="#res-scan">
	<i class="fa fa-square letter-red"></i> Stop scan
</button>

<br>
<hr>

<div class="row" style="min-height:800px;" id="refStart">
	<div class="col-md-6 pull-left">
		<div class="col-md-12">
			<div class="form-group">
				<label id="lbl-url">
					<i class="fa fa-circle"></i> URL
				</label>
			    <input type="text" class="form-control" placeholder="exemple : http://kgougle.nc" id="form-url"><br>
			    <h5 class="letter-green pull-left" id="status-ref"></h5>             		
			    <!-- <button class="btn btn-success pull-right btn-scroll" data-targetid="#formRef" id="btn-start-ref-url">
			    	<i class="fa fa-binoculars"></i> Lancer la recherche d'information
			    </button> -->
			</div>
		</div>
		<div class="col-md-12 " id="refResult">
			<label id="lbl-title">
				<i class="fa fa-circle"></i> Nom de la page
				<small class="pull-right text-light">
					<code>&lttitle&gt&lt/title&gt</code>
				</small>
			</label>
			<input type="text" class="form-control" placeholder="Nom de la page" id="form-title"><br>

			<label id="lbl-description">
				<i class="fa fa-circle"></i> Description
				<small class="pull-right text-light">
					<code>&ltmeta name="description"&gt</code>
				</small>
			</label>
			<textarea class="form-control" placeholder="Description" id="form-description"></textarea><br>

			<div class="col-md-12 no-padding">
				<label id="lbl-keywords">
					<i class="fa fa-circle"></i> Mots clés	      				
					<small class="pull-right text-light">
						<code>&ltmeta name="keywords"&gt</code>
					</small><br>
					<!-- <small class="text-light">
						<i class="fa fa-info-circle"></i> Les mots clés servent à optimiser les résultats de recherche, choisissez les avec soins<br>
						<i class="fa fa-signal fa-flip-horizontal"></i> Par ordre d'importance (1 > 2 > 3 > 4)</small><br><br> -->
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
		</div>
	</div>

	<div class="col-md-6 pull-right text-right" id="nb-auto-scan"></div>
	<div class="col-md-6 pull-right" id="res-auto-scan"></div>
</div>

<script type="text/javascript">

	var urlsLocked = <?php echo json_encode($urlsLocked); ?>;

	var autoScanProcessing = false;

	jQuery(document).ready(function() {
		$(".btn-superadmin").off().click(function(){
			var action = $(this).data("action");
			var idres = $(this).data("idres");
			$(idres).html("<i class='fa fa-refresh fa-spin'></i>");
			getAjax(idres ,baseUrl+'/'+moduleId+"/co2/superadmin/action/"+action,function(data){ //alert("yeh");
				$(idres).html(data);
			},"html");
		});

		$(".btn-start-scan").click(function(){
			autoScanProcessing = true;
			autoScan();
		});
		$(".btn-stop-scan").click(function(){
			autoScanProcessing = false;
		});

	});


	var triedUrl = "";
	var toTotal = <?php echo sizeof($urlsLocked); ?>;
	var total = 0;
	var totalEchec = 0;
	function autoScan(){ console.log("start autoScan", autoScanProcessing);
		if(autoScanProcessing == false) {
			$("#status-ref").html("<span class='letter-red'><i class='fa fa-square'></i> stop</span>");
			return false;
		}
		
		$.each(urlsLocked, function(key, urlObj){ 
			
			var url = urlObj.url;
			
			//if(typeof url.hostname != "undefined")
			var path = (new URL(url)).pathname;
			url = url.replace(path, "");
			//if(typeof host != "undefined")
			//	url = host;
			console.log(url);// return false;

			$("#form-url").val(url);
			$("#status-ref").html("<span class='letter-blue'><i class='fa fa-spin fa-refresh'></i> recherche en cours</span>");
			$("#refResult").addClass("hidden");
			$("#send-ref").addClass("hidden");

			urlValidated = "";

		    $.ajax({ 
		    	url: "//cors-anywhere.herokuapp.com/"+url, // 'http://google.fr', 
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
						$("#form-description").val(description);
						

						//color
						if($("#form-title").val() != "") $("#lbl-title").removeClass("letter-red").addClass("letter-green");
						else 							$("#lbl-title").removeClass("letter-green").addClass("letter-red");
					   	
					   	//color	
						if($("#form-description").val() != "") $("#lbl-description").removeClass("letter-red").addClass("letter-green");
						else 								   $("#lbl-description").removeClass("letter-green").addClass("letter-red");
					   		
					   	//color	
						if($("#form-keywords1").val() != "")   $("#lbl-keywords").removeClass("letter-red").addClass("letter-green");
						else 								   $("#lbl-keywords").removeClass("letter-green").addClass("letter-red");
					   		
					   	$("#form-title").off().keyup(function(){
					   		if($(this).val()!="")$("#lbl-title").removeClass("letter-red").addClass("letter-green");
							else 				 $("#lbl-title").removeClass("letter-green").addClass("letter-red");
							checkAllInfo();
					   	});
					   	$("#form-description").off().keyup(function(){
					   		if($(this).val()!="")$("#lbl-description").removeClass("letter-red").addClass("letter-green");
							else 				 $("#lbl-description").removeClass("letter-green").addClass("letter-red");
							checkAllInfo();
					   	});
					   	$("#form-keywords1").off().keyup(function(){
					   		if($(this).val()!="")$("#lbl-keywords").removeClass("letter-red").addClass("letter-green");
							else 				 $("#lbl-keywords").removeClass("letter-green").addClass("letter-red");
							checkAllInfo();
					   	});

					   	$("#status-ref").html("<span class='letter-green'><i class='fa fa-check'></i> Nous avons trouvé votre page</span>");
		    			$("#refResult").removeClass("hidden");
					   
					   	$("#lbl-url").removeClass("letter-red").addClass("letter-green");
					   	urlValidated = url;

					    $('<output>').remove();
					    tempDom = "";

					    checkAllInfo();	

					    console.log("sendReferencement");
					    sendReferencement(key);

					    total++;
					    $("#nb-auto-scan").html("<span class='letter-green'>"+ total + " / " + toTotal+"</span><br>"+
					    						"<span class='letter-red'>"+ totalEchec + " / " + toTotal+"</span>");
					    $("#res-auto-scan").prepend("<div class='col-md-12 text-right margin-bottom-15'>"+
					    							"<span class='siteurl_title letter-blue'>"+title+"</span><br>"+
					    							"<span class='siteurl_hostname letter-green'>"+description+"</span><br>"+
					    							"<span class='siteurl_desc letter-grey'>"+urlValidated+"</span><br>"+
					    							"</div>");

					    console.log("setTimeout autoScan");
					    delete urlsLocked[key];
					    setTimeout(function(){ autoScan(); }, 1000);		   
					},
				error:function(xhr, status, error){
					$("#lbl-url").removeClass("letter-green").addClass("letter-red");
					$("#status-ref").html("<span class='letter-red'><i class='fa fa-ban'></i> URL INNACCESSIBLE</span>");
					//if(triedUrl != url){ triedUrl = url; }
					//else{ 
						setStateUnreachable(key);
						delete urlsLocked[key]; 
						totalEchec++;
					    $("#nb-auto-scan").html("<span class='letter-green'>"+ total + " / " + toTotal+"</span><br>"+
					    						"<span class='letter-red'>"+ totalEchec + " / " + toTotal+"</span>");
					    $("#res-auto-scan").prepend("<div class='col-md-12 text-right margin-bottom-15'>"+
					    							"<span class='siteurl_title letter-red'>404 "+url+"</span>"+
					    							"</div>");
						//alert("stop1");
					//}
					// autoScan();
					setTimeout(function(){ autoScan(); }, 1000);
				},
				statusCode:{
					// 404: function(){
					// $("#lbl-url").removeClass("letter-green").addClass("letter-red");
					// $("#status-ref").html("<span class='letter-red'><i class='fa fa-ban'></i> 404 : URL INTROUVABLE OU INACCESSIBLE</span>");
					// //if(triedUrl != url){ triedUrl = url; }
					// //else{ 
					// 	setStateUnreachable(key);
					// 	delete urlsLocked[key]; 
					// 	totalEchec++;
					//     $("#nb-auto-scan").html("<span class='letter-green'>"+ total + " / " + toTotal+"</span><br>"+
					//     						"<span class='letter-red'>"+ totalEchec + " / " + toTotal+"</span>");
					//     $("#res-auto-scan").prepend("<div class='col-md-12 text-right margin-bottom-15'>"+
					//     							"<span class='siteurl_title letter-red'>404"+url+"</span>"+
					//     							"</div>");
					// 	//alert("stop2");
					// //}
					// // autoScan();
					// setTimeout(function(){ autoScan(); }, 1000);
					// }
				}
			});
		return false;
		});
	}


function checkAllInfo(){
	if(	urlValidated != "" &&
		$("#form-keywords1").val() != "" && 
		$("#form-description").val() != "" && 
		$("#form-title").val() != "") 
   			$("#btn-validate-information").removeClass("hidden");
   	else 	$("#btn-validate-information").addClass("hidden");
}


function sendReferencement(id){
	console.log("start referencement");

	var hostname = (new URL(urlValidated)).hostname;

	var title = $("#form-title").val();
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

	//if(urlValidated != "" && title != "" && description != "" && keywords.length > 0&& categoriesSelected.length > 0){

		var urlObj = {
                //collection: "url",
                //key: "url",
        		//url: urlValidated, 
        		//hostname: hostname, 
        		title: title, 
        		description: description,
        		tags: keywords,
        		//categories : categoriesSelected,
                status: "uncomplet"
        };

 		console.log("UPDATE THIS URL DATA ?", urlObj, id);
       // if(false)
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/co2/superadmin/action/updateurlmetadata",
	        data: { "id" : id,
	        		"values" : urlObj },
	       	dataType: "json",
	    	success: function(data){
	    		if(data.valid == true) toastr.success("Votre demande a bien été enregistrée");
	    		//else toastr.error("Une erreur est survenue pendant le référencement");
	    		console.log("save referencement success");
	    	},
	    	error: function(data){
	    		toastr.error("Une erreur est survenue pendant l'envoi de votre demande", data);
	    		console.log("save referencement error");
	    	}
	    });
	//}else{
	//	toastr.error("Merci de remplir toutes les options");
	//}
}

//states = locked - unreachable - uncomplet - locked

function setStateUnreachable(id){
	var urlObj = {
                status: "unreachable"
        };

 		console.log("unreachable THIS URL DATA ?", urlObj, id);
        //if(false)
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/co2/superadmin/action/updateurlmetadata",
	        data: { "id" : id,
	        		"values" : urlObj },
	       	dataType: "json",
	    	success: function(data){
	    		if(data.valid == true) toastr.success("Votre demande a bien été enregistrée");
	    		//else toastr.error("Une erreur est survenue pendant le référencement");
	    		console.log("save referencement success");
	    	},
	    	error: function(data){
	    		toastr.error("Une erreur est survenue pendant l'envoi de votre demande", data);
	    		console.log("save referencement error");
	    	}
	    });
}

</script>
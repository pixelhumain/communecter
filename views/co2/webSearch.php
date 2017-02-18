


<hr>
<button class="btn btn-default menu-btn-back-category btn-second margin-bottom-5 margin-top-5" id="btn-new-search">
	<i class="fa fa-undo"></i> Nouvelle recherche
</button>

<?php if(sizeof($siteurls) == 0){ ?>
	<a class="btn btn-default btn-success margin-bottom-5 margin-top-5 lbh" href="#co2.referencement">
		<i class="fa fa-plus-circle"></i> Ajouter une URL
	</a><br>

	<span>
		<small><b>
		Vous connaissez un site qui n'est pas référencé ?<br> 
		Ajoutez le <span class="letter-green">gratuitement</span> dans la base de données, et faites-en profiter tout le monde !
		</b></small>
	</span>
<?php } ?>

<hr>
	<?php if($category == "Météo"){ ?>
	<h3 class="text-azure"><i class='fa fa-angle-down'></i> <i class='fa fa-sun-o'></i> Météo Nouméa</h3>

	<div id="cont_OTU3MTR8NXwzfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx">
		<div id="spa_OTU3MTR8NXwzfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx">
			<b><a id="a_OTU3MTR8NXwzfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx" class="hidden" 
				href="http://www.meteocity.com/france/noumea_v95714/" target="_blank" style="color:#333;text-decoration:none;">
				Météo Nouméa</a> © <a href="http://www.meteocity.com">meteocity.com</a></b>
		</div>
		<script type="text/javascript" src="http://widget.meteocity.com/js/OTU3MTR8NXwzfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx"></script>
	</div>

	<div id="cont_OTU3MTR8NXwyfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx" class="margin-bottom-15 visible-xs">
		<div id="spa_OTU3MTR8NXwyfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx">
			<a id="a_OTU3MTR8NXwyfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx" 
				href="http://www.meteocity.com/france/noumea_v95714/" target="_blank" style="color:#333;text-decoration:none;">Météo Nouméa</a> ©<a href="http://www.meteocity.com">meteocity.com</a>
		</div>
		<script type="text/javascript" src="http://widget.meteocity.com/js/OTU3MTR8NXwyfDV8NHwwMDAwMDB8OXxGRkZGRkZ8Y3wx"></script>
	</div>


	<?php } ?>
<h3 id="titleWebSearch" class="margin-bottom-20">
	<?php echo @$category ? " <small class='letter-blue'><i class='fa' id='fa-category'></i> ".$category."</small>" : ""; ?>
	<?php echo @$search ? " <small class='letter-blue'> <i class='fa fa-angle-right'></i> ".$search."</small><br>" : "<br>"; ?>
	

	<div class="margin-top-5">
		<i class="fa fa-angle-down"></i> 
		<?php echo sizeof($siteurls) > 0 ? sizeof($siteurls) : "aucun"; ?> 
		résultat<?php echo sizeof($siteurls) > 1 ? "s" : ""; ?> 
	</div>
</h3>



<div class="col-md-10 margin-bottom-15" style="">
<?php  foreach ($siteurls as $key => $siteurl) { ?>

<?php 
	//bold keywords found
	$siteurl["urlDisplay"] = $siteurl["url"];
	
	if(isset($siteurl["wordsFound"]))
	foreach ($siteurl["wordsFound"] as $key2 => $regexWF) { 
		if($regexWF!=""){
			$regexWFR = Search::accentToRegex($regexWF);
			$siteurl["urlDisplay"] = 	preg_replace("/(*UTF8)".$regexWFR."/" , "<b>$0</b>", @$siteurl["urlDisplay"]);
			$siteurl["title"] = 		preg_replace("/(*UTF8)".$regexWFR."/i", "<b>$0</b>", @$siteurl["title"]);
			$siteurl["description"] = 	preg_replace("/(*UTF8)".$regexWFR."/i", "<b>$0</b>", @$siteurl["description"]);
		}
	}


	if(isset($arraySearch))
	foreach ($arraySearch as $key2 => $regexWF) {  
		if($regexWF!=""){
			$regexWFR = Search::accentToRegex($regexWF);
			$siteurl["urlDisplay"] = 	preg_replace("/(*UTF8)".$regexWFR."/" , "<b>$0</b>", @$siteurl["urlDisplay"]);
			$siteurl["title"] = 		preg_replace("/(*UTF8)".$regexWFR."/i", "<b>$0</b>", @$siteurl["title"]);
			$siteurl["description"] = 	preg_replace("/(*UTF8)".$regexWFR."/i", "<b>$0</b>", @$siteurl["description"]);
		}
	}
?>


	<div class="col-md-12 margin-bottom-15 url-<?php echo $siteurl['_id']; ?>">

		<div class="addToFavInfo">
			<a href="#co2.web" class="btn-favory tooltips" data-idFav="<?php echo $siteurl['_id']; ?>" 
					data-placement="top" data-toggle="tooltip" title="Garder en favoris">
				<i class="fa fa-star-o"></i><i class="fa fa-star letter-yellow"></i>
			</a>

			<a class="siteurl_title letter-blue" target="_blank" href="<?php echo $siteurl["url"]; ?>">
				<?php if(@$siteurl["favicon"]){ ?>
					<img src='<?php echo $siteurl["favicon"]; ?>' height=17 class="margin-right-5" style="margin-top:-3px;" alt="">
				<?php } ?> 
				<?php echo $siteurl["title"]; ?>
			</a>
			<br>
			<span class="siteurl_hostname letter-green"><?php echo @$siteurl["urlDisplay"]; ?></span><br>
		</div>

		<?php if(@$siteurl["description"]){ ?>
		<span class="siteurl_desc letter-grey"><?php echo @$siteurl["description"]; ?></span><br>
		<?php } ?>

		<span class="siteurl_desc letter-grey hidden">
			<b><?php //echo $siteurl["countKW"]; ?>
			<?php if(!empty($siteurl["wordsFound"])) foreach ($siteurl["wordsFound"] as $key2 => $wordFound) { ?>
			<?php //echo $wordFound; ?>  
			<?php } ?>
			</b> 
			<!-- <b><?php if(isset($arraySearch)) foreach ($arraySearch as $key2 => $wordFound) { ?>
			<?php echo $wordFound; ?>  
			<?php } ?>
			</b>  -->
			<b><?php //if(!empty($siteurl["categories"])) foreach ($siteurl["categories"] as $key2 => $category) { ?>
			<?php //echo $category; ?>  
			<?php //} ?>
			</b> 
			<b>
				<?php //if(!empty($siteurl["tags"])) foreach ($siteurl["tags"] as $key2 => $tag) { ?>
					<?php //echo $tag; ?> 
				<?php //} ?>
			</b>
		</span>

		<?php if(Role::isSuperAdmin(Role::getRolesUserId(Yii::app()->session["userId"]) ) ) { ?>
		<button class="btn btn-xs btn-edit-url" data-target="#modalEditUrl" data-toggle="modal" data-idurl="<?php echo $key; ?>">
			<i class="fa fa-cog"></i> Editer
		</button> 
		<?php } ?>
		<br>
	</div>
<?php } ?>
</div>

<?php //if(sizeof($siteurls) < 3){ 

	$searchG = str_replace(" ", "+", $search);
?>
<div class="col-md-12 margin-bottom-50" style="margin-top:0px;">
	<hr>
	<h5 class="text-right">
		<a href="https://www.ecosia.org/search?q=<?php echo $searchG; ?>" target="_blank">
			<i class="fa fa-fw fa-angle-right"></i> continuer la recherche sur <span class="visible-xs"><br></span>
	    	<img style="margin-top:-10px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/ecosia_logo.png" height=60>
    	</a>
	</h5>
	<hr>
	<h5 class="text-right">
		<a href="https://www.google.com/search?q=<?php echo $searchG; ?>" target="_blank">
			<i class="fa fa-fw fa-angle-right"></i> continuer la recherche sur  <span class="visible-xs"><br></span>
	    	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/google.png" height=25>
    	</a>
	</h5>
</div>
<?php //} ?>



<?php if(sizeof($siteurls) >= 1){ ?>
<div class="col-md-12 margin-bottom-15 text-right" style="">
	<hr class="margin-top-5">
	<span>
		<small><b>
		Vous connaissez un site qui n'est pas référencé ici ?<br> 
		Ajoutez le <span class="letter-green">gratuitement</span> dans la base de données, et faites-en profiter tout le monde !
		</b></small>
	</span><br><br>
	<b>Référencer un site <i class="fa fa-angle-right"></i></b> 
	<a class="btn btn-default btn-success margin-bottom-5 lbh" href="#co2.referencement">
		<i class="fa fa-plus-circle"></i> Ajouter une URL
	</a> 
</div>
<?php } ?>



<script type="text/javascript" >
  
var siteurls = <?php echo json_encode($siteurls); ?>;
var search = "<?php echo $search; ?>";

jQuery(document).ready(function() { 
   Sig.showMapElements(Sig.map, siteurls);
   		
   $(".siteurl_title").click(function(){
   		var url = $(this).attr("href");
   		incNbClick(url);
   });

   $(".btn-edit-url").click(function(){ console.log("siteurls", siteurls);
   		var id = $(this).data("idurl");
   		var site = siteurls[id];
   		$("#form-idurl").val(site["_id"]['$id']);
	    $("#form-url").val(site.url);
	    $("#form-title").val(site.title);
	    $("#form-description").val(site.description);

	    if(typeof site.tags != "undefined"){
		    $("#form-keywords1").val(site.tags[0]);
		    $("#form-keywords2").val(site.tags[1]);
		    $("#form-keywords3").val(site.tags[2]);
		    $("#form-keywords4").val(site.tags[3]);
		}

	    $("#form-status").val(site.status);

	    $(".portfolio-item").removeClass("selected");
	    categoriesSelected = new Array();
	    $.each(site.categories, function(key, val){
	    	$(".portfolio-item.cat-"+val).addClass("selected");
	    	console.log("cat", val);
	    	categoriesSelected.push(val);
	    });
	    //categoriesSelected = site.categories;

	    $("#sectionSearchResults").show();
   });

   $(".menu-btn-back-category").off().click(function(){
        $("#mainCategories").show();
        $("#searchResults").html("");
        $("#sectionSearchResults").addClass("hidden");
        $("#main-search-bar").val("");
        $("#second-search-bar").val("");
        $("#input-search-map").val("");
        KScrollTo("#mainCategories");
        currentCategory = ""
    });
   
   $("#searchResults .btn-favory").click(function(){
   		var id = $(this).data("idfav");
   		addToFavorites(id);
   });


   $(".tooltips").tooltip();

   bindLBHLinks();

   initKeywords();

});

</script>
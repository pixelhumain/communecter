<?php 
$cssAnsScriptFilesModule = array(
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/select2/select2.css',
	//X-editable...
	'/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/plugins/x-editable/js/bootstrap-editable.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/plugins/wysihtml5/wysihtml5.js',
	'/plugins/jquery.scrollTo/jquery.scrollTo.min.js',
	'/plugins/ScrollToFixed/jquery-scrolltofixed-min.js',
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/plugins/jquery.appear/jquery.appear.js',
	'/plugins/jquery.elastic/elastic.js',
	'/plugins/underscore-master/underscore.js',
	'/plugins/jquery-mentions-input-master/jquery.mentionsInput.js',
	'/plugins/jquery-mentions-input-master/jquery.mentionsInput.css',
	'/plugins/jquery-mentions-input-master/lib/jquery.events.input.js',
	
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);

$cssAnsScriptFilesModule = array(
	//'/css/news/index.css',	
	'/css/news/newsSV.css',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->theme->baseUrl."/assets");

$cssAnsScriptFilesModule = array(
	'/js/news/index.js',
	'/js/news/newsHtml.js',
	'/js/dataHelpers.js'
	//'/js/news/autosize.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>	
	<!-- start: PAGE CONTENT -->

<?php
	if($type != City::CONTROLLER && $type != "pixels" && !@$_GET["renderPartial"])
		$this->renderPartial('../pod/headerEntity', 
			array("entity"=>$parent, "type" => $type, "viewer" => @$viewer, 
				  "firstView" => @$firstView, "openEdition" => @$openEdition, "edit" => $edit)); 
?>

<?php 
	//$isLive = isset($_GET["isLive"]) ? true : false;
	$contextName = "";
	$contextIcon = "bookmark fa-rotate-270";
	$contextTitle = "";
	$imgProfil = $this->module->assetsUrl . "/images/news/profile_default_l.png"; 
	$textForm = Yii::t("common","Write a public message visible on the wall of selected places");
	if( isset($type) && $type == Organization::COLLECTION && isset($parent) ){
		Menu::organization( $parent );
		//$thisOrga = Organization::getById($parent["_id"]);
		$contextName = addslashes($parent["name"]);
		$contextIcon = "users";
		$contextTitle = Yii::t("common","Participants");
		$restricted = Yii::t("common","Visible to all on this wall and published on community's network");
		$titleRestricted = "Restreint";
		$private = Yii::t("common","Visible only to the members"); 
		$titlePrivate = "Privé";
		$scopeBegin= ucfirst(Yii::t("common", "private"));	
		$public = true;
		$iconBegin= "lock";
		$headerName= "Journal de l'organisation";//.$contextName;
		$topTitle= "Journal de l'organisation";//.$contextName;
		if(@$canManageNews && $canManageNews==true)
			$textForm = Yii::t("common","Post a message in the wall of")." ".$contextName.", ".Yii::t("common","publicly shared or this community");
		else
			$textForm = Yii::t("common","Write a private message to")." ".$contextName;
	}
	else if((isset($type) && $type == Person::COLLECTION) || (isset($parent) && !@$type)){
		if((@$isLive && $isLive==true) || !@Yii::app()->session["userId"] || (Yii::app()->session["userId"] !=$contextParentId)){
			//Visible de tous sur
			//Menu::person($parent);

			$contextName =addslashes($parent["name"]);
			$contextIcon = "<i class='fa fa-circle text-yellow'></i> <i class='fa fa-user text-dark'></i> ";
			$contextTitle =  Yii::t("common", "DIRECTORY of")." ".$contextName;
			if(@Yii::app()->session["userId"] && $contextParentId==Yii::app()->session["userId"]){
				$restricted = Yii::t("common","Visible to all");
				$private = Yii::t("common","Visible only to me");
				$textForm = Yii::t("common","Write a public message visible on the wall of selected places");
			}	
			if(Yii::app()->session["userId"] ==$contextParentId){
				$headerName= "Mon journal";
				$topTitle = $headerName;
			}else{
				$headerName= "Journal de : ".$contextName;
				$topTitle = $headerName;
				$textForm = Yii::t("common","Write a private message to")." ".$contextName;
			}
		}
		else{
			$shortName=explode(" ", $parent["name"]);
			//$headerName= "Bonjour <span class='text-red'>".addslashes($shortName[0])."</span>, l'actu de votre réseau";
			$headerName= "L'actu de votre réseau";
			$restricted = Yii::t("common","Visible to all on my wall and published on my network");
			$private = Yii::t("common","Visible only to me");
			$textForm = Yii::t("common","Published a message in your wall for your network");
		}
		$scopeBegin= ucfirst(Yii::t("common", "my network"));	
		$iconBegin= "connectdevelop";
	}
	else if( isset($type) && $type == Project::COLLECTION && isset($parent) ){
		//Menu::project( $parent );
		$contextName = addslashes($parent["name"]);
		$contextIcon = "lightbulb-o";
		$contextTitle = Yii::t("common", "Contributors of project");
		$restricted = Yii::t("common","Visible to all on this wall and published on community's network");
		$private = Yii::t("common","Visible only to the project's contributors"); 
		$scopeBegin= ucfirst(Yii::t("common", "private"));	
		$iconBegin= "lock";
		$public = true;
		$headerName= "Journal du projet";//.$contextName;
		$topTitle = "Journal du projet";//.$contextName;
		if(@$canManageNews && $canManageNews==true)
			$textForm = Yii::t("common","Post a message in the wall of")." ".$contextName.", ".Yii::t("common","publicly shared or to this community");
		else
			$textForm = Yii::t("common","Write a private message to")." ".$contextName;
	}else if( isset($type) && $type == Event::COLLECTION && isset($parent) ){
	//	Menu::event( $parent );
		$contextName = addslashes($parent["name"]);
		$contextIcon = "calendar";
		$contextTitle = Yii::t("common", "Contributors of event");
		$restricted = Yii::t("common","Visible to all on this wall and published on community's network");
		$scopeBegin= ucfirst(Yii::t("common", "my network"));	
		$iconBegin= "connectdevelop";
		$headerName= "Journal de l'événement";//.$contextName;
		$topTitle = "Journal de l'événement";//.$contextName;
		if(@$canManageNews && $canManageNews==true)
			$textForm = Yii::t("common","Post a message in the wall of")." ".$contextName.", ".Yii::t("common","publicly shared or to this community");
		else
			$textForm = Yii::t("common","Write a private message to")." ".$contextName;

	}

	else if( isset($type) && $type == City::COLLECTION && isset($city) ){
		$contextName = Yii::t("common","City")." : ".$city["name"];
		$contextIcon = "university";
		$contextTitle = Yii::t("common", "DIRECTORY Local network of")." ".$city["name"];
		$scopeBegin= "Public";	
		$iconBegin= "globe";
		$headerName= "Actualités de ".$city["name"];
		$topTitle = ""; //$headerName;
		$textForm = Yii::t("common","Write a idea, a message in the city wall of")." ".$contextName;

	}
	else if( isset($type) && $type == "pixels"){
		//$contextName = "<i class='fa fa-rss'></i> Signaler un bug";
		//$contextTitle = Yii::t("common", "Contributors of project");
		$headerName= " La foire aux bugs";
		$topTitle = " La foire aux bugs";
		$textForm = Yii::t("common","Write a bug or an idea to improve the development of communecter");
	}

	$imgProfil = "";
	if($contextParentType != "city"){
		Menu::news($type);
		//$this->renderPartial('../default/panels/toolbar'); 
	}
?>
<style>
	.tools_bar{
		    border-bottom: 1px solid #E6E8E8;
	}
	.tools_bar .btn{
		    border-right: 1px solid #E6E8E8;
	}
	.mosaicflow__column {
    float:left;
    }
.mosaicflow__item img {
    display:block;
    width:100%;
    height:auto;
}
.grayscale{
	filter: grayscale(0.7) blur(1px);
	-webkit-filter: grayscale(0.7) blur(1px);
	-moz-filter: grayscale(0.7) blur(1px);
	-o-filter: grayscale(0.7) blur(1px);
	-ms-filter: grayscale(0.7) blur(1px);
}
.newImageAlbum{
	width: 75px;
    height: 75px;
    margin: 5px;
    text-align: -webkit-center;
    position: relative;
    background-color: white;
    display: inline-block;
}
.spinner-add-image{
	position: absolute;
    z-index: 10;
    left: 20px;
    top: 20px;
}
.removeImage{
	position: absolute;
    z-index: 10;
    right: 0px;
	top: 0px;
	text-shadow: 0px 0px 2px black;
}
.thumb_sel .prev_thumb {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -50px 0px;
	background-color: rgba(250,250,250,0.5);
	float: left;
	width: 26px;
	height: 22px;
	cursor: hand;
	cursor: pointer;
}
.thumb_sel .prev_thumb:hover {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat 0px 0px;
}
.thumb_sel .next_thumb {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -76px 0px;
	background-color: rgba(250,250,250,0.5);
	float: left;
	width: 24px;
	height: 22px;
	cursor: hand; 
	cursor: pointer;
}
.thumb_sel .next_thumb:hover {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -26px 0px;
}
#dropdown_search{
	display:none;
    border: 1px solid #eee;
    max-height: 160px;
    overflow-y: auto;
    position: relative;
}
#dropdown_search .li-dropdown-scope{
	text-align: left;
	width:100%;
}
#dropdown_search .li-dropdown-scope a{
	font-size:12px;
	    line-height: 25px;
}
/*.results{
	margin-top: 10px;
}*/

.timeline_element .timeline_text{
	font-size:14px !important;
}
.timeline_element .img-responsive{
	max-height:300px !important;
}

#form-news{
	display: inline-block;
    width: 100%;
    padding-bottom: 10px;
}
#btn-submit-form {
    /*right: 30px;
    position: absolute;
    bottom: 10px;*/
    position:relative;
    float: right;
}
.timeline_shared_picture{
	margin-top:5px;
}
.timeline_element .tag_item_map_list {
    color: #F00;
    font-weight: 200 !important;
    font-size: 12px !important;
    cursor: pointer;
}
.main-col-search{
	min-height:1100px !important;
}
.timeline_element .label-danger {
    margin-bottom: 3px;
    display: inline-block;
}
#footerDropdown{
	position:relative;
	background-color: transparent !important;
}
.tag.bold{
	font-weight:600 !important;
}
.timeline_element{
	padding-bottom: 0px;
}
.bar_tools_post {
    font-size: 15px;
}

#form-news hr , .list-select-scopes hr{
    border-top: 1px solid #d8d8d8;
}
#form-news hr.submit {
    margin: 0 0 10px 0 !important;
    display: block;
}

#btn-rss {
	background-color: #FE9A2E;
	border-radius: 50px;
}

</style>
<!--<textarea class="mention"></textarea>-->


<?php 
	if($isLive)
		$this->renderPartial('../news/podBtnTypeNews', array("type"=>$type, "filterTypeNews"=>@$filterTypeNews)); 
?>

<!-- <div id="newLiveFeedForm" class="col-xs-12 no-padding margin-bottom-10"></div> -->
<div id="formCreateNewsTemp" style="float: none;display:none;" class="center-block">
	<div class='no-padding form-create-news-container col-sm-12'>

	<?php 	//if (@$parent['id']) {echo $parent['id'];}
	    	//if (@$parent['type'] {echo $parent['type'];}
			if (@$myMultiTags) {
	 			var_dump($myMultiTags);

			}
 			//var_dump($parent);
 			//var_dump($parent['_id']);
 			//var_dump($parent['_id']['$id']);
 			
 			//$test = $parent['_id'];
			//var_dump($test['$id']);

 			//var_dump($parent['typeSig']);
			 

		if(false) { ?>
		<div class="col-xs-12" style="margin-top: 10px; margin-bottom: 10px; margin-left: 0px;padding: 0px 10px;"  id="list_type_news">
		  
		  <div class="btn-group btn-group-sm inline-block" id="menu-type-news">
		    <button class="btn btn-default btn-type-news tooltips text-dark active" 
		    		data-toggle="tooltip" data-placement="top" title="Messages" data-type="news">
		      <i class="fa fa-check-circle-o search_news hidden"></i> <i class="fa fa-rss"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Message</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="top" title="Idée" data-type="idea">
		      <i class="fa fa-circle-o search_organizations hidden"></i> <i class="fa fa-info-circle"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Idée</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="top" title="Question" data-type="question">
		      <i class="fa fa-circle-o search_projects hidden"></i> <i class="fa fa-question-circle"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Question</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="top" title="Annonce" data-type="announce">
		      <i class="fa fa-circle-o search_events hidden"></i> <i class="fa fa-ticket"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Annonce</span>
		    </button>
		    <button class="btn btn-default btn-type-news tooltips text-dark" 
		    		data-toggle="tooltip" data-placement="top" title="Information" data-type="information">
		      <i class="fa fa-circle-o search_needs hidden"></i> <i class="fa fa-newspaper-o"></i> 
		      <span class="hidden-xs hidden-sm hidden-md">Information</span>
		    </button>
		  </div>

		</div>
	<?php } ?>

		<h5 class='padding-10 partition-light no-margin text-left header-form-create-news' style="margin-bottom:-40px !important;"><i class='fa fa-angle-down'></i> <i class="fa fa-file-text-o"></i> <span id="info-write-msg"><?php echo $textForm; ?></span>
		<a class="btn btn-xs pull-right" style="margin-top: -4px;" onclick="javasctipt:showFormBlock(false);">
			<i class="fa fa-times"></i>
		</a>
		</h5>

		<div class="tools_bar bg-white">
			<?php if((@$canManageNews && $canManageNews==true) || (@$isLive && $isLive == true)){ ?>
			<div class="user-image-buttons">
				<form method="post" id="photoAddNews" enctype="multipart/form-data">
					<span class="btn btn-white btn-file fileupload-new btn-sm"  <?php if (!$authorizedToStock){ ?> onclick="addMoreSpace();" <?php } ?>><span class="fileupload-new"><i class="fa fa-picture-o fa-x"></i> </span>
						<?php if ($authorizedToStock){ ?>
							<input type="file" accept=".gif, .jpg, .png" name="newsImage" id="addImage" onchange="showMyImage(this);">
						<?php } ?>
						
					</span>
				</form>
			</div>
			<?php } ?>
		</div>

		<form id='form-news' class="col-sm-12 no-padding">
			
			<input type="hidden" id="parentId" name="parentId" value="<?php if($contextParentType != "city") echo $contextParentId; else echo Yii::app()->session["userId"]; ?>"/>
			<input type="hidden" id="parentType" name="parentType" value="<?php if($contextParentType != "city") echo $contextParentType; else echo Person::COLLECTION; ?>"/> 
			
			<input type="hidden" id="typeNews" name="type" value="news"/>

			<input 	type="text" id="falseInput" onclick="javascript:showFormBlock(true);" 
					class="col-xs-12 col-md-12" placeholder="Exprimez-vous ..."   style="padding:15px;"/>

			<div class="extract_url">
				<div class="padding-10 bg-white">
					<img class="loading_indicator" src="<?php echo $this->module->assetsUrl ?>/images/news/ajax-loader.gif">
					<textarea id="get_url" placeholder="Exprimez-vous ..." class=" get_url_input form-control textarea mention" style="border:none;background:transparent !important" name="getUrl" spellcheck="false" ></textarea>
					<ul class="dropdown-menu" id="dropdown_search" style="">
					</ul>

					<div id="results" class="bg-white results col-sm-12"></div>
				</div>
			</div>
			<div class="form-group tagstags col-sm-12 no-padding">
			    <input id="tags" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">		    
			</div>
			<div class="form-actions no-padding" style="display: block;">
				
				<div id="scopeListContainer" class="list_tags_scopes col-md-12 no-padding margin-bottom-10"></div>

				<div class="col-md-12 no-padding">
					<hr class="submit">
					
					<button id="btn-submit-form" type="submit" class="btn btn-green pull-right">Envoyer <i class="fa fa-arrow-circle-right"></i></button>


				<?php if((@$canManageNews && $canManageNews==true) 
							|| (@Yii::app()->session["userId"] 
							&& $contextParentType==Person::COLLECTION 
							&& Yii::app()->session["userId"]==$contextParentId)){ ?>
				
				<!--<div id="tagScopeListContainer" class="list_tags_scopes col-xs-12 no-padding"></div>
				<input type="hidden" name="scope" value="public"/>-->
				
				<div class="dropdown col-md-6 no-padding">
					<a data-toggle="dropdown" class="btn btn-default" id="btn-toogle-dropdown-scope" href="#"><i class="fa fa-<?php echo $iconBegin ?>"></i> <?php echo $scopeBegin ?> <i class="fa fa-caret-down" style="font-size:inherit;"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<?php if (@$private && ($contextParentType==Project::COLLECTION || $contextParentType==Organization::COLLECTION)){ ?>
						<li>
							<a href="javascript:;" id="scope-my-network" class="scopeShare" data-value="private"><h4 class="list-group-item-heading"><i class="fa fa-lock"></i> <?php echo ucfirst(Yii::t("common", "private")) ?></h4>
								<p class="list-group-item-text small"><?php echo $private ?></p>
							</a>
						</li>
						<?php } ?>
						<?php if(@$restricted){ ?>
							<li>
							<a href="javascript:;" id="scope-my-network" class="scopeShare" data-value="restricted"><h4 class="list-group-item-heading"><i class="fa fa-connectdevelop"></i> <?php echo ucfirst(Yii::t("common", "my network")) ?></h4>
								<p class="list-group-item-text small"><?php echo $restricted ?></p>
							</a>
						</li>
						<?php } ?>
						<?php if(@$public){ ?>
						<li>
							<a href="javascript:;" id="scope-my-wall" class="scopeShare" data-value="public"><h4 class="list-group-item-heading"><i class="fa fa-globe"></i> <?php echo ucfirst(Yii::t("common", "public")) ?></h4>
								<!--<div class="small" style="padding-left:12px;">-->
							<p class="list-group-item-text small"><?php echo Yii::t("common","Visible to all and posted on cities' live")?></p>
							</a>
						</li>
						<?php } ?>
						<?php if (@$private && $contextParentType==Person::COLLECTION){ ?>
						<li>
							<a href="javascript:;" id="scope-my-network" class="scopeShare" data-value="private"><h4 class="list-group-item-heading"><i class="fa fa-lock"></i> <?php echo ucfirst(Yii::t("common", "private")) ?></h4>
								<p class="list-group-item-text small"><?php echo $private ?></p>
							</a>
						</li>
						<?php } ?>
						<!--<li>
							<a href="#" id="scope-select" data-toggle="modal" data-target="#modal-scope"><i class="fa fa-plus"></i> Selectionner</a>
						</li>-->
					</ul>
				</div>	

				
				<?php if($contextParentType == Organization::COLLECTION || $contextParentType == Project::COLLECTION){ ?>
				<div class="dropdown no-padding pull-right">
					<a data-toggle="dropdown" class="btn btn-default" id="btn-toogle-dropdown-targetIsAuthor" href="#">
					<?php if(@$parent["profilThumbImageUrl"]){ ?>
						<img height=20 width=20 src='<?php echo Yii::app()->getRequest()->getBaseUrl(true).$parent["profilThumbImageUrl"] ?>'>
					<?php } else{ ?>
						<img height=20 width=20 src='<?php echo $this->module->assetsUrl.'/images/thumb/default_'.$contextParentType.'.png' ?>'>	
					<?php } ?>
						<i class="fa fa-caret-down" style="font-size:inherit;"></i>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li>
							<a href="javascript:;" class="targetIsAuthor" data-value="1">
								<h4 class="list-group-item-heading">
								<?php if(@$parent["profilThumbImageUrl"]){ ?>
									<img height=20 width=20 src='<?php echo Yii::app()->getRequest()->getBaseUrl(true).$parent["profilThumbImageUrl"] ?>'>
								<?php } else { ?>
									<img height=20 width=20 src='<?php echo $this->module->assetsUrl.'/images/thumb/default_'.$contextParentType.'.png' ?>'>	
								<?php } ?>
								<?php echo $contextName ?></h4>
								<p class="list-group-item-text small">Afficher <?php echo $contextName ?> comme auteur</p>
							</a>
						</li>
						<li>
							<a href="javascript:;" class="targetIsAuthor" data-value="0"><h4 class="list-group-item-heading">
								<?php if(@ Yii::app()->session["user"]["profilThumbImageUrl"]){ ?>
								<img height=20 width=20 src='<?php echo Yii::app()->getRequest()->getBaseUrl(true).Yii::app()->session["user"]["profilThumbImageUrl"]; ?>'>
								<?php } else {  ?>
									<img height=20 width=20 src='<?php echo $this->module->assetsUrl.'/images/thumb/default_citoyens.png' ?>'>	
								<?php } ?>
								<?php echo ucfirst(Yii::t("common", "Moi")) ?></h4>
								<p class="list-group-item-text small"><?php echo "Je suis l'auteur" ?></p>
							</a>
						</li>
					</ul>
					<input type="hidden" id="authorIsTarget" value="1"/>
				</div>	
					<?php } ?>		
				<?php } ?>



				<?php if($type=="city"){ ?>
					<?php /* ?>
					<input type="hidden" name="cityInsee" value=""/>
					<input type="hidden" id="cityPostalCode" name="cityPostalCode" value=""/>
					<p class="text-xs hidden-xs" style="position:absolute;bottom:20px;"><?php echo Yii::t("news","News sent to") ?>:</p> 
					<div class="badge cityBadge" style="position:absolute;bottom:10px;">
					</div><?php */ ?>
					<input type="hidden" name="scope" value="public"/>
				<?php } ?>
									
				
				<?php if((@$canManageNews && $canManageNews=="true") || (
						@Yii::app()->session["userId"] && 
						$contextParentType==Person::COLLECTION && Yii::app()->session["userId"]==$contextParentId)){ ?>
				
						<?php if($contextParentType==Organization::COLLECTION || $contextParentType==Project::COLLECTION){ ?>
							<input type="hidden" name="scope" value="private"/>
						<?php } else if($contextParentType==Event::COLLECTION || $contextParentType==Person::COLLECTION){ ?>
							<input type="hidden" name="scope" value="restricted"/>
						<?php } else { ?>
						<input type="hidden" name="scope" value="public"/>
						<?php } ?>

				<?php }else{ if($contextParentType==Event::COLLECTION){?>
					
					<input type="hidden" name="scope" value="restricted"/>

				<?php } else { ?>

					<input type="hidden" name="scope" value="private"/>

				<?php } } ?>
				</div>
			</div>
		</form>
	 </div>
</div>


<?php if( !isset( Yii::app()->session['userId'] ) ) { ?>
<div class="alert col-md-12 col-xs-12 center" style="margin-bottom: 0px; margin-top: 0px; ">
  <div class="col-md-12 margin-bottom-10"><i class="fa fa-info-circle"></i> Vous devez être connecté pour publier du contenu.</div>
  <!-- <button class="btn-top btn btn-success" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> <span class="hidden-xs">S'inscrire</span></button>
  <button class="btn-top btn bg-red" style="margin-right:10px;" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> <span class="hidden-xs">Se connecter</span></button>  -->
</div>
<?php } ?>
<div id="newsPad">
	<div id="newsHistory" class="padding-10">
		<!--<div class="margin-top-10">
			<button class="btn text-red btn-default" id="btn-filter-tag-news" onclick="toggleFilters('#tagFilters');"># Rechercher par tag</button>
			<button class="btn text-red btn-default" id="btn-filter-scope-news" onclick="toggleFilters('#scopeFilters');"><i class="fa fa-circle-o"></i> Rechercher par lieu</button>
			<button class="btn btn-sm btn-default bg-red" onclick="showAllNews();"><i class="fa fa-times"></i> Annuler</button>
		</div>-->
		<div class="col-md-11 no-padding main-col-live">
			<!-- start: TIMELINE PANEL -->
			<div class="no-padding panel" style="padding-top:10px;box-shadow:inherit;">
				<div id="top" class="no-padding panel-body">
					<div id="tagFilters" class="optionFilter pull-left center col-md-10" style="display:none;" ></div>
					<div id="scopeFilters" class="optionFilter pull-left center col-md-10" style="display:none;" ></div>

					<?php 
						if ($parent['typeSig'] == "people") {
							$parent['typeSig'] = "citoyens";
						}
											
					?> 
		
					<div id="timeline" class="col-md-12">
						<div class="timeline col-md-12 no-padding">
							<div class="newsTL">
								<div class="spine"></div>

								<!--<?php //if ((isset($parent['id'])) && (isset($parent['typeSyg']))) { ?>-->
																
								<div id="div_rss"> 
									<a target="_blank" id="btn-rss" class="tooltips btn btn-default  communityBtn btn-menu-element btn-menu-element-directory" role ="button" href="http://127.0.0.1/ph/api/news/get/idElement/<?php echo $parent['_id'];?>/typeElement/<?php echo $parent['typeSig'];?>/format/rss"><i class="fa fa-rss" aria-hidden="true"></i> 
								<!--<?php //echo $parent['typeSig'];?><?php //echo $parent['_id'];?> -->
									</a>

									<div id="btn-rss-test"></div>
								
								</div>

								<!--<?php //} ?>-->
							</div>
						</div>
					</div>
					<ul class="timeline-scrubber inner-element newsTLmonthsList col-md-2"></ul>
				</div>
				<div class="stream-processing center">
					<span class="search-loader-news text-dark" style="font-size:20px;"><i class="fa fa-circle-o-notch fa-spin"></i></span>
				</div>
			</div>
			<!-- end: TIMELINE PANEL -->
		</div>
	</div>
</div>
<?php if(!@$_GET["renderPartial"] && ($contextParentType==Project::COLLECTION || $contextParentType==Event::COLLECTION || $contextParentType==Organization::COLLECTION || ($contextParentType==Person::COLLECTION && (!@Yii::app()->session["userId"] || (@Yii::app()->session["userId"] && Yii::app()->session["userId"]!= $contextParentId) && (@$isLive && $isLive != true))))){ 
	// End div .pad-element-container if newspaper of orga, project, event and person 
	// Present in pod/headerEntity.php
?>
</div>
<?php } ?>
<div id="modal_scope_extern" class="form-create-news-container hide"></div>


<?php 
foreach($news as $key => $oneNews){
	if(@$news[$key]["type"] && $news[$key]["type"] != "activityStream")
		$news[$key]["typeSig"] = $news[$key]["type"];
	//else
		//$news[$key]["typeSig"] = "news";	
}
?>

<!-- end: PAGE CONTENT-->
<script type="text/javascript">
/*
	Global Variables to initiate timeline
	- offset => represents measure of last newsFeed (element for each stream) to know when launch loadStrean
	- lastOffset => avoid repetition of scrolling event (unstable behavior)
	- dateLimit => date to know until when get new news
*/
<?php if(@$isLive){ ?>
	isLive="<?php echo $isLive ?>";
<?php } else{ ?>
	isLive="";
<?php } ?>

<?php if (@$news && !empty($news)){ ?>
var news = <?php echo json_encode(@$news)?>;
console.log("NEWSSS", news);
<?php }else { ?>
var news = "";
<?php } ?>
var parent = <?php echo json_encode(@$parent)?>;

var newsReferror={
		"news":{
			"offset":"",
			"dateLimit":0,
			"lastOffset":""
			},
		"activity":{
			"offset":"",
			"dateLimit":0,
			"lastOffset":""
			},
	};
var mode = "view";
var canPostNews = <?php echo json_encode(@$canPostNews) ?>;
var canManageNews = <?php echo json_encode(@$canManageNews) ?>;
var idSession = "<?php echo Yii::app()->session["userId"] ?>";
var contextParentType = <?php echo json_encode(@$contextParentType) ?>;
var contextParentId = <?php echo json_encode(@$contextParentId) ?>;
var countEntries = 0;
var offset="";
var	dateLimit = 0;	
var lastOffset="";
var streamType="news";
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];
var formCreateNews;
var indexStep = 5;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var currentMonth = null;
var scrollEnd = false;
var totalEntries = 0;
var timeout = null;
var tagsFilterListHTML = "";
var scopesFilterListHTML = "";
var loadingData = false;
var initLimitDate = <?php echo json_encode(@$limitDate) ?>;
var docType="<?php echo Document::DOC_TYPE_IMAGE; ?>";
var contentKey = "<?php echo Document::IMG_SLIDER; ?>";
var uploadUrl = "<?php echo Yii::app()->params['uploadUrl'] ?>";
var locality = "<?php echo @$locality ?>";
var searchBy = "<?php echo @$searchBy ?>";
var tagSearch = "<?php //echo @$tagSearch ?>";
var peopleReference=false;
var mentionsContact = [];

var stopMention = false;
var element = null;
	
jQuery(document).ready(function() 
{

	currentTypeSearchSend = "search";
	if(typeof globalTheme =="undefined")
		multiTagScopeLbl(currentTypeSearchSend);
 	activeMenuElement("news");
 	if(!isLiveGlobal() && typeof globalTheme =="undefined")
	 	selectAllTags(false);
	if(location.hash.indexOf("#default.live") == 0){//contextParentType=="city"){
		//$("#cityInsee").val(inseeCommunexion);
		//$("#cityPostalCode").val(cpCommunexion);
		$(".cityBadge").html("<i class=\"fa fa-university\"></i> "+cpCommunexion);
	}else{
		$(".list_tags_scopes").addClass("tagOnly");
	}
	//canManageNews="";
	//Modif SBAR
	//$(".my-main-container").off(); 
	if(contextParentType=="pixels"){
		tagsNews=["bug","idea"];
	}
	else {
		tagsNews = <?php echo json_encode($tags); ?>
	}
	/////// A réintégrer pour la version last
	var $scrollElement = $(".my-main-container");

	
	$('#tags').select2({tags:tagsNews});
	$("#tags").select2('val', "");
	if(contextParentType != "city")

	smoothScroll('0px');
	<?php if(@$topTitle != ""){ ?>
		if(contextParentType=="pixels")
			icon="bullhorn";
		else
			icon="rss";
		setTitle("<?php echo @$headerName; ?>",icon, "<?php echo @$topTitle; ?>");
	<?php } ?>
	//<span class='text-red'><i class='fa fa-rss'></i> Fil d'actus de</span>
	//if(contextParentType!="city"){
		
		//if(contextParentId == idSession)
		/*$(".moduleLabel").html("<i class='fa fa-rss'></i> Mon fil d'actus" + 
								"<img class='img-profil-parent' src='<?php echo $imgProfil; ?>'>");
		else
		$(".moduleLabel").html("<span class='text-red'><i class='fa fa-rss'></i> Fil d'actus de</span> <?php echo addslashes(@$contextName); ?>" + 
								"<img class='img-profil-parent' src='<?php echo $imgProfil; ?>'>");*/
		
		
	/*}else{
		
	}*/



	
	// SetTimeout => Problem of sequence in js script reader
	setTimeout(function(){
		//loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
		mylog.log(news, news);
		buildTimeLine (news, 0, indexStep);
		bindTags();
		//mylog.log(news);
		if(typeof(initLimitDate.created) == "object")
			dateLimit=initLimitDate.created.sec;
		else
			dateLimit=initLimitDate.created;
		
		$(".my-main-container").bind("scroll",function(){ //mylog.log(loadingData, scrollEnd);
		    if(!loadingData && !scrollEnd){
		          var heightContainer = $(".my-main-container")[0].scrollHeight;
		          if(isLiveGlobal()){
		          	heightContainer = $("#timeline").height(); mylog.log("heightContainer", heightContainer);
		          }
		          var heightWindow = $(window).height();
		          console.log($(this).scrollTop());
		          console.log(heightContainer - 200);
		          console.log($(this).scrollTop() + "///" + heightContainer - 200)
		          if( ($(this).scrollTop() + heightWindow) >= heightContainer - 200){
		            mylog.log("scroll in news/index MAX");
		            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
		          }
		    }
		});
		$('.tooltips').tooltip();
	},100);
	getMediaFromUrlContent(".get_url_input",".results",1);
	
	setTimeout(function(){
		$("#btn-submit-form").on("click",function(){
			saveNews();
		});
	},500);

	//Sig.restartMap();
	//Sig.showMapElements(Sig.map, news);
	initFormImages();
	console.log(myContacts);
	if(myContacts != null){
		$.each(myContacts["people"], function (key,value){
			if(typeof(value) != "undefined" ){
				avatar="";
				console.log(value);
			  	if(value.profilThumbImageUrl!="")
					avatar = baseUrl+value.profilThumbImageUrl;
			  	object = new Object;
			  	object.id = value._id.$id;
			  	object.name = value.name;
				object.avatar = avatar;
				object.type = "citoyens";
				mentionsContact.push(object);
			}
	  	});
	  	$.each(myContacts["organizations"], function (key,value){
		  	if(typeof(value) != "undefined" ){
		  	avatar="";
		  	if(value.profilThumbImageUrl!="")
				avatar = baseUrl+value.profilThumbImageUrl;
		  	object = new Object;
		  	object.id = value._id.$id;
		  	object.name = value.name;
			object.avatar = avatar;
			object.type = "organizations";
			mentionsContact.push(object);
			}
	  	});
	}
	
	$('textarea.mention').mentionsInput({
	  onDataRequest:function (mode, query, callback) {
		  	if(stopMention)
		  		return false;
		  	var data = mentionsContact;
		  	data = _.filter(data, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
			callback.call(this, data);

			/*if(query.indexOf("+")==0) {
				element = "";
				if(query.indexOf("+o")==0){
					element = "organization";
					form = "\n>organizationName:";//form = "\n>name:";
					form += "\n>shortDescription:";
					form += "\n>description:";
			        form += "\n>organizationEmail:";//form += "\n>email:";
			        form += "\n>streetAddress:";//address
			        form += "\n>postalCode:97421";
			        form += "\n>city:97414";
			        form += "\n>cityName:ST LOUIS";
			        form += "\n>organizationCountry:RE";
					form += "\n>type:NGO|LocalBusiness|Group|GovernmentOrganization";
					form += "\n>role:admin|member|creator";

		        }
		        else if(query.indexOf("+pt")==0){
					element = "poi";
					form = "\n>name:";
		        }
		        if( element ){
		        	stopMention = true;
					$("#get_url").val( $("#get_url").val() + form);
					return false;
				}
			}*/


	   		var search = {"search" : query};
	  		$.ajax({
				type: "POST",
		        url: baseUrl+"/"+moduleId+"/search/searchmemberautocomplete",
		        data: search,
		        dataType: "json",
		        success: function(retdata){
		        	if(!retdata){
		        		toastr.error(retdata.content);
		        	}else{
			        	//mylog.log(retdata);
			        	data = [];
			        	for(var key in retdata){
				        	for (var id in retdata[key]){
					        	avatar="";
					        	if(retdata[key][id].profilThumbImageUrl!="")
					        		avatar = baseUrl+retdata[key][id].profilThumbImageUrl;
					        	object = new Object;
					        	object.id = id;
					        	object.name = retdata[key][id].name;
					        	object.avatar = avatar;
					        	object.type = key;
					        	var findInLocal = _.findWhere(mentionsContact, {
									name: retdata[key][id].name, 
									type: key
								}); 
								if(typeof(findInLocal) == "undefined")
									mentionsContact.push(object);
					 			}
			        	}
			        	data=mentionsContact;
			        	//mylog.log(data);
			    		data = _.filter(data, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
						callback.call(this, data);
						mylog.log(callback);
		  			}
				}	
			})
	  }
  	});

   	//Construct the first NewsForm
	//buildDynForm();
	//déplace la modal scope à l'exterieur du formulaire

<?php if(@$isLive){ ?>
	isLive="<?php echo $isLive ?>";
<?php } ?>

<?php if(!isset($parent)) { ?>


	var string_tag = getStringTag();

	if (string_tag !== '') {
		$('#div_rss').html(
				'<a target="_blank" id="btn-rss" class="tooltips btn btn-default  communityBtn btn-menu-element btn-menu-element-directory" role ="button" href="http://127.0.0.1/ph/api/news/get/tags/'+ string_tag +'/format/rss">' +
				'<i class="fa fa-rss" aria-hidden="true"></i> ' +
										
				'</a> '

 					);
	} else {
		$('#div_rss').html(
				'<a target="_blank" id="btn-rss" class="tooltips btn btn-default  communityBtn btn-menu-element btn-menu-element-directory" role ="button" href="http://127.0.0.1/ph/api/news/get/format/rss">' +
				'<i class="fa fa-rss" aria-hidden="true"></i> ' +
										
				'</a> '

 					);
	}
  		
<?php } ?>

 	$('#modal-scope').appendTo("#modal_scope_extern") ;
 	if(isLiveGlobal())
 		showTagsScopesMin(".list_tags_scopes");
 	showFormBlock(false);
});
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}


</script>

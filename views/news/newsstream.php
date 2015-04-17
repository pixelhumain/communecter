<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($this->module->assetsUrl.'/js/news/formScope.js' , CClientScript::POS_END);
	$cs->registerScriptFile($this->module->assetsUrl.'/js/news/formGenreAbout.js' , CClientScript::POS_END);
	$cs->registerCssFile($this->module->assetsUrl. '/css/news_form.css');
	
?>


<script type="text/javascript" src="<?php echo $this->module->assetsUrl.'/js/news/formScope.js';?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl.'/js/news/formGenreAbout.js';?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl.'/css/news_form.css';?>" type="text/css" />

<style>
.subviews-top{
	//background-color:#d5d5d5;
}
#more_info_news{
	float:right;
	width:45%;
	background-color:#5F8295;
}
div.timeline{ margin-right:0px; }

</style>


<div class="col-md-9">
	<div class="tabbable partition-dark" >
												
		<ul id="myTab6" class="nav nav-tabs">
			<li class="active">
				<a href="#myTab6_example1" data-toggle="tab">
					<i class="fa fa-quote-left"></i> Fil d'actualités
				</a>
			</li>
			<li>
				<a href="#myTab6_example2" data-toggle="tab" style="color:yellow">
					<i class="blue fa fa-user"></i> Peter Clark
				</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane fade in active" id="myTab6_example1" style="float:left;">				
					
			<!-- 	PARAMETRAGE		 -->
			
<!-- 			<button type="button" id="btn_import_data" class="btn btn-primary" style="float:right;">Importer les données</button></br></br> -->

				<div class="col-sm-12" style="padding:0px; margin-top:0px;">
				<!-- 	FILTRE PAR TYPE DE MESSAGE (NATURE)		 -->
					<div class="panel panel-info" style="margin-top:0px;">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-chevron-down"></i> Filtrer par type de message ...</h4>
						</div>
						<div class="panel-body" style="padding:0px; padding-bottom:10px; padding-top:10px; padding-left:2%;">
							<!-- 	FILTRES NATURES -->
							<?php
							$natures = array( 	array("free_msg", 			"white"), 
												array("idea", 				"yellow"), 
												array("help", 				"red"), 
												array("rumor", 				"orange"), 
												array("true_information", 	"green") ,
												array("question", 			"purple")
											);

							$selected=" selected";
							foreach($natures as $nature) { 
					
										echo "<a href='javascript:selectGenreNewsstream(\"".$nature[0]."\")' onmouseover='javascript:showTooltipGenre(\"".$nature[0]."\")'>";
										echo "<span class='header_post ".$nature[1]." itemBtnSelectGenreNewsStream".$selected."'  id='itemSelectGenre".$nature[0]."'>";
											echo "<img src='".$this->module->assetsUrl."/images/news/natures/".$nature[0].".png' style='margin-top:2px;' height=23>";
										echo "</span>";
										echo "</a>";

										$selected="";
							}
							?>
						</div>
						
					</div>
					<div id="tooltip_genre_block" style="margin-top:-25px; margin-bottom:15px; margin-left:10px;">
							<div class="header_new_post white" id="tooltip_genre_name">Message libre</div>
						</div>
					<!-- 	FILTRE PAR TYPE DE MESSAGE (NATURE)		 -->
				</div>	

				<!-- 	FILTRE PAR ORIGINE		 -->
				<div class="col-sm-6" style="padding:0px; margin-top:0px;">
						
					<div class="panel panel-info" style="margin-top:0px; display:inline-block; float:right;">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-chevron-down"></i> Filtrer par origine ...</h4>
						</div>
						<label class="control-label" style="margin-top:15px;">
							<div id="hashtags_list" class="tagsinput"></div>
						</label>	
		
						<div class="panel-body" style="max-width:350px; padding:10px; margin-bottom:5px;" id="config_dest">
						<div class="form-group">
		
							<div style="text-align:left;">
								<div style="text-align:left; margin-bottom:0px;">
														<!-- 			CONTACTS					 -->
			
								<i class="fa fa-navicon"></i><b> Vos contacts : </b></br>
			
								<div class="btn-group" id="btn-group-contact" style="width:100%; margin-top:4px;">
								<a class="btn btn-blue btn-sm" style="padding-left:18px; padding-right:18px;" id="btn_group_contact_contact" href="javascript:showDestInput('contact', 'contact')">
									<i class="fa fa-user"></i>
									Contacts
								</a>
								<a class="btn btn-default btn-sm" style="padding-left:18px; padding-right:20px;" id="btn_group_contact_groupe" href="javascript:showDestInput('contact', 'groupe')">
									<i class="fa fa-users"></i>
									Groupes
								</a>
								<a class="btn btn-default btn-sm" style="padding-left:20px; padding-right:20px;" id="btn_group_contact_organisation" href="javascript:showDestInput('contact', 'organisation')">
									<i class="fa fa-university"></i>
									Organisations
								</a>
								</div>
								<div class="input-group" id="input-group-contact" style="width:272px;">
									<input id="scope_news_contact" placeholder="@contact..." class="form-control input-mask-product" type="text">
				
									<ul class="dropdown-menu" id="dropdown_contact" style="width:100%;">
										<li class="li-dropdown-scope">-</li>
									</ul>
								</div>
			
			
							</div>
							<div style="text-align:left; margin-top:30px; margin-bottom:0px;">
														<!-- 			ADMINISTRATIF						 -->
		
								<b><i class="fa fa-bank" style="margin-top:0px; "></i> Administratif : </b>
								<select style="margin-bottom:4px; margin-top:-7px; max-width:130px; font-size:12px;" id="select_state">
									<option value="fr">France
									<option value="be">Belgique
									<option value="ch">Suisse
									<option value="ca">Canada
									<option value="gb">Royaumes-Unis
									<option value="es">Espagne
									<option value="it">Italie
									<option value="pt">Portugal
									<option value="us">USA
									<option value="au">Australie						
								</select>

			
			
								<div class="btn-group" id="btn-group-geo" style="width:100%;">
								<a class="btn btn-blue btn-sm" style="padding-left:15px; padding-right:15px;" id="btn_group_geo_ville" href="javascript:showDestInput('geo', 'ville')">
									<i class="fa fa-building"></i>
									Ville
								</a>
								<a class="btn btn-default btn-sm" style="padding-left:14px; padding-right:14px;" id="btn_group_geo_departement" href="javascript:showDestInput('geo', 'departement')">
									<i class="fa fa-puzzle-piece"></i>
									Département
								</a>
								<a class="btn btn-default btn-sm" style="padding-left:14px; padding-right:14px;" id="btn_group_geo_region" href="javascript:showDestInput('geo', 'region')">
									<i class="fa fa-home"></i>
									Région
								</a>
								<a class="btn btn-default btn-sm" style="padding-left:15px; padding-right:15px;" id="btn_group_geo_pays" href="javascript:showDestInput('geo', 'pays')">
									<i class="fa fa-globe"></i>
									Pays
								</a>
								</div>								
								<div class="input-group" id="input-group-geo" style="width:302px;">
									<input id="scope_news_geo" placeholder="@ville" class="form-control input-mask-product" type="text">
				
									<ul class="dropdown-menu" id="dropdown_geo" style="width:100%; left:0px;">
										<li class="li-dropdown-scope">-</li>
									</ul>
								</div>
			
			
							</div>
							</div>
							</div>
		
		
	
						</div>
					</div>	
				
				</div>
				<!-- 	FILTRE PAR ORIGINE		 -->
					
					
				<!-- 	FILTRE PAR THEME		 -->
				<div class="col-sm-6" style="margin-top:0px;">
	
						
					<!-- 	FILTRE PAR THÈME (CATÉGORIE)		 -->
					<div class="panel panel-info" style="display:inline-block;">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-chevron-down"></i> Filtrer par thème ...</h4>
						</div>
						<div class="panel-body"style="padding:0px; ">
							<!-- 	FILTRES THEMES -->	
							<div style="max-width:350px;">
								<div class="" style=" padding:10px;" id="config_dest">
									<?php
										for($i=1;$i<21;$i++) //background-color:#5F8295;
										{
											echo "<a href='javascript:checkChkAbout(".$i.")' id='about_".$i."' class='alert alert-info label-article-about ' style=''>";
											echo "<img src='".$this->module->assetsUrl."/images/news/themes/".$i.".png' height=25  title='".News::get_THEMES_NAMES($i)."' class='img_illu_publication_theme' id='".$i."'> ";
											echo "</br><span>".News::get_THEMES_NAMES($i)."</span>";
											//echo "</br><input class='chk_box_about' type='checkbox' value='".$i."' id='chk_about_".$i."' name='chk_about' title='".News::get_THEMES_NAMES($i)."'/>";
											echo "</a>";
										}
									?>
								</div>												
							</div>	
							<!-- 	FILTRES THEMES -->
						</div>	
					</div>					
			
				</div>
			
			
				<!-- 	FIL D'ACTUALITÉS		 -->
				<div class="panel-body">
				<div class="panel-body">
					<a href='#' class='btn btn-default' style='float:right;'><i class="fa fa-camera"></i></a>
					<div class="timeline">
						<center><h3>Fil d'actualités</h3></center>
					</div>
							
					<div id="timeline" class="demo1">
						<div class="timeline" id="newsstream">
							<div class="spine"></div>
						</div>
					</div>
				</div>
			</div>
				<!-- 	FIL D'ACTUALITÉS		 -->
			
			</div>
		
	
			<!-- 	TAB USER		 -->
			<div class="tab-pane fade" id="myTab6_example2">
					<p>
						<div class="user-left">
							<div class="center">
								<h4>Peter Clark</h4>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="user-image">
										<div class="fileupload-new thumbnail"><img src="assets/images/avatar-1-xl.jpg" alt="">
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail"></div>
										<div class="user-image-buttons">
											<span class="btn btn-azure btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
												<input type="file">
											</span>
											<a href="#" class="btn fileupload-exists btn-red btn-sm" data-dismiss="fileupload">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
								</div>
								<hr>
								<div class="social-icons block">
									<ul>
										<li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
											<a href="http://www.twitter.com" target="_blank">
												Twitter
											</a>
										</li>
										<li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
											<a href="http://facebook.com" target="_blank">
												Facebook
											</a>
										</li>
										<li data-placement="top" data-original-title="Google" class="social-google tooltips">
											<a href="http://google.com" target="_blank">
												Google+
											</a>
										</li>
										<li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
											<a href="http://linkedin.com" target="_blank">
												LinkedIn
											</a>
										</li>
										<li data-placement="top" data-original-title="Github" class="social-github tooltips">
											<a href="#" target="_blank">
												Github
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</div>
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th colspan="3">Contact Information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>url</td>
										<td>
										<a href="#">
											www.example.com
										</a></td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>email:</td>
										<td>
										<a href="">
											peter@example.com
										</a></td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>phone:</td>
										<td>(641)-734-4763</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>skye</td>
										<td>
										<a href="">
											peterclark82
										</a></td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th colspan="3">General information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Position</td>
										<td>UI Designer</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Last Logged In</td>
										<td>56 min</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Position</td>
										<td>Senior Marketing Manager</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Supervisor</td>
										<td>
										<a href="#">
											Kenneth Ross
										</a></td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Status</td>
										<td><span class="label label-sm label-info">Administrator</span></td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th colspan="3">Additional information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Birth</td>
										<td>21 October 1982</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
									<tr>
										<td>Groups</td>
										<td>New company web site development, HR Management</td>
										<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
									</tr>
								</tbody>
							</table>
						</div>
										
					</p>
				</div>
		
		</div>
	</div>
</div>

<?php 
	 $where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 $user = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 $user = $user[Yii::app()->session["userId"]];
	 
	 $userCP = $user["cp"];
?>
<script type="text/javascript">
$(document).ready( function() 
{	
	//show / hide tooltip genre
	$(".itemBtnSelectGenreNewsStream").mouseover(function(){
		$("#tooltip_genre_block").css({"visibility":"visible"});});
	$(".itemBtnSelectGenreNewsStream").mouseout(function(){
		$("#tooltip_genre_block").css({"visibility":"hidden"});});
	//par default : hide tooltip genre
	$("#tooltip_genre_block").css({"visibility":"hidden"});
	showNewsStream();
});	
	//scope de départ
	var userCP = "<?php echo $userCP; ?>";
	var scope = [
		{	"scopeType" : "ville", 
			"at" : userCP, 
			"id" : userCP //devrait correspondre à l'id nominatim de la ville de l'utilisateur
		},
		{	"scopeType" : "departement", 
			"at" : userCP.substring(0, 2), 
			"id" : userCP.substring(0, 2) //devrait correspondre à l'id nominatim du departement de l'utilisateur
	}];
						
	//initialisation des valeurs par defaut
	initFormScope(scope);
	
	
	function showNewsStream(){
	
		
	
		var params = {};
		//params["latMinScope"] = bounds.getSouthWest().lat;
		
		
		ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id?>/news/GetNewsStream', params,
			function (data){ //alert(JSON.stringify(data));				
				$("#newsstream").html(data);
				
		});	
	}
	
	
	
</script>

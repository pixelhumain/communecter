
<?php include ("html_map.php")?> 

<script type="text/javascript" src="<?php echo $this->module->assetsUrl.'/js/sigCommunecter.js';?>" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready( function() 
{ 	
	//récupère les coordonnées de ma position
	//et lance la création de la carte
	testitpost("", '/ph/communecter/sig/GetMyPosition', null,
		function (data){ //alert(JSON.stringify(data));
			var myInfos;
			$.each(data, function() { 
				myInfos = this;
				myPosition = new Array( this.geo.latitude, this.geo.longitude );
			}); 
		initMap("ShowMyNetwork", myInfos, myPosition);	
	});		
});

	
	//transmet le chemin vers les asset au fichier sigCommunecterJs (sinon les icons n'apparaissent pas sur la carte)
	var assetPath = "<?php echo $this->module->assetsUrl;?>";
	
	//déclare les variables et fonction dans le scope global,
	//pour y accéder pendant les événements (moveend, click, etc)
	var map = "";
	var myPosition = "";
	var circlePosition = "";
	var listIdElementMap = new Array();
	var listDataElementMap = new Array();
	
</script>

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




<div class="col-md-12" style="padding:0px;">
	<div class="tabbable partition-dark">
												
		<ul id="myTab6" class="nav nav-tabs">
			<li class="active">
				<a href="#myTab6_example1" data-toggle="tab">
					<i class="fa fa-quote-left"></i> Fil d'actualités
				</a>
			</li>
			<li>
				<a href="#myTab6_example2" data-toggle="tab">
					<i class="fa fa-bars"></i></i> Annuaire
				</a>
			</li>
			<li>
				<a href="#myTab6_example3" data-toggle="tab" style="color:yellow">
					<i class="blue fa fa-user"></i> Peter Clark
				</a>
			</li>
			<li>
				<a href="#myTab6_example4" data-toggle="tab" style="color:#E66B6B">
					<i class="blue fa fa-university"></i> Mairie de St Joseph 
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="myTab6_example1" style="float:left;">
				
				<div class="panel panel-white">
					<div class="panel-body">	
					<h4 style="margin:0px;">
						<i class="fa fa-cog" style="margin-right:7px;"></i>Paramétrer le fil d'actualités						
					</h4>
					<button type="button" id="btn_import_data" class="btn btn-primary" style="float:right;">Importer les données</button></br></br>
					<div id="resImportData" style="float:right;"></div>
								
							<div class="col-sm-4" style="padding:0px; margin-top:8px;">
								<div class="panel-body">			
										<!-- 	FILTRES NATURES -->
										<div style="float:left;  max-width:230px;">
											<div class="lbl_filter_box" style="border-width:0px; margin-right:5px;">		
												<input type='checkbox' value='all_natures' name="chk_all_nature" class="chk_box_clavier" style="margin-top:5px; margin-right:5px; float:left; "/>
												<h5 class="panel-title" style="margin-top:4px; float:left;">Filtrer par nature : </h5></br>
											</div>
		
											<div class="news_filter_box" style="border-width:0px; padding:0px; width:210px; margin-right:15px;">
											<?php
												$natures = array( 	array("free_msg", 			"white"), 
																	array("idea", 				"yellow"), 
																	array("help", 				"red"), 
																	array("rumor", 				"orange"), 
																	array("true_information", 	"green") ,
																	array("question", 			"purple"), 
																	
																	);
																	
												foreach($natures as $nature)
												{ 
													echo "<div style='float:left; margin:0px; border-radius:30px; padding:2px; background-color:rgba(255, 255, 255, 0.5);'>";
														echo "<img src='".$this->module->assetsUrl."/images/news/natures/".$nature[0].".png' height=30 class='img_illu_publication_nature' style='padding:4px;' id='".$nature[0]."'>";
													echo "</div>";
														
													echo "<div class='header_post ".$nature[1]."' style='margin-right:10px; min-height:30px; border-radius:5px; margin-left:5px;  margin-top:3px; margin-bottom:3px; max-width:72%; min-width:72%; '>";
														echo "<input type='checkbox' value='".$nature[0]."' name='chk_nature' style='margin-top:8px; margin-left:5px;'/> <span class='text-bold' style='margin-top:8px;'>".News::get_NATURES_NAMES($nature[0])."</span>";
													echo "</div>";
													
												}
											?>
											</div>
										</div>
										<!-- 	FILTRES NATURES -->	
								</div>
							</div>
							<div class="col-sm-7" style="margin-top:18px;">
								<div class="panel-body">
									
									<h5 class="panel-title" style="margin-bottom:6px;">Synchroniser avec : </h5>
									<div class="lbl_filter_box"  style="float:left;">
										<input type='checkbox' value='' class="chk_box_clavier" name='chk_nature' style=''/> la carte
									</div>
									<div class="lbl_filter_box"  style="float:left; margin-left:10px;">
										<input type='checkbox' value='' class="chk_box_clavier" name='chk_nature' style=''/> mon code postal<!--  (recevoir les messages envoyés PAR les membres présents sur la carte POUR mon code postal(ou le code postal de mon choix) ) -->
									</div>
									<div class="lbl_filter_box"  style="float:left; margin-left:10px;">
										<input type='checkbox' value='' class="chk_box_clavier" name='chk_nature' style=''/> mon département<!--  (recevoir les messages envoyés PAR les membres présents sur la carte POUR mon département(ou le département de mon choix) )-->
									</div>
									
								
					
										<!-- 	FILTRES THEMES -->	
										<div style="float:left; max-width:570px;">
											<div class="lbl_filter_box" style="border-width:0px; margin-top:10px; margin-right:5px;">		
												<input type='checkbox' value='all_natures' name="chk_all_nature" class="chk_box_clavier" style="margin-top:5px; margin-right:5px; float:left; "/>
												<h5 class="panel-title" style="margin-top:4px; float:left;">Filtrer par thème(s) : </h5></br>
											</div>
		
	
											<div class="news_filter_box" style="max-width:570px;">
											<?php
												for($i=1;$i<21;$i++)
												{
													echo "<div style='float:left; margin-right:10px; margin-left:10px;'><center>";
													echo "<img src='".$this->module->assetsUrl."/images/news/themes/".$i.".png' height=30  title='".News::get_THEMES_NAMES($i)."' class='img_illu_publication_theme' id='".$i."'></br>";
													echo "<input type='checkbox' value='".$i."' name='chk_theme' title='".News::get_THEMES_NAMES($i)."'/>";
													echo "</center></div>";
												}
											?>
											</div>
										</div>	
										<!-- 	FILTRES THEMES -->
								</div>	
							</div>
					
					</div> <!-- panel panel-blue -->
				</div>
				
				
							<div class="panel-body">
						
									<div class="panel-body">
										
										
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
					
				</div>
			
			<div class="tab-pane fade" id="myTab6_example2">
				
		<!-- start: DYNAMIC TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des éléments visibles sur la carte</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<div id="sample_2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-md-6"><div class="dataTables_length" id="sample_2_length"><label>Show <div id="s2id_autogen1" class="select2-container m-wrap small"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span id="select2-chosen-2" class="select2-chosen">10</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen2" class="select2-offscreen"></label><input id="s2id_autogen2" aria-labelledby="select2-chosen-2" class="select2-focusser select2-offscreen" aria-haspopup="true" role="button" type="text"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen2_search" class="select2-offscreen"></label>       <input placeholder="" id="s2id_autogen2_search" aria-owns="select2-results-2" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" type="text">   </div>   <ul id="select2-results-2" class="select2-results" role="listbox">   </ul></div></div><select title="" tabindex="-1" class="m-wrap small select2-offscreen" aria-controls="sample_2" size="1" name="sample_2_length"><option value="5">5</option><option selected="selected" value="10">10</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select> Rows</label></div></div><div class="col-md-6"><div id="sample_2_filter" class="dataTables_filter"><label><input placeholder="Search" class="form-control input-sm" aria-controls="sample_2" type="text"></label></div></div></div><table aria-describedby="sample_2_info" class="table table-striped table-hover dataTable" id="sample_2">
						<thead>
							<tr role="row"><th aria-label="Name: activate to sort column ascending" style="width: 389px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" role="columnheader" class="sorting">Name</th><th aria-label="Type: activate to sort column descending" aria-sort="ascending" style="width: 348px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" role="columnheader" class="sorting_asc">Type</th><th aria-label="Edit: activate to sort column ascending" style="width: 212px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" role="columnheader" class="sorting">Edit</th><th aria-label="Delete: activate to sort column ascending" style="width: 284px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" role="columnheader" class="sorting">Delete</th></tr>
						</thead>
						
					<tbody aria-relevant="all" aria-live="polite" role="alert"><tr class="odd">
								<td class=" "><a href="/ph/communecter/organization/view/id/53c5568ac0461f4a04982a4a">Asso1</a></td>
								<td class="  sorting_1">association</td>
								<td class=" "><a href="#" class="edit-row">Edit</a></td>
								<td class=" "><a href="#" class="delete-row">Delete</a></td>
							</tr><tr class="even">
								<td class=" "><a href="/ph/communecter/organization/view/id/53d51264c0461f443ff6c649">Assonymous</a></td>
								<td class="  sorting_1">association</td>
								<td class=" "><a href="#" class="edit-row">Edit</a></td>
								<td class=" "><a href="#" class="delete-row">Delete</a></td>
							</tr></tbody></table><div class="row"><div class="col-md-6"><div id="sample_2_info" class="dataTables_info">Showing 1 to 2 of 2 entries</div></div><div class="col-md-6"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pagination-blue"><li class="prev disabled"><a href="#"><i class="fa fa-chevron-left"></i> </a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#"> <i class="fa fa-chevron-right"></i></a></li></ul></div></div></div></div>
				</div>
			</div>
		</div>
	
			</div>
			<div class="tab-pane fade" id="myTab6_example3">
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
			<div class="tab-pane fade" id="myTab6_example4">
				<p>
					 Mairie de St Joseph
				</p>
				
			</div>
		</div>
	</div>
	
			
</div>


<script type="text/javascript">
	
	//importer les données News
	$('#btn_import_data').click(function(event) {
		testitpost("", '/ph/communecter/sig/ImportData', null,
			function (data){ //alert(JSON.stringify(data));				
				$("#resImportData").html(data);
		});	
	});
	
	function setPosListElementMap(){
		var width = $("#right_tool_map").css("width");
		width = width.substring(0, width.length-2);
		var widthMap = $("#mapCanvas").css("width");
		widthMap = widthMap.substring(0, widthMap.length-2);
		$("#right_tool_map").css({"left" : widthMap - width - 10});
	}
		
	$( window ).resize(function() {
		setPosListElementMap();
	});
	
	setPosListElementMap();
</script>

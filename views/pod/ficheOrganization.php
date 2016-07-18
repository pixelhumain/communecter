
<div class="panel panel-white" id="panelFicheOrga">
	<div class="panel-body border-light">
		<div class="row">
			<div class="colFiche col-sm-8 col-xs-8">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => (string)$context["_id"],
																			  "type" => Organization::COLLECTION,
																			  "contentId" =>Document::IMG_BANNIERE,
																			  "show" => "true" ,
																			  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $context["_id"]))); ?>
			</div>
			<div class="colFiche col-sm-4 col-xs-4">
				<div class="row">
					<div class="colFiche col-sm-12 col-xs-12">
							<span><?php echo (isset( $context["address"]["streetAddress"])) ? $context["address"]["streetAddress"] : null; ?></span>
							<br>
							<span><?php echo (isset( $context["address"]["postalCode"])) ? $context["address"]["postalCode"] : null; ?>  <?php echo (isset( $context["address"]["addressLocality"])) ? $context["address"]["addressLocality"] : null; ?> <?php echo (isset( $context["address"]["addressCountry"])) ? $context["address"]["addressCountry"] : null; ?></span>
							<br>
							
							<span>Tél : <?php echo (isset($context["tel"])) ? $context["tel"] : null; ?> </span>
							<br>
							<span><?php echo (isset($context["email"])) ? $context["email"] : null; ?></span>
							<br>
							<span> <?php echo (isset($context["url"])) ? $context["url"] : null; ?></span>
					</div>
					<div class="colFiche col-sm-12 col-xs-12 pull-bottom">
						<div>
							<h1><i class="fa fa-envelope"></i> CONTACTEZ-NOUS </h1>
						</div>
					</div>
					<div class="colFiche col-sm-12 col-xs-12 pull-bottom">
						<strong><?php echo (isset($context["description"])) ? $context["description"] : null; ?></strong>
					</div>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="colFiche col-sm-8 col-xs-8">
				<div class="row">
					<div class="colFiche col-sm-12 col-xs-12" style="background-color:#E6E6E6">
						<h1>TITRE</h1>
					</div>
					<div class="colFiche col-sm-12 col-xs-12">
						<div class="center">
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </span>
						</div>
					</div>
					<div class="colFiche col-sm-12 col-xs-12" style="background-color:#E6E6E6">
						<h1>TITRE</h1>
					</div>
					<div class="colFiche col-sm-12 col-xs-12">
						<div class="center">
							<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </span>
						</div>
					</div>
				</div>
			</div>
			<div class="colFiche col-sm-4 col-xs-4">
				<div class="row">
					<div class="colFiche col-sm-12 col-xs-12">
						<div id="accordion" class="panel-group accordion">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">
									<a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
										<i class="icon-arrow"></i> EQUIPE
									</a></h5>
								</div>
								<div class="panel-collapse collapse in" id="collapseOne" style="">
									<div class="panel-scroll height-230 ps-container">
										<table class="table table-striped table-hover" id="organizations">
											<tbody>
												<?php 
												if(isset($context["links"]["members"])){ 
													foreach ($context["links"]["members"] as $key => $value) {
														if($value["type"]==PHType::TYPE_CITOYEN && isset($value["position"]) && $value["position"] =="member"){
															$person = Person::getById($key);
															if(!empty($person)){				
												?>
												<tr >
													<td class="center">
														<span>Nom : <?php echo $person["name"] ?><br>
														Position : <?php if(isset($person["position"])) echo $person["position"] ?>
														</span>
													
													</td>
												</tr>
												<?php
																}
															}
														}
													 }
												 ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">
									<a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
										<i class="icon-arrow"></i> CONSEIL D'ADMINISTRATION
									</a></h5>
								</div>
								<div class="panel-collapse collapse" id="collapseTwo" style="height: 0px;">
									<div class="panel-scroll height-230 ps-container">
										<table class="table table-striped table-hover" id="organizations">
											<tbody>
											<?php 
											if(isset($context["links"]["members"])){ 
												foreach ($context["links"]["members"] as $key => $value) {
													if($value["type"]==PHType::TYPE_CITOYEN && isset($value["position"]) && $value["position"] =="admin"){
														$person = Person::getById($key);
														if(!empty($person)){				
											?>
												<tr >
													<td class="center">
														<span>Nom : <?php echo $person["name"] ?><br>
														Position : <?php if(isset($person["position"])) echo $person["position"] ?>
														</span>
													
													</td>
												</tr>
											<?php
															}
														}
													}
												 }
											 ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">
									<a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
										<i class="icon-arrow"></i> BUREAU
									</a></h5>
								</div>
								<div class="panel-collapse collapse" id="collapseThree">
									<div class="panel-scroll height-230 ps-container">
										<table class="table table-striped table-hover" id="organizations">
											<tbody>
												<tr >
													<td class="center">
														<span>Nom :<br> 
															Prenom :<br>
															Structure
														</span>
													
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="colFiche col-sm-12 col-xs-12">
						<h1><i class="fa fa-check"></i> ADHERER</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
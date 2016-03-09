<?php 
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	'/assets/plugins/select2/select2.css',
	'/assets/plugins/select2/select2.min.js',
	//autosize
	'/assets/plugins/autosize/jquery.autosize.min.js',

	'/assets/plugins/jQuery-Knob/js/jquery.knob.js',
	//'/assets/js/ui-sliders.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>
<style>
.borderHover{
	background-color: rgba(0,  0,  0, 0.04);
	border-radius:5px;
}
.removeProperty{
	border: 3px solid white;
  box-shadow: 0px 0px 0px 1px black;
  width: 25px;
  text-align: -webkit-center;
  height: 25px;
  background-color: black;
  line-height: 22px;
  color: white;
  position: absolute;
  right: -5px;
  top: -5px;
  border-radius: 25px;
}
</style>
<?php
	
	if(@$project)
		Menu::project($project);
	$this->renderPartial('../default/panels/toolbar'); 

?>
<div id="editProjectChart">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3><?php echo Yii::t("project","Add values of your project",null,Yii::app()->controller->module->id) ?></h3>
		<form class="form-chart">
			<input type="hidden" value="<?php echo $itemId; ?>" class="projectId"/>
			<div class="row">
				<div class="col-md-12">
					<!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<input type="checkbox" name="partage" value="" data-toggle="collapse" data-target="#partage" aria-expanded="false" aria-controls="collapseExample"></input> 
							   Partage
							   </h4>
						    </div>
							<div id="partage" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<h4>
								       Quels sont les "communs" proches ou similaires ? Ont il été contactés pour essayer de mutualiser avec eux ? Comment le "commun" est travaillé pour favoriser sa réplication, sa diffusion ?
									</h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<input type="checkbox" name="gouvernance" value="" data-toggle="collapse" data-target="#gouvernance" aria-expanded="false" aria-controls="collapseExample"></input> 
							   Gouvernance
							   </h4>
						    </div>
							<div id="gouvernance" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<h4>
										Comment est pensée la gouvernance pour permettre à tous de s'approprier le commun sans pour autant réduire l'initiative individuelle ?
									</h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<input type="checkbox" name="partenaire" value="" data-toggle="collapse" data-target="#partenaire" aria-expanded="false" aria-controls="collapseExample"></input> 
							   Partenaires
							   </h4>
						    </div>
							<div id="partenaire" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<h4>
								        Quelle manière le commun a t'il de nouer des partenariats avec des acteurs privés et publics ? Quelles approches utilisées ?
								    </h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<input type="checkbox" name="juridique" value="" data-toggle="collapse" data-target="#juridique" aria-expanded="false" aria-controls="collapseExample"></input> 
						   Juridique
						   </h4>
					    </div>
						<div id="juridique" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<h4>
							       Quels choix juridique pour protéger le caractère "commun" du projet ?												</h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<input type="checkbox" name="financement" value="" data-toggle="collapse" data-target="#financement" aria-expanded="false" aria-controls="collapseExample"></input> 
						   Financement
						   </h4>
					    </div>
						<div id="financement" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<h4>
Quelle logique de financement par les usagers et partenaires ainsi que de redistribution financière dans le commun ?
								</h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<input type="checkbox" name="contribution" value="" data-toggle="collapse" data-target="#contribution" aria-expanded="false" aria-controls="collapseExample"></input> 
						   Contribution
						   </h4>
					    </div>
						<div id="contribution" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<h4>
							       Comment le projet permet il la contribution à tous et sur le long terme ? Quels moyens pour rendre visibles les actions ?
							    </h4>
								<div class="radio">
									<label><input type="radio" name="optradio">Ne souhaite pas</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Pas applicable</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Souhait mais pas démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">Démarré</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio">En progression</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="optradio" disabled>Réalisé</label>
								</div>
								<textarea class="partage-description form-control" name="description" id="description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>					
						    </div>
					    </div>
					</div>
				</div>-->
					<label for="properties">
						<?php echo Yii::t("project","Degree of project's openness (0% = very closed, 100% = very opened)",null,Yii::app()->controller->module->id) ?>			
					</label>

					<input class="" type="checkbox" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
						Solidaire
					</button>
					<div class="collapse" id="collapseExample">
						<div class="well">
							
						</div>
					</div>
					<div class="col-md-12">
					<?php if (isset($properties) && !empty($properties)){
						foreach ($properties as $key => $val){ 
						if($key!="avancement" && $key!="partenaire"){
					?>
						<div class="col-md-4 form-property">
							<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
							<h4 style="text-align:center;width:200px;"><?php echo $key; ?></h4>
							<input class="knob project-property" name="<?php echo $key; ?>" value="<?php if (!empty($val)) echo $val; else echo 0;?>" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">		
					<?php if ($key=="gouvernance"){ ?>
						<label for="properties">
							Ouverture en terme de décisions, de partenaires, de parties prenantes
						</label>
					<?php } else if ($key=="partage"){ ?>
						<label for="properties">
							À combien le projet sert le bien communs?
						</label>
					<?php }else if ($key=="solidaire"){ ?>
						<label for="properties">
							À quel point le projet sert-il l'utilité sociale, le développement durable
						</label>
					<?php }else if ($key=="local"){ ?>
						<label for="properties">
							Quel est l'impact géographique du projet?
						</label>
					<?php } ?>
					</div>
				<?php 		} 
						} 
					} else { ?>
						<div class="col-md-4 form-property">
							<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
							<h4 style="text-align:center;width:200px;">Gouvernance</h4>
							<input class="knob project-property" name="gouvernance" value="0" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
							<label for="properties">
								Ouverture en terme de décisions, de partenaires, de parties prenantes
							</label>
						</div>
						<div class="col-md-4 form-property">
							<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
							<h4 style="text-align:center;width:200px;">Partage</h4>
							<input class="knob project-property" value="0" name="partage" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
							<label for="properties">
								À combien le projet sert le bien communs?			
							</label>	
						</div>
						<div class="col-md-4 form-property">
							<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
							<h4 style="text-align:center;width:200px;">Solidaire</h4>
							<input class="knob project-property" value="0" name="solidaire" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
							<label for="properties">
								À quel point le projet est-il d'utilité sociale, du développement durable, etc.?
							</label>
						</div>
						<div class="col-md-4 form-property">
							<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
							<h4 style="text-align:center;width:200px;">Local</h4>
							<input class="knob project-property" value="0" name="local" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
							<label for="properties">
								Quel est l'impact géographique du projet?
							</label>
						</div>
						<?php } ?>
						<div class="col-md-4">
							<h4 style="text-align:center;width:200px;"></h4>
								<div class="flexslider" style="margin-top:35px;">
							<div id="infoPodOrga" class="padding-10">
								<blockquote> 
									<i class="fa fa-puzzle-piece fa-2x text-blue"></i>	<?php echo Yii::t("project","Add<br/>A new<br/>Property",null,Yii::app()->controller->module->id) ?>
									<br/>
									<a href="#" class="addProperties" style="display: inline; opacity: 1; left: 0px;">
										<i class="fa fa-plus"></i> <?php echo Yii::t("common","ADD"); ?>
									</a>
								</blockquote>
								
							</div>
							
						</div>
						</div>
					</div>
				</div>
				<div class="">
					<div class="row center">
		    	        <button class="btn btn-primary" >Enregistrer</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
var countProperties=<?php echo json_encode(count($properties)); ?>;
var projectId = $(".form-chart .projectId").val();
jQuery(document).ready(function() {
	knobInit();
    $(".addProperties").click(function(){
	   newProperty=addNewProperties();
	   $(this).parents().eq(3).before(newProperty);
	   knobInit(); 
	   removeChartProperty();
    });
	bindprojectSubViewchart();
	runChartFormValidation();
	removeChartProperty();
});
function runChartFormValidation() {
	var formChart = $('.form-chart');
	var errorHandler2 = $('.errorHandler', formChart);
	var successHandler2 = $('.successHandler', formChart);
	formChart.validate({
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertAfter($(element).closest('.form-group').children('div').children().last());
			} else if (element.parent().hasClass("input-icon")) {
	
				error.insertAfter($(element).parent());
			} else {
				error.insertAfter(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		invalidHandler : function(project, validator) {//display error alert on form submit
			successHandler2.hide();
			errorHandler2.show();
		},
		highlight : function(element) {
			$(element).closest('.help-block').removeClass('valid');
			// display OK icon
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
			// add the Bootstrap error class to the control group
		},
		unhighlight : function(element) {// revert the change done by hightlight
			$(element).closest('.form-group').removeClass('has-error');
			// set error class to the control group
		},
		success : function(label, element) {
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			successHandler2.show();
			errorHandler2.hide();
			newChart = [];
			nbProperties=0;
			$('.project-property').each(function(){
				valueProperties = $(this).val();
				if($(this).attr("name") == "newProjectProperty"){
					nameProperties=$(this).parents().eq(1).find(".newLabelProperty").val();
					//alert(nameProperties);
					if(nameProperties.length){
						newProperties={"label" : nameProperties , "value" : valueProperties};
						newChart.push(newProperties);
						nbProperties++;
					}
				}
				else{
					nameProperties = $(this).attr("name");
					newProperties={"label": nameProperties, "value": valueProperties};
					newChart.push(newProperties);
					nbProperties++;
				}
			});
			console.log(newChart);
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});
			//mockjax simulates an ajax call
			$.mockjax({
				url : '/project/edit/webservice',
				dataType : 'json',
				responseTime : 1000,
				responseText : {
					say : 'ok'
				}
			});
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/editchart',
		        dataType : "json",
		        data:{chart : newChart, id : projectId},
				type:"POST",
		    })
		    .done(function (data,myNewChart) 
		    {
			   if (data.result==true) {   
		        	toastr.success('Project properties succesfully update');
		        	$.unblockUI();
					openMainPanelFromPanel( '/project/detail/id/'+projectId, 'Project : <?php if(@$projectName) echo addslashes($projectName) ?>',"fa-lightbulb-o", projectId );
		        } else {
		           toastr.error('Something Went Wrong');
		        }
		   	});	
		}
	});
};

function bindprojectSubViewchart() {	
	$(".edit-chart").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editChart();
			},
			onHide : function() {
				hideEditChart();
			},
			onSave: function() {
				$(".form-chart").submit();
			}
		});
	});
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prinviteDefault();
	});
};

var subViewElement, subViewContent, subViewIndex;
function hideEditChart() {
	openMainPanelFromPanel( '/project/detail/id/'+projectId, 'Project : <?php if(@$projectName) echo addslashes($projectName) ?>',"fa-lightbulb-o", projectId );
};
// enables the edit form 
function editChart() {
	$(".close-chart-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
};
function addNewProperties(){
	$newProperty='<div class="col-md-4 form-property">'+
				'<h4 style="text-align:center;width:200px;">Nouvelle propriété</h4>'+
				'<input class="knob project-property" value="0" name="newProjectProperty" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">'+		
				'<label for="properties">'+
					'Nom de la propriétés:'+
				'</label>'+
				'<input type="text" placeholder="Entrer l\'intitulé de la propriété" class="newLabelProperty form-control"/>'+
			'</div>';
	return $newProperty;
}
function updateNewKnob(){
	$(".newLabelProperty").each(function(){
		nameProperty=$(this).val();
		valueProperty=$(this).parent().find(".project-property").val();
		replaceNewProperty='<div class="col-md-4 form-property">'+
								'<div class="removeProperty hide">'+
									'<span class="glyphicon glyphicon-remove"></span>'+
								'</div>'+
								'<h4 style="text-align:center;width:200px;">'+nameProperty+'</h4>'+
								'<input class="knob project-property" name="'+nameProperty+'" value="'+valueProperty+'" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">'+
							'</div>';
		$(this).parent().replaceWith(replaceNewProperty);
	});
}
function removeChartProperty(){
	$(".form-property").mouseenter(function(){
		$(this).addClass("borderHover").find(".removeProperty").removeClass("hide");
	}).mouseleave(function(){
		$(this).removeClass("borderHover").find(".removeProperty").addClass("hide");
	});
	$(".removeProperty").click(function(){
		$(this).parent().remove();
	});
}

function knobInit(){
	$(".knob").knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {
                var a = this.angle(this.cv) // Angle
                    ,
                    sa = this.startAngle // Previous start angle
                    ,
                    sat = this.startAngle // Start angle
                    ,
                    ea // Previous end angle
                    , eat = sat + a // End angle
                    ,
                    r = true;
                this.g.lineWidth = this.lineWidth;
                this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor && (sa = ea - 0.3) && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }
                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();
                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();
                return false;
            }
        }
    });
}
</script>
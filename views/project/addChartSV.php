<?php 
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	'/plugins/select2/select2.css',
	'/plugins/select2/select2.min.js',
	//autosize
	//'/plugins/autosize/jquery.autosize.min.js',
	'/plugins/jQuery-Knob/js/jquery.knob.js',
	'/plugins/jquery.dynSurvey/jquery.dynForm.js',
	'/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js',
	'/plugins/jquery-validation/dist/jquery.validate.min.js',
	'/js/jsonHelper.js',
	'/plugins/jquery.dynSurvey/jquery.dynSurvey.js',
	//'/assets/js/ui-sliders.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
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
if(!@$_GET["renderPartial"])
	$this->renderPartial('../pod/headerEntity', array("entity"=>$project, "type" => Project::COLLECTION, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "addchart"));  
?>
<div id="editProjectChart">
	<div class="noteWrap col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
		<h3><?php echo Yii::t("project","Evaluate your projet as commons") ?></h3>
		<form id="opendata"></form>
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
var countProperties=<?php echo json_encode(count($properties)); ?>;
var parentId = "<?php echo (string)$project["_id"]; ?>";
var properties = <?php echo json_encode($properties); ?>;
console.log(properties);
var form1 = {
        "jsonSchema" : {
            "title" : "Partage",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":" Quels sont les communs proches ou similaires ? Ont il été contactés pour essayer de mutualiser avec eux ? Comment le commun est travaillé pour favoriser sa réplication, sa diffusion ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description",
                    "value":""
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
                }
            },
        },
        "collection":"partage"
    };

var form2 = {
         "jsonSchema" : {
            "title" : "Gouvernance",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":"Comment est pensée la gouvernance pour permettre à tous de s'approprier le commun sans pour autant réduire l'initiative individuelle ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description",
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
                }
            }
        }
    };

var form3 = {
         "jsonSchema" : {
            "title" : "Partenaires",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":"Quelle manière le commun a t'il de nouer des partenariats avec des acteurs privés et publics ? Quelles approches utilisées ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
				}
            }
        }
};
var form4 = {
         "jsonSchema" : {
            "title" : "Juridique",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":"Quels choix juridique pour protéger le caractère commun du projet ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
                }
            }
        }
};
var form5 = {
         "jsonSchema" : {
            "title" : "Financement",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":"Quelle logique de financement par les usagers et partenaires ainsi que de redistribution financière dans le commun ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
                }
            }
        }
};
var form6 = {
         "jsonSchema" : {
            "title" : "Contribution",
            "type" : "object",
            "properties" : {
                "separator1":{
                    "title":"Comment le projet permet il la contribution à tous et sur le long terme ? Quels moyens pour rendre visibles les actions ?"
                },
                "description" : {
                    "inputType" : "textarea",
                    "placeholder" : "Description"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "------- Veuillez saisir une valeur ----------",
                    "options":{
	                    "0":"Ne souhaite pas",
	                    "20":"Pas applicable",
	                    "40":"Souhait mais pas démarré",
						"60":"Démarré",
						"80":"En progression",
						"100":"Réalisé",
                    }
                }
            }
        }
};

jQuery(document).ready(function() {
    /* **************************************
    *   Using the dynForm
    - declare a destination point
    - a formDefinition
    - the onLoad method
    - the onSave method
    ***************************************** */
    
    var form = $.dynSurvey({
        surveyId : "#opendata",
        surveyObj : { 
            "section1":{dynForm : form1, key : "partage" },
            "section2":{dynForm : form2, key : "gouvernance" },
            "section3":{dynForm : form3, key : "partenaires" },
            "section4":{dynForm : form4, key : "finance" },
            "section5":{dynForm : form5, key : "juridique" },
			"section6":{dynForm : form6, key : "contribution" }
        },
                surveyValues : properties,
        onSave : function(params) {
			//console.dir( $(params.surveyId).serializeFormJSON() );
			var result = {};
			console.log(params.surveyObj);
			$.each( params.surveyObj,function(section,sectionObj) { 
				result[sectionObj.key] = {};
				console.log(sectionObj.dynForm.jsonSchema.properties);
				$.each( sectionObj.dynForm.jsonSchema.properties,function(field,fieldObj) { 
					console.log(sectionObj.key+"."+field, $("#"+section+" #"+field).val() );
					if( fieldObj.inputType ){
						result[sectionObj.key][field] = $("#"+section+" #"+field).val();
					}
				});
			});
			console.dir( result );
			$.ajax({
        	  type: "POST",
        	  url: params.savePath,
        	  data: {properties:result, parentId: parentId},
              dataType: "json"
        	}).done( function(data){
                toastr.success("Project chart well updated");
                loadByHash("#project.detail.id."+parentId);
               // if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
                 //   afterDynBuildSave(data.map,data.id);
                console.info('saved successfully !');

        	});
		},
        collection : "commonsChart",
	    key : "SCSurvey",
		savePath : baseUrl+"/"+moduleId+"/project/editchart"
		

    });
	$(".moduleLabel").html("<span style='font-size:20px;'>Charte, valeurs, code social</span>");
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
			mylog.log(newChart);
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
	//////// LAST FROM DEVELOPMENT ////////////////
		        	/*var chartToLoad=true;
		        	showElementPad("detail");
		        	if(typeof updateChart != "undefined" && typeof updateChart == "function"){
			        	updateChart(data.properties, data.properties.length);
			        }*/
	//////// ENND LAST FROM DEVELOPMENT /////////////
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
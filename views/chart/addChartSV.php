<?php 
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	//'/plugins/select2/select2.css',
	//'/plugins/select2/select2.min.js',
	//autosize
	//'/plugins/autosize/jquery.autosize.min.js',
	'/plugins/jQuery-Knob/js/jquery.knob.js',
//	'/plugins/jquery.dynForm.js',
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
.property-description{
	width: 100%;
	height:200px;
}
.stepFormChart{
	background-color: #8b91a0;
    /*border: 5px solid #CED1D6;*/
    border-radius: 100% 100% 100% 100%;
    color: white;
    display: inline-block;
    font-size: 20px;
    height: 40px;
    line-height: 40px;
    position: relative;
    text-align: center;
    width: 40px;
    z-index: 2;
    margin-right: 5px;
}
</style>
<?php
if(!@$_GET["renderPartial"])
	$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $parentType, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "addchart"));  
?>
<div id="editProjectChart">
	<div class="noteWrap col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
		<h3 style="font-variant:small-caps;"><span class="stepFormChart">1</span><?php echo Yii::t("chart","Choose which kind of form to complete") ?></h3>
		<div class="btn-group ">
			<a id="btncommons" href="javascript:;" onclick="switchTypeChart('commons')" class="btn">
				<i class="fa fa-check-circle-o"></i> <?php echo Yii::t("chart","Commons") ?>
			</a>
			<a id="btnopen" href="javascript:;" onclick="switchTypeChart('open')" class="btn btn-optgroup">
				<i class="fa fa-circle-thin"></i> <?php echo Yii::t("chart","Open") ?>
			</a>
		</div>
		<div id="commonsChart" class="formChart">
			<h3 style="font-variant:small-caps;"><span class="stepFormChart">2</span><?php echo Yii::t("chart","Evaluate your ".substr($parentType,0,-1)." as commons") ?></h3>
			<form id="opendata"></form>
		</div>
		<div id="openChart" class="formChart" style="display:none;">
			<h3 style="font-variant:small-caps;"><span class="stepFormChart">2</span><?php echo Yii::t("chart","Add properties which defined your ".substr($parentType,0,-1)) ?></h3>
			<form class="form-chart">
				<div>
						<label for="properties" style="font-style: italic">
							<?php echo Yii::t("project","Degree of project's openness (0% = very closed, 100% = very opened)",null,Yii::app()->controller->module->id) ?>			
						</label>
						<div class="col-md-12 no-padding">
						<?php if (isset($properties["free"]) && !empty($properties["free"])){
							foreach ($properties["free"] as $key => $val){ 
						?>
							<div class="col-md-12 form-property">
								<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
								<h4 style="text-align:center;width:200px;"><?php echo $key; ?></h4>
								<?php if ($key=="gouvernance"){ ?>
									<label for="properties" class="col-md-12 no-padding">
										Ouverture en terme de décisions, de partenaires, de parties prenantes
									</label>
								<?php } else if ($key=="partage"){ ?>
									<label for="properties" class="col-md-12 no-padding">
										À combien le projet sert le bien communs?
									</label>
								<?php }else if ($key=="solidaire"){ ?>
									<label for="properties" class="col-md-12 no-padding">
										À quel point le projet sert-il l'utilité sociale, le développement durable
									</label>
								<?php }else if ($key=="local"){ ?>
									<label for="properties" class="col-md-12 no-padding">
										Quel est l'impact géographique du projet?
									</label>
								<?php } ?>
								<div class="col-md-6">
									<input class="knob property-value" name="<?php echo $key; ?>" value="<?php if (!empty($val["value"])) echo $val["value"]; else echo 0;?>" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">
								</div>
								<div class="col-md-6">
									<textarea class="property-description"	name="<?php echo $key; ?>" placeholder="<?php echo Yii::t("chart","Describe this property") ?>"><?php if (!empty($val["description"])) echo $val["description"]; ?></textarea>
								</div>
							</div>
					<?php 		
							} 
						} else { ?>
							<div class="col-md-12 form-property">
								<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
								<h4>Gouvernance</h4>
								<label for="properties" class="col-md-12 no-padding">
									Ouverture en terme de décisions, de partenaires, de parties prenantes
								</label>
								<div class="col-md-6">
									<input class="knob property-value" name="gouvernance" value="0" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">	
								</div>
								<div class="col-md-6">
									<textarea class="property-description"	name="gouvernance" placeholder="Describe this property"></textarea>
								</div>
							</div>
							<div class="col-md-12 form-property">
								<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
								<h4>Partage</h4>
								<label for="properties" class="col-md-12">
									À combien le projet sert le bien communs?			
								</label>
								<div class="col-md-6">
									<input class="knob property-value" value="0" name="partage" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">	
								</div>
								<div class="col-md-6">
									<textarea class="property-description"	name="partage" placeholder="Describe this property"></textarea>
								</div>
							</div>
							<div class="col-md-12 form-property">
								<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
								<h4>Solidaire</h4>
								<label for="properties" class="col-md-12 no-padding">
									À quel point le projet est-il d'utilité sociale, du développement durable, etc.?
								</label>
								<div class="col-md-6">
									<input class="knob property-value" value="0" name="solidaire" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">	
								</div>
								<div class="col-md-6">
									<textarea class="property-description"	name="solidaire" placeholder="Describe this property"></textarea>
								</div>
							</div>
							<div class="col-md-12 form-property">
								<div class="removeProperty hide"><span class="glyphicon glyphicon-remove"></span></div>
								<h4 style="text-align:center;width:200px;">Local</h4>
								<label for="properties" class="col-md-12 no-padding">
									Quel est l'impact géographique du projet?
								</label>
								<div class="col-md-6">
									<input class="knob property-value" value="0" name="local" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-6">
									<textarea class="property-description"	name="local" placeholder="Describe this property"></textarea>
								</div>
							</div>
							<?php } ?>
							<div class="col-md-12">
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
					
					<div class="">
						<div class="row center">
			    	        <button class="btn btn-primary" >Enregistrer</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
var countProperties=<?php echo json_encode(count($properties)); ?>;
var parentId = "<?php echo $parentId; ?>";
var parentType = "<?php echo $parentType; ?>";
var properties = <?php echo json_encode($properties); ?>;
propertiesCommons={};
if(typeof(properties.commons) != "undefined")
	propertiesCommons=properties.commons;
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
                    "class" : "description1"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
                    "class" : "description2"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
                    "placeholder" : "Description",
                    "class" : "description3"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
                    "placeholder" : "Description",
                    "class" : "description4"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
                    "placeholder" : "Description",
                    "class" : "description5"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
                    "placeholder" : "Description",
                    "class" : "description6"
                },
                "value" : {
                    "inputType" : "select",
                    "placeholder" : "evaluate",
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
	(function(){var e;!function(t,l){return t.fn.autogrow=function(i){return null==i&&(i={}),null==i.horizontal&&(i.horizontal=!0),null==i.vertical&&(i.vertical=!0),null==i.debugx&&(i.debugx=-1e4),null==i.debugy&&(i.debugy=-1e4),null==i.debugcolor&&(i.debugcolor="yellow"),null==i.flickering&&(i.flickering=!0),null==i.postGrowCallback&&(i.postGrowCallback=function(){}),null==i.verticalScrollbarWidth&&(i.verticalScrollbarWidth=e()),i.horizontal!==!1||i.vertical!==!1?this.filter("textarea").each(function(){var e,n,r,o,a,c,d;return e=t(this),e.data("autogrow-enabled")?void 0:(e.data("autogrow-enabled"),a=e.height(),c=e.width(),o=1*e.css("lineHeight")||0,e.hasVerticalScrollBar=function(){return e[0].clientHeight<e[0].scrollHeight},n=t('<div class="autogrow-shadow"></div>').css({position:"absolute",display:"inline-block","background-color":i.debugcolor,top:i.debugy,left:i.debugx,"max-width":e.css("max-width"),padding:e.css("padding"),fontSize:e.css("fontSize"),fontFamily:e.css("fontFamily"),fontWeight:e.css("fontWeight"),lineHeight:e.css("lineHeight"),resize:"none","word-wrap":"break-word"}).appendTo(document.body),i.horizontal===!1?n.css({width:e.width()}):(r=e.css("font-size"),n.css("padding-right","+="+r),n.normalPaddingRight=n.css("padding-right")),d=function(t){return function(l){var r,d,s;return d=t.value.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n /g,"<br/>&nbsp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/\n$/,"<br/>&nbsp;").replace(/\n/g,"<br/>").replace(/ {2,}/g,function(e){return Array(e.length-1).join("&nbsp;")+" "}),/(\n|\r)/.test(t.value)&&(d+="<br />",i.flickering===!1&&(d+="<br />")),n.html(d),i.vertical===!0&&(r=Math.max(n.height()+o,a),e.height(r)),i.horizontal===!0&&(n.css("padding-right",n.normalPaddingRight),i.vertical===!1&&e.hasVerticalScrollBar()&&n.css("padding-right","+="+i.verticalScrollbarWidth+"px"),s=Math.max(n.outerWidth(),c),e.width(s)),i.postGrowCallback(e)}}(this),e.change(d).keyup(d).keydown(d),t(l).resize(d),d())}):void 0}}(window.jQuery,window),e=function(){var e,t,l,i;return e=document.createElement("p"),e.style.width="100%",e.style.height="200px",t=document.createElement("div"),t.style.position="absolute",t.style.top="0px",t.style.left="0px",t.style.visibility="hidden",t.style.width="200px",t.style.height="150px",t.style.overflow="hidden",t.appendChild(e),document.body.appendChild(t),l=e.offsetWidth,t.style.overflow="scroll",i=e.offsetWidth,l===i&&(i=t.clientWidth),document.body.removeChild(t),l-i}}).call(this);
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
        surveyValues : propertiesCommons,
        onLoad : function(){
	        $(".description1, .description2, .description3, .description4, .description5, .description6").focus().autogrow({vertical: true, horizontal: false});
        },
        onSave : function(params) {
			//console.dir( $(params.surveyId).serializeFormJSON() );
			var result = {};
			console.log(params.surveyObj);
			$.each( params.surveyObj,function(section,sectionObj) { 
				result["commons"][sectionObj.key] = {};
				console.log(sectionObj.dynForm.jsonSchema.properties);
				$.each( sectionObj.dynForm.jsonSchema.properties,function(field,fieldObj) { 
					console.log(sectionObj.key+"."+field, $("#"+section+" #"+field).val() );
					if( fieldObj.inputType ){
						result["commons"][sectionObj.key][field] = $("#"+section+" #"+field).val();
					}
				});
			});
			console.dir( result );
			$.ajax({
        	  type: "POST",
        	  url: params.savePath,
        	  data: {properties:result, id: parentId, type: parentType},
              dataType: "json"
        	}).done( function(data){
                toastr.success("Project chart well updated");
                loadByHash("#element.detail.type."+parentType+".id."+parentId);
               // if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
                 //   afterDynBuildSave(data.map,data.id);
                console.info('saved successfully !');

        	});
		},
        collection : "commonsChart",
	    key : "SCSurvey",
		savePath : baseUrl+"/"+moduleId+"/chart/editchart"
		

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
	/*!
	  Non-Sucking Autogrow 1.1.1
	  license: MIT
	  author: Roman Pushkin
	  https://github.com/ro31337/jquery.ns-autogrow
	*/
	
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
			newChart = {};
			newChart["open"] = {};
			nbProperties=0;
			$('.form-property').each(function(){
				valueProperties = $(this).find(".property-value").val();
				descriptionProperties = $(this).find(".property-description").val();
				if($(this).find(".property-value").attr("name") == "newProjectProperty"){
					nameProperties=$(this).find(".newLabelProperty").val();
					//alert(nameProperties);
					if(nameProperties.length){
						newChart["free"][nameProperties]={};
						newProperties={"description": descriptionProperties, "value": valueProperties};
						//newProperties={"label" : nameProperties , "value" : valueProperties};
						newChart["free"][nameProperties]=newProperties;
						nbProperties++;
					}
				}
				else{
					nameProperties = $(this).find(".property-value").attr("name");
					newChart["open"][nameProperties]={};
					newProperties = new Object;
					newProperties={"description": descriptionProperties, "value": valueProperties};
					newChart["open"][nameProperties]=newProperties;
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
		        url: baseUrl+"/"+moduleId+'/chart/editchart',
		        dataType : "json",
		        data:{properties : newChart, id : parentId, type : parentType},
				type:"POST",
		    })
		    .done(function (data,myNewChart) 
		    {
			   if (data.result==true) {   
		        	toastr.success('Project properties succesfully update');
		        	$.unblockUI();
		        	loadByHash("#element.detail.type.<?php echo $parentType ?>.id.<?php echo $parentId ?>");
//					openMainPanelFromPanel( '/project/detail/id/'+projectId, 'Project : <?php if(@$projectName) echo addslashes($projectName) ?>',"fa-lightbulb-o", projectId );
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
	/*$(".edit-chart").off().on("click", function() {
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
	});*/
};

/*var subViewElement, subViewContent, subViewIndex;
function hideEditChart() {
	openMainPanelFromPanel( '/project/detail/id/'+projectId, 'Project : <?php if(@$projectName) echo addslashes($projectName) ?>',"fa-lightbulb-o", projectId );
};*/
// enables the edit form 
function editChart() {
	$(".close-chart-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
};
function addNewProperties(){
	$newProperty='<div class="col-md-12 form-property no-padding">'+
				'<h4 style="text-align:center;width:200px;">Nouvelle propriété</h4>'+
				'<div class="col-md-12">'+
					'<label for="properties">'+
						'Nom de la propriétés:'+
					'</label>'+
					'<input type="text" placeholder="Entrer l\'intitulé de la propriété" class="newLabelProperty form-control"/>'+
	
					'<input class="knob property-value" value="0" name="newProjectProperty" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">'+
				'</div>'+		
				'<div class="col-md-6">'+
					'<textarea class="property-description"	name="newProjectProperty" placeholder="Describe this property"></textarea>'+
				'</div>'+
				'</div>';
	return $newProperty;
}
/*function updateNewKnob(){
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
}*/
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
	function switchTypeChart(str){
		$(".btn-group i").removeClass("fa-check-circle-o");
		$(".btn-group i").addClass("fa-circle-thin");
		$("#btn"+str+" i").removeClass("fa-circle-thin");
		$("#btn"+str+" i").addClass("fa-check-circle-o");
		$(".formChart").hide();
		$("#"+str+"Chart").show( 700 );
	}

</script>
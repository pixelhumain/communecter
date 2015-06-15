<?php 

?>
<style>
#editProjectChart{
	display: none;
}
</style>
<div id="editProjectChart">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add project's chart</h3>
		<form class="form-chart">
			<input type="hidden" value="<?php echo $itemId; ?>" class="projectId"/>
			<div class="row">
				<div class="col-md-12">
					<label for="properties">
						Degré d'ouverture du projet (0% = très fermé, 100% = très ouvert)			
					</label>
					<div class="col-md-12">
								<div class="col-md-4">
										<h4 style="text-align:center;width:200px;">Gouvernance</h4>
										<input class="knob project-gouvernance" name="gouvernancePropertiesProject" value="35" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Partage</h4>
									<input class="knob project-partage" value="35" name="partagePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Solidaire</h4>
									<input class="knob project-solidaire" value="35" name="solidairePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Local</h4>
									<input class="knob project-local" value="35" name="localPropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Avancement</h4>
									<input class="knob project-avancement" value="35" name="avancementPropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Partenaire</h4>
									<input class="knob project-partenaire" value="35" name="partenairePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
							</div>
				</div>
				<div class="form-group">
					<div class="row">
		    	        <button class="btn btn-primary" >Enregistrer</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
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
    
	bindprojectSubViewchart();
	runChartFormValidation();
});
function runChartFormValidation() {
	var formProject = $('.form-chart');
	var errorHandler2 = $('.errorHandler', formProject);
	var successHandler2 = $('.successHandler', formProject);
	formProject.validate({
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
			newChart = new Object;
			newChart.projectID=$(".form-chart .projectId").val(),
			newChart.avancement=$(".form-chart .project-avancement").val(),
			newChart.gouvernance=$(".form-chart .project-gouvernance").val(),
			newChart.local=$(".form-chart .project-local").val(),
			newChart.partenaire=$(".form-chart .project-partenaire").val(),
			newChart.solidaire=$(".form-chart .project-solidaire").val(),
			newChart.partage=$(".form-chart .project-partage").val();
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
		        data:newChart,
				type:"POST",
		    })
		    .done(function (data,myNewChart) 
		    {
			   if (data.result==true) {               
		        	toastr.success('Project properties succesfully update');
		        		updateChart(data.properties);
						$.unblockUI();
						$.hideSubview(); 	
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
				hideEditChart();
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
	$.hideSubview();
};
// enables the edit form 
function editChart() {
	$(".close-chart-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
};
</script>
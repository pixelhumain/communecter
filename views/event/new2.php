<style>
h2 {
    font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
} 
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Creer un évènement</h2>
    <p>Tous le monde peut déposé un évennement local si celui ci est d'interet général </p>
 <form id="eventForm" style="line-height:40px;">
        <section>
        	<?php 
        	$event = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
        	?>
          	<table>
              	<tr>
                  	<td class="txtright">Nom </td>
                  	<td> <input id="eventName" name="eventName" value="<?php if($event && isset($event['name']) )echo $event['name'] ?>"/></td>
              	</tr>
              	
        		<tr>
                  	<td class="txtright">Quand </td>
                  	<td> 
                      	<div class="input-append">
                            <?php $this->widget(
                                        'yiiwheels.widgets.daterangepicker.WhDateRangePicker',
                                        array(
                                            'name' => 'eventWhen',
                                            'htmlOptions' => array(
                                                'placeholder' => 'Select date'
                                            )
                                        )
                                    );
                            ?>
                            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    					</div>
                  	</td>
              	</tr>
              	
        		<tr>
            		<td class="txtright">code postal</td>  
            		<td><input id="eventCP" name="eventCP" class="span2" value="<?php if($event && isset($event['cp']) )echo $event['cp'] ?>"></td>
        		</tr>
        		<tr>
                  	<td class="txtright">Pays  </td>
                  	<td>
        		<?php 
                         $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$phCountries, 
                            'name' => 'countryEvent',
                          	'id' => 'countryEvent',
                            'value'=>($event && isset($event['country']) ) ? $event['country'] : "Réunion",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
            	</tr> 
    		    
        		 <tr>
            		<td class="txtright">Public ?</td>  
            		<td>
            		<?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'public',
            		    'value'=>true
                    ));?>
            		</td>
        		</tr>
        		
        		<tr>
        		<td></td>
        		<td>Partager votre evenement depuis le PH, lui permettra de se développer localement.</td>
        		</tr>
          </table>
             
        </section>
        
    </form>
    <div class="modal-footer pull-left">
            <button class="btn btn-primary" id="eventFormSubmit" onclick="$('#eventForm').submit();">Enregistrer</button>
          </div>
</div></div>
<script type="text/javascript"        >
initT['animInit'] = function(){

	$("#eventForm").submit( function(event){
    	if($('.error').length){
    		alert('Veuillez remplir les champs obligatoires.');
    	}else{
        	event.preventDefault();
        	$("#eventForm").modal('hide');
        	NProgress.start();
        	
        	$.ajax({
        	  type: "POST",
        	  url: baseUrl+"/index.php/evenement/save",
        	  data: $("#eventForm").serialize(),
        	  success: function(data){
        			  $("#flashInfo .modal-body").html(data.msg);
        			  $("#flashInfo").modal('show');
        			  NProgress.done();
        			  if(data.result)
        			  	window.location.href = baseUrl+"/index.php/evenement/view/id/"+data.id;
        	  },
        	  dataType: "json"
        	});
    	}
    });
	
};
</script>

            
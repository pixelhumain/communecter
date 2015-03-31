<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.v3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
      border: 1px dashed #CCC;
      position: relative;
    }

    .grid > div {
      background: #AAA;
      position: absolute;
      height: 50px;
      line-height:22px;
      width: 100px;
      padding:5px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }	
    .graph div.block{border:1px solid #666;text-align:center}
    
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Évenement <?php echo $event["name"].", "/*.$event["date"].", ".OpenData::$commune["974"][$event["cp"]]*/?></h2>
     <div class="col-md-12 padding-20 pull-right">
		<a href="#newAttendees" class="new-attendees addAttendeesBtn btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-id="<?php echo (string)$event["_id"]; ?>" data-original-title="Invite someone to this event"><i class="fa fa-plus"></i> Invite attendees</a>
	</div>
    <p> 
    Type : <?php if(isset($event["type"]))echo $event["type"]?><br/>
    Where : <?php /*if(isset($event["country"])) echo OpenData::$commune["974"][$event["cp"]].", ".$event["country"]*/?><br/>
    Description : <?php if(isset($event["description"]))echo $event["description"]?>
    
    </p>

    <form  method="post" id="profileFormEvent" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail">
			<img src="<?php if ($event && isset($event["imagePath"])) echo $event["imagePath"];?>" alt="">	
		</div>
		<div class="fileupload-preview fileupload-exists thumbnail"></div>
		<div class="user-edit-image-buttons">
			<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
				<input type="file" name="avatar" id="avatar">
			</span>
			<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
				<i class="fa fa-times"></i> Remove
			</a>
		</div>
		</div>
		<input type="submit" value="Upload File" />
	</form>

 	<div class="grid">
   </div>
</div></div>

<div class="container graph">
<div class="hero-unit">
	<div class="row-fluid">
		
		<div class="span4 block">
			<h2>PARTICIPANT, STANDS</h2>
			<br/>
			
		</div>
		
		<div class=" actu span4 block">
			<h2>Thématique</h2>
			
			<br/>
		</div>
		
		<div class="span4 block">
			<h2>Programme </h2>
			
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span8 block">
		<h2>------</h2>
		
        
		</div>
		<div class="span4 block">
		<h2>-------- </h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4  block">
		<h2>---------</h2>
		</div>
		<div class="span4 block">
		<h2>-----------</h2>
		</div>
		<div class="span4 block">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>-----------</h2>
		</div>
		<div class="span6 block ">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4 block">
		<h2>------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>------------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>----------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
		
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
	</div>
	
</div></div>

<script type="text/javascript"		>
	initT['animInit'] = function(){
		$(".grid").shapeshift({
		    minColumns: 3
		  });
	        (function ani(){
	        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
	        })();
	};

	<?php $contextMap = array("event"=>$event, "citoyens"=>$citoyens, "organizations"=>$organizations); 
	?>
	 var contextMap = <?php echo json_encode($contextMap)?>;
	 

	$("#profileFormEvent").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/event/id/"+contextMap['event']['_id']['$id'],
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false, 
			processData: false,
			success: function(data){
		  		if(data.result)
		  			toastr.success(data.msg);
		  		else
		  			toastr.error(data.msg);
		  },
		});
	}));
</script>			
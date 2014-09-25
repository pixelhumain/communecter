<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.scrollbox.js' , CClientScript::POS_END);

$graph = 0;

$cs->registerScriptFile('http://code.highcharts.com/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/modules/exporting.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/highcharts-more.js' , CClientScript::POS_END);
?>
<style>
body {	background-color:#3399FF}


.appMenuContainer{/*background-color:rgba(59, 120, 163, 0.7);*/width:150px;min-height:300px;position:absolute;top:61px;right:0px;z-index:1000;}
.appMenu{position:absolute;top:5px;right:30px;z-index:1051;list-style:none;}
.appMenu a.label{background-color:#F5E414;min-width:120px;}
.appMenu a{color:#324553;font-weight:bold;}

.appContent{z-index:1000;display:none}
.appContent h2{margin-left:0px;text-decoration:underline;font-family: "Homestead";color: #324553;}
.appContent ul.people{position:relative;min-height:100px;}
.appContent ul.people li{cursor:pointer;position:relative;
		width:190px;height:100px;padding:5px;margin:5px;display:inline;
		background-color:#FFF;
		-webkit-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 5px;-ms-border-radius: 5px;border-radius: 5px;}
.appContent ul.people li.me{background-color:#F5E414;}
.appContent ul.people li.me img{cursor:pointer}
.appContent ul.people li.descL {height:200px; }
.appContent li.participant{border:2px solid yellow;background-url:#fff url('<?php echo Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png')?>') no-repeat bottom left;}
.appContent li.projet{border:2px solid orange;}
.appContent li.coach{border:2px solid purple;}

.appContent li.jury{border:2px solid red;}
.appContent li.organisateur{border:2px solid blue;}
.sponsor {list-style:none}
.sponsor img{width:100px;margin-bottom:20px;}
.appContent div.infos{word-wrap:break-word;text-align:right}
.appContent div.type {display:block;float:right;font-size:x-small;clear:both;}
.appContent div.name {font-family: "Homestead";color: #324553;font-size:medium; margin-left:10px;display:block;position:absolute;bottom:5px;right:5px; }
.appContent div.desc {position:absolute;width:100%;bottom:0px; margin:5px;text-align:left;word-wrap: break-word;width:180px;padding-right:5px;position:absolute;top:50px;left:5px;}
.appContent div.desc span.txt{font-size:small;}
.appContent div.desc a.btn-ph{display:inline-block;float:left;margin-right:5px;position:absolute;bottom:5px;left:5px;}
.appContent div.thumb{position:absolute;height:40px;width:40px;top:5px;left:5px;}
.appContent .metier{width:20px;height:20px;background-color:red;position:relative; top:0px; right:0px;-webkit-border-radius: 20px;-moz-border-radius: 20px;-o-border-radius: 20px;-ms-border-radius: 20px;border-radius: 20px;border:1px solid #000;}

.appFooter{position:fixed;bottom:0px;right:0px;width:70px;z-index:2000;margin:15px;}

.bgRed{background-color:red;}
.cRed{color:red;}
.coachRequestedColor{border:5px solid red;}

</style>

<div class="container graph">    
    
    <div class="appMenuContainer">
        <ul class="appMenu">
        	<li><a class="label" href="javascript:filterType('participant')">Inscrits <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        	<li><a class="label " href="javascript:filterType('brainstorm')">Brainstorms <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        	<li><a class="label " href="javascript:filterType('discussion')">Discussions <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        	<li><a class="label " href="javascript:filterType('event')">Evenements <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        	<li><a class="label" href="javascript:filterType('project')">Projets <span class="badge badge-info"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        	<li><a class="label" href="javascript:filterType('post')">Annonces <span class="badge badge-inverse"><?php echo (isset($group["participants"])) ? count($group["participants"]) : 0?></span></a></li>
        </ul>
    </div>
    <br/>
    <div class="appContent">
    
    	<h2><?php echo $group["name"]?><br/><span class="appTitle"></span></h2>
    	
    	<br/>
    	
    	<ul class="people">
        	<?php  
        	$tags = array();
        	if(isset($group["participants"])){
        	    
            	foreach ($group["participants"] as $id){
            	    $c = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId ($id)));
            	    if(isset($c["positions"])){
            	     foreach($c["positions"] as $p ){
                	     if(!in_array($p, $tags))
                    	    array_push($tags, $p);
                	 }
                	}
            	    ?>
            		
                <li class="hide participant <?php if(isset($c["positions"]))echo implode(" ", $c["positions"])?>" >
            		<div class="infos">
            			<div class="type">participant</div>
            			<div class="name " ><?php echo $c["name"]?></div>
            			<div class="thumb" ><img src="<?php echo ( isset($c) && isset($c['img']) ) ? Yii::app()->createUrl($c['img']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>" /></div>
            		</div>
            	 </li>
        	 <?php 
        	     
            	}
            	}else{?>
            	<h3>Vous n'avez pas encore ajouter de participant</h3> 	
             <?php }?>
    	</ul>
    	<?php foreach($tags as $t ){?>
    	<a href="javascript:filterType('<?php echo $t?>')" class="label label-inverse"><?php echo $t?></a>
    	<?php }?>
    </div>	
    <div class="clear"></div>
    </div>


<script type="text/javascript">

function filterType(type){
	$(".appContent ul.people li").slideUp();
	$(".appContent ul.people li."+type).slideDown();
}

initT['sweGraphInit'] = function(){
	
	filterType("participant");
	//setInterval("stopStatsInterval()",5000);
	//appear after loading
	$(".appContent").slideDown();
	

};

</script>	


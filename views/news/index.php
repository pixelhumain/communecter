<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($this->module->assetsUrl.'/js/news/formScope.js' , CClientScript::POS_END);
	$cs->registerScriptFile($this->module->assetsUrl.'/js/news/formGenreAbout.js' , CClientScript::POS_END);
	$cs->registerCssFile($this->module->assetsUrl. '/css/news_form.css');
?>
<style>
.subviews-top{	//background-color:#d5d5d5;}
#more_info_news{	float:right;	width:45%;	background-color:#5F8295;}
div.timeline{ margin-right:0px; }

</style>

<div class="col-md-12">
	
	<!-- 	FIL D'ACTUALITÉS		 -->
	<div class="panel-body">
		<a href='#' class='btn btn-default' style='float:right;'>Add NEWS <i class="fa fa-plus"></i></a>
		<div class="timeline">
			<center><h3>Fil d'actualités</h3></center>
		</div>

		<div id="timeline" class="demo1">
			<div class="timeline" id="newsstream">
				<?php  echo News::getNewsStreamHtml( $news , $this->module->assetsUrl) ?>
				
			</div>
		</div>
	</div>
	<!-- 	FIL D'ACTUALITÉS		 -->
</div>

<script type="text/javascript">
$(document).ready( function() 
{	
	//initialisation des valeurs par defaut
	initFormScope(scope);
	
});	
//scope de départ
var userCP = "<?php echo (isset(Yii::app()->session['user']) && isset(Yii::app()->session['user']['cp'])) ? Yii::app()->session['user']['cp'] : ''; ?>";
var scope = [
	{	"scopeType" : "ville", 
		"at" : userCP, 
		"id" : userCP //devrait correspondre à l'id nominatim de la ville de l'utilisateur
	},
	{	"scopeType" : "departement", 
		"at" : userCP.substring(0, 2), 
		"id" : userCP.substring(0, 2) //devrait correspondre à l'id nominatim du departement de l'utilisateur
	}
];
					


function showNewsStream()
{
	var params = {};
	testitpost("", baseUrl+'/'+moduleId+'/news/GetNewsStream', params,
		function (data){ //alert(JSON.stringify(data));				
			$("#newsstream").html(data);
	});	
}

</script>

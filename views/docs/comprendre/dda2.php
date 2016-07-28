
<div class="panel-heading border-light center text-dark partition-white radius-10 hidden">
    <span class=" text-red homestead tpl_title"> Espace coopératif</span><br><br>
    <!-- <h3 class=" text-dark homestead">Discuter, Décider, Agir (DDA)</h3> -->
    <br/>
    <span class="tpl_shortDesc">Sur communecter, un espace coopératif permet d'utiliser 3 types d'espaces :<br/><br/>
    <span class="col-md-4"><strong><i class="fa fa-angle-down"></i> Espaces de discussions</strong><br/>pour débattre, comprendre les visions de chacuns. </span>
    <span class="col-md-4"><strong><i class="fa fa-angle-down"></i> Espaces de décisions</strong><br/>pour se mettre d'accord en votant des propositions. </span>
    <span class="col-md-4"><strong><i class="fa fa-angle-down"></i> Espaces d'actions</strong><br/>pour mettre en place les décisions prises collectivement.</span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .points{padding-left:10px;}
</style>

<div class="col-sm-12 ">

    <div class="">
        
        <div class="panel-body tpl_content">
        
	        <h2 class="text-red homestead tpl_title"> Espace coopératif</h2><br>
	    	<!-- <h3 class="center text-dark homestead no-margin">Discuter, Décider, Agir (DDA)</h3> -->
	    
	        <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/comprendre/dda.png" class="col-sm-12 img-responsive ">
	        <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/comprendre/dda2.png" class="col-sm-12 img-responsive ">
	        
	        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
		        <div class="col-sm-12 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead"><i class="fa fa-comments"></i> DISCUTER</h4>
						</div> 
						<div class="panel-body">
							<b>Les Salles de Discussion</b> servent à construire et à partager autour d'une thématique
							<br/>
					        <ul class="points">
					        	<li><i class='fa fa-arrow-right'></i> Discuter avec des commentaire </li>
					        	<li><i class='fa fa-arrow-right'></i> Surligner du texte et transformer en vote ou action</li>
					        	<li><i class='fa fa-arrow-right'></i> Bientot : Discussion type Framapad</li>
					        </ul>
					    </div>
					</div>
				</div>

				<div class="col-sm-12 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead"><i class="fa fa-comments"></i> DECIDER</h4>
						</div> 
						<div class="panel-body">
						<b>Les Salles de Décisions</b> ou Votes permettent de faire des propositions et de les partager avec une communauté pour prendre des décisions
						<br/>
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> C'est un votation à 5 choix : </li>
							<li><i class='fa fa-arrow-right'></i> Voter "Pour" : Assez Explicite</li>
							<li><i class='fa fa-arrow-right'></i> Voter "Amender" : La base est bonne mais il faut encore corriger, améliorer, la rendre meilleure.</li>
							<li><i class='fa fa-arrow-right'></i> Voter "Blanc" : Je suis ni pour ni contre</li>
							<li><i class='fa fa-arrow-right'></i> Voter "Incomplet" : il manque des elements pour prendre une réélle décision</li>
							<li><i class='fa fa-arrow-right'></i> Voter "Contre" : Assez Explicite</li>
				        </ul>
				    </div>
					</div>
				</div>

				<div class="col-sm-12 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead"><i class="fa fa-comments"></i> AGIR</h4>
						</div> 
						<div class="panel-body">
							<b>Les Salles d'Actions</b> permettent de faire des listes d'action de choses concrète à réaliser
							<br/>
					        <ul class="points">
					        	<li><i class='fa fa-arrow-right'></i> Une action peut avoir 5 états différents : </li>
								<li><i class='fa fa-arrow-right'></i> "A Faire" : aucune date de début n'a été assigné</li>
								<li><i class='fa fa-arrow-right'></i> "En cours" : une date de début, et une personne est assignée</li>
								<li><i class='fa fa-arrow-right'></i> "En retard": la date de fin est assigné mais dépassé.</li>
								<li><i class='fa fa-arrow-right'></i> "Terminer" : une tache qui a été cloturée</li>
								<li><i class='fa fa-arrow-right'></i> "Non Assignée" : une tache qui n'a pas encore de responsable </li>
								<li><i class='fa fa-arrow-right'></i> Plusieurs personne peuvent etre assignées à une action</li>
					        </ul>
					    </div>
					</div>
				</div>

		    </div>

        </div>
    </div>
</div>


<script type="text/javascript">

var contentData = {
	classes : {
		moduleLabel : "<i class='fa fa-question-circle'></i> INFORMATION",
	rtpl_title : "DDA : Discuter, Décider, Agir",
		tpl_shortDesc : "Les salles d'action permettent de créer 3 types d'espaces pour le moment <br/>Discuter pour orienter, comprendre les visions de chacuns puis, Décider pour se mettre d'accord, et enfin Agir pour que ca avance ",	
		img$src : "<?php echo $this->module->assetsUrl; ?>/images/docs/dda.png",
		break : "",
		html : {
			type : "ul",
			id : "points",
			class : " col-sm-6",
			icon : "<i class='fa fa-arrow-right'></i>",
			list: [
					"liliililiil",
					],
		},

		html2 : {
			type : "ul",
			id : "points2",
			class : " col-sm-6",
			icon : "<i class='fa fa-arrow-right'></i>",
			list: ["dododo",
					
					],
		},
	},
	btns: [
		{
			href : "javascript:window.history.back();",
			labrl : "<i class='fa fa-arrow-left'></i>  Retour",
			class : "bg-dark pull-left"
		},
		{
			href : "javascript:loadByHash(\'#default.view.page.dda.dir.docs\');",
			labrl : "Events <i class='fa fa-arrow-right'></i>",
			class : "bg-red pull-right"
		}
	]

};
	
jQuery( document).ready(function() {
	//buildTpl();
});

function buildTpl () { 
	console.log("buildTpl");

	$.each(contentData.classes,function(key,val) 
	{
		//editing any attributes
		if( key == "break" )
			$(".tpl_content").append("<div class='space20'></div>");
		if( key.indexOf("$") > 0 ){
			keyT = key.split("$");
			if( keyT[0] == "img" ){
				$(".tpl_content").append('<img class="col-sm-12 img-responsive "  src="'+val+'"/>');
			}
		}
		else if( key.indexOf("html") >= 0 ){
			classes = (val.class) ? "class='"+val.class+"'" : "" ; 
			id = (val.id) ? "id='"+val.id+"'" : "" ; 
			if( val.type ){
				$(".tpl_content").append( "<"+val.type+" "+classes+" "+id+" ></"+val.type+">" );
			}
			if(val.list){
				icon = (val.icon) ? val.icon : "" ; 
				$.each(val.list,function(i,li) 
				{ 
					$("#"+val.id).append( "<li>"+icon+" "+li+"</li>" );
			    });
			}
		}
		 else
			$("."+key).html(val);
	});
	strHTML = '<br/><div class="col-sm-12 " >';
	$.each(contentData.btns,function(i,btn) 
	{ 
		strHTML += '<a href="'+btn.href+'" class="text-extra-large '+btn.class+' tooltips radius-5 padding-10 homestead" style="display: block;" >'+btn.label+' </a>';
 r  });
    strHTML += "</div>";
    $(".tpl_content").append(strHTML);
}

</script>
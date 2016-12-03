
<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title"> Financement</span>
    <br/>
    <span class="tpl_shortDesc">Un open système repose souvent sur divers types de contribution et créer souvent des modèles de financement hybride et alternatif.</span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .points{padding-left:10px;}
</style>
<div class="col-sm-12 ">

    <div class="panel panel-white ">
        
        <div class="panel-body tpl_content">
           
	        <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/financement.png"" class="col-sm-12 img-responsive ">
	        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >

		        <div class="col-sm-8 FinanceList"></div>
				<div class="col-sm-4 Distrib" style="border-left:1px solid #ccc">
					
				</div>
		    </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var financeData = {

"2016" : {		
	"Janvier" : {
		title : "solde du compte au 31/12/15 : 17643,94€",					
		lines : [
			["19/01/16","frais bancaire","-3,90","frais","banque"],
			["19/01/16","virement : Goguet Tristan développement PH","-2000,00","développement communecter","Goguet Tristan"],
			["27/01/16","virement : jeremy Loreau développement nouvelle interface communecter","-1000,00","développement communecter","Jeremy Loreau"],
			["28/01/16","virement : Edith Pasquier graphisme nouvelle interface communecter","-217,00","graphisme communecter","Edith Pasquier"]
		]
	},
	"Février" : {
		title : "solde du compte au 31/01/16 : 14423,04€",					
		lines : [
			["04/02/16","paiement de chéque : salaire sitti janvier","-520,80","salaire","Sitti"],
			["05/02/16","virement : Damiens Clement développement communecter","-1815,00","développement communecter","Damiens Clement"],
			["10/02/16","virement : Raphaël Riviére gratification stage","-1000,00","gratification de stage","Raphaël Riviére"],
			["19/02/16","frais bancaires","-3,90","frais","banque"]
		]
	},
	"Mars" : {
		title : "solde du compte au 29/03/16 : 11083,34€",					
		lines : [
			["01/03/16","virement : Edith Pasquier graphisme","-217,00","graphisme communecter","Edith Pasquier"],
			["09/03/16","virement :  sitti salaire février+6,10 euros = rattrappage salaire janvier","-1191,66","salaire","Sitti"],
			["17/03/16","virement : Goguet Tristan développement communecter","-2000,00","développement communecter","Goguet Tristan"],
			["21/03/16","frais bancaire","-3,90","frais","banque"],
			["23/03/16","virement : Damiens Clement développement communecter","-2000,00","développement communecter","Damiens Clement"],
			["24/03/16","remboursement ASP : emploi d'avenir","3299,90","remboursement emploi d'avenir","ASP"],
			["24/03/16","paiement de chéque","-217,00","",""],
			["30/03/16","paiement de chèque","-46,82","",""],
		]
	},	
	"Avril" : {
		title : "solde du compte au 31/01/16 : 8706,86€",					
		lines : [
			["01/04/16","paiement de chéque :  cotisation médecine au travail INTERMETRA","-101,45","médcine au travail","INTERMETRA"],
			["06/04/16","virement : sitti salaire mars","-1141,61","salaire","Sitti"],
			["07/04/16","virement : cotisation retraire","-357,47","retraite complémentaire","CRC"],
			["08/04/16","virement academy des camélias","50950,00","","Academy des Camélias"],
			["11/04/16","paiment de chéque : cotisation OPCA","-67,00","formation professionnelle","Uniformation"],
			["14/04/16","virement CGSS Réunion : cotisations sociales","-1054,00","cotisations sociales","CGSS Réunion"],
			["18/04/16","paiement de chéque" ,"-50,00","adhésion association","MDA"],
			["19/04/16","cotisation : AGESSA","-417,00","cotisations sociales","AGESSA"],
			["19/04/16","frais bancaire","-3,90","frais","banque"],
			["25/04/16","virement : remboursement ASP","1319,96","remboursement emploi d'avenir","ASP"]
		]
	},	
		
	"Mai" : {
		title : "solde du compte au 30/04/16 : 57784,36€",					
		lines : [
			["03/05/16","virement : Goguet Tristan développement communecter","-4000,00","développement communecter","Goguet Tristan"],
			["03/05/16","virement Raphaël Riviére gratification","-1000,00","gratification de stage","Raphaël Riviére"],
			["03/05/16","virement : Damiens Clement développement communecter","-2000,00","développement communecter","Damiens Clement"],
			["09/05/16","virement : Sitti salaire Avril","-1141,61","salaire","Sitti"],
			["09/05/16","prélévement MAIF","-115,27","assurance","MAIF"],
			["01/05/16","virement : Childéric Thoreau développement communecter","-895,00","développement communecter","Childéric Thoreau"],
			["10/05/16","virement : helloasso","680,00","dons","Helloasso"],
			["13/05/16","ingenico financial sa","20300,72","crowdfunding","Kiss Kiss Bank Bank"],
			["19/05/16","frais bancaire","-3,90","","ingenico financial sa"],
			["26/05/16","virement : remboursement ASP","1319,96","remboursement emploi d'avenir","ASP"],
		]
	},	

	"Juin" : {
		title : "solde du compte au 30/05/16 : 70929,26€",					
		lines : [
			["02/06/16","virement OVH sas","-39,03","hébergement","OVH sas"],
			["02/06/16","virement : Sitti salaire mai","-1141,64","salaire","Sitti"],
			["20/06/16","frais bancaire","-3,90","frais","banque"],
			["22/06/16","virement Sylvain Barbot : développement communecter","-4265,00","développemnt communecter","Sylvain Barbot"],
			["22/06/16","virement :Tibor Katelbach développement communecter","-4294,00","développement communecter","Tibor Katelbach"],
			["22/06/16","remboursement ASP","1319,96","remboursement emploi d'avenir","ASP"],
			["28/06/16","Raphaël Riviére gratification","-1524,00","gratification","Raphaël Riviére"],
		]
	},

		

	"Juillet" : {
		title : "solde du compte au 31/06/16 : 60981,65€",					
		lines : [
			["01/07/16","Damiens Clement développement communecter","-2000,00","développement communecter","Damiens Clement "],
			["04/07/16","CGSS Réunion : cotisations sociales","-821,50","cotisations sociales","CGSS Réunion"],
			["11/07/16","virement helloasso","-22,00","don","Helloasso"],
			["13/07/16","cotisation retraite CRC","-429,00","retraite complémentaire","CRC"],
			["13/07/16","salaire juin : Sitti","-1141,64","salaire Sitti"],
			["19/07/16","frais bancaire","-3,90","frais","banque"],
			["19/07/16","cotisation AGESSA","-197,00","cotisations sociales","AGESSA"],
			["20/07/16","virement : Thomas Craipeau ","-1679,20","développement communecter","Thomas Craipeau"],
			["21/07/16","virement trésorerie de Saint-Louis","15400,00","subvention ","Mairie de Saint-Louis"],
			["22/07/16","virement : Tibor Katelbach","-2000,00","développement communecter","Tibor Katelbach"],
			["26/07/16","remboursement ASP","1319,96","remboursement emploi d'avenir","ASP"],
		]
	},
		
	"Août" : {
		title : "solde du compte au 31/07/16 : 69452,37€",					
		lines : [
			["03/08/16","virement : Goguet Tristant","-4000,00","développement communecter","Goguet Tristan"],
			["03/08/16","virement Tibor Katelbach","-4000,00","développent communecter","Tibor Katelbach"],
			["03/08/16","virement : Damien Clement","-906,00","développemnt communecter","Damiens Clement"],
			["03/08/16","virement : Raphaël Riviére","-895,90","développement communecter","Raphaël Riviére"],
			["04/08/16","salaire juillet : Sitti","-1087,28","salaire","Sitti"],
			["08/08/16","virement : Fablab Barcelona","-3832,50","","Fablab Barcelona"],
			["12/08/16","virement DRFIP Paris","2000,00","Subvention","DRFIP Paris"],
			["19/08/16","frais bancaire","-3,90","frais","banque"],
			["23/08/16","remboursement ASP","-1319,96","remboursement emploi d'avenir","ASP"],
			["24/08/16","paiement de chéque","-65,15","",""],
			["26/08/16","remise de chéque","2025,00","dons","SIDR+autre"],
			["02/09/16","virement : Raphaël Riviére ","-895,90","développement communecter","Raphaël Riviére"],
			["02/09/16","salaire août Sitti","-1141,64","salaire","Sitti"],
			["19/09/16","frais bancaire","-3,90","frais","banque"],
			["23/09/26","remboursement ASP","1319,96","remboursement emploi d'avenir","ASP"],
		]
	},

	"Octobre" : {
		title : "solde du copte au 30/09/16 : 59284,12€",					
		lines : [
			["04/10/16","virement : Raphaël riviére","-895,90","développement communecter","Raphaël Riviére"],
			["04/10/16","virement : Goguet Tristan","-4000,00","développemnt communecter","Goguet Tristan"],
			["04/10/16","salaire septembre : Sitti","-1141,64","salaire","Sitti"],
			["04/10/16","paiement E-dkado sarl","-737,94","acahat","E-dkado"],
			["07/10/16","remboursement : Damiens Clement","-237,90","remboursement de frais","Damiens Clement"],
			["07/10/16","virement : Damiens Clement","-895,90","développement communecter","Damiens Clement"],
			["07/10/16","virement : Tibor Katelbach","-2804,00","développement communecter+ remboursement de frais","Tibor Katelbach"],
			["13/10/16","remise de chéque","1592,83","financement formation+remboursement de frais annexes","Uniformation"],
			["13/10/16","remboursement : Stéphanie Lorente","-93,23","remboursement de frais","McLen"],
			["13/10/16","virement : Semeoz","-300,00","community management","Semeoz"],
			["13/10/16","CGSS Réunion","-1138,00","cotisations sociales","CGSS Réunion"],
			["13/10/16","cotisation retraite : CRC","-422,00","cotisation retraite","CRC"],
			["19/10/16","frais bancaire","-3,90","frais","banque"],
			["25/10/16","prélévement AGESSA","-524,00","réglement 3éme trimestre AGESSA","AGESSA"],
			["26/10/16","virementt ASP","1275,96","remboursement emploi d'avenir","ASP"],
			["27/10/16","remise de chéque","25,00","chéque adhésion	"],
		]
	},
	"Novembre" : {
		title : "solde du compte au 30/09/16",					
		lines : [
			["03/11/16","salaire octobre : Sitti","-1141,64","Salaire","Sitti"],
			["03/11/16","virement : Raphaël riviére","-895,90","développement communecter","Raphaël Riviére"],
			["04/11/16","virement : Sitti","-92,83","Remboursement de frais de transport durant formation","Sitti"],
			["07/11/16","paiement de chéque : Pixel formations","-1500,00","formation Sitti","Pixel formations"],
			["08/11/16","virement : Jerome Gontier","-500,00","Remboursement de frais de transport ","Jerome Gontier"],
			["10/11/16","virement AGESSA","-1218,00","régularisation paiement 2éme trimestre","AGESSA"],
			["10/11/16","prestation de la MEL","-3583,60","","Damiens Clement"],
			["17/11/16","virement : pairie régionale","6500,00","subvention région","La Région Réunion"],
			["19/11/16","frais bancaire","-3,90","frais","banque"],
			["23/11/16","remboursement de frais+facture","-3608,49",""],
		]
	}
}
}

jQuery(document).ready(function() {
	buildFinance()
	
});
function buildFinance () { 
	var inCompta = {};
	var outCompta = {};
	$.each(financeData,function(y,yearObj) { 
		$.each(yearObj,function(k,fiObj) { 
			strHTML = 
						'<div class="panel-body">'+
							'<h2 class="homestead text-red" >'+k+' : '+fiObj.title+'</h2>'+
							'<table class="table table-hover" >'+
								'<thead>'+
								'<tr>'+
									'<th class="center">#</th>'+
									'<th class="center">Date</th>'+
									'<th>Objet</th>'+
									'<th class="hidden-xs">Montant</th>'+
									'<th>type</th>'+
									'<th class="hidden-xs">personne</th>'+
								'</tr></thead><tbody>';
									$.each(fiObj.lines,function(lini,line) {
										strHTML += '<tr><td>'+(lini+1)+'</td><td>'+line[0]+'</td><td>'+line[1]+'</td><td>'+line[2]+'€</td><td>'+line[3]+'</td><td>'+line[4]+'</td></tr>';
										if( !inCompta[ line[4] ] )
											inCompta[ line[4] ] = 0;
										
										inCompta[ line[4] ] += parseInt(line[2])
									});
								strHTML += '</tbody>'+
							'</table></div>';
			$(".FinanceList").prepend(strHTML);
		});
	});

	
	strHTML = 
		'<div class="panel-body">'+
			'<table class="table table-hover" >'+
				'<thead>'+
				'<tr>'+
					'<th class="center">Qui</th>'+
					'<th class="center">Combien</th>'+
				'</tr></thead><tbody>';
	var inHTML = "";
	var outHTML = "";
	$.each(inCompta,function(who,count) { 
		if(count > 0)
			inHTML += '<tr><td>'+who+'</td><td>'+count+'€</td></tr>';
		else
			outHTML += '<tr><td>'+who+'</td><td>'+count+'€</td></tr>';
	});
	$(".Distrib").append("<h2 class='homestead text-red'>Contributions</h2><br/>"+strHTML+inHTML+'</tbody></table></div>');
	$(".Distrib").append("<h2 class='homestead text-red'>Dépenses</h2><br/>"+strHTML+outHTML+'</tbody></table></div>');
}
</script>


	
<!-- <script src='//code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">-->
<?php
// $cs = Yii::app()->getClientScript();
echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');

date_default_timezone_set('UTC');
$displayResult[] = 'false';
$displayResult[null] = 'false';
$displayResult[1] = 'true';
?>
<div class="panel panel-white">
	<div id="config">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Logs</h4>
		</div>
		<div class="panel-body">
			<table id="summary" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Adresse IP</th>
						<th>Action</th>
						<th>Nombre de fois</th>
						<th>Première action</th>
						<th>Dernière action</th>
						<th>Resultat</th>
						<th>Message</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ($summary['result'] as $key => $value) {
						$value["minDate"] = date('Y-m-d H:i:s', @$value["minDate"]->sec);
						$value["maxDate"] = date('Y-m-d H:i:s', @$value["maxDate"]->sec);
						echo "<tr>";
						echo "<td>".@$value['_id']['ip']."</td>";
						echo "<td>".@$value['_id']['action']."</td>";
						echo "<td>".@$value['count']."</td>";
						echo "<td>".@$value['minDate']."</td>";
						echo "<td>".@$value['maxDate']."</td>";
						if(!@$actionsToLog[@$value['_id']['action']]['waitForResult']){
							echo "<td> - </td>";
							echo "<td> - </td>";
						}
						else{
							echo "<td>".@$displayResult[$value['_id']['result']]."</td>";
							echo "<td>".@$value['_id']['msg']."</td>";
						}
						echo "</tr>";
						// print_r(@$value['count']);
					}
					?>
				 </tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-cog'></i> <span id='main-title-menu'>Espace administrateur");
	    $('#summary').DataTable({
	    	"paging":   false,
	    	"language": {
				"lengthMenu": "Afficher _MENU_ lignes par page",
				"zeroRecords": "Pas de résultat",
				"info": "Ligne(s) affiché(s) : _TOTAL_",
				"infoEmpty": "Pas de ligne",
				"sSearch":        "Recherche:",
				"infoFiltered": " / _MAX_",
				"oPaginate": {
					"sFirst":    "première",
					"sLast":    "dernier",
					"sNext":    "suivant",
					"sPrevious": "précédent"
				}
			}
			// ,initComplete: function () {
			//     this.api().columns().every( function () {
			//         var column = this;
			//         // if($(column.header()).html() != " nom entete"){
			//             var select = $('<select><option value="">'+($(column.header()).html())+'</option></select>')
			//                 .appendTo( $(column.header()).empty() )
			//                 .on( 'change', function () {
			//                     var val = $.fn.dataTable.util.escapeRegex(
			//                         $(this).val()
			//                     );

			//                     column
			//                         .search( val ? '^'+val+'$' : '', true, false )
			//                         .draw();
			//                 } );

			//             column.data().unique().sort().each( function ( d, j ) {
			//                 select.append( '<option value="'+d+'">'+d+'</option>' )
			//             } );
			//         // }
			//     } );
			// }

	    });
	} );

</script>

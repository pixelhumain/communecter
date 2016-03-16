<?php


if(count($allLogs)){?>
	<section id="allLogs" class="section">
		<div class="section-content">
			<div>
				<table id="listing" class="display" cellspacing="0" width="95%" data-page-length='10000'>
					<thead>
						<tr>
							<th>_id</th>
							<th>userId</th>
							<th>browser</th>
							<th>ipAddress</th>
							<th>created</th>
							<th>action</th>
							<th>result</th>
							<th>message</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($allLogs as $key => $val){
						echo "<tr>
								<td>".$val['_id']."</td>
								<td>".$val['userId']."</td>
								<td>".$val['browser']."</td>
								<td>".$val['ipAddress']."</td>
								<td>".$val['created']."</td>
								<td>".$val['action']."</td>
								<td>".json_encode($val['params'])."</td>
								<td>".@$val['result']['result']."</td>
								<td>".@$val['message']['message']."</td>
							</tr>";
							
					}?>
					</tbody>
				</table>
			</div>
			<div id="export" style="display:none"></div>
		</div>
	</section>

	<script>

		$(document).ready(function() {

			var asInitVals = new Array();
			$.fn.dataTable.moment('DD/MM/YYYY HH:mm');
			//$.fn.dataTable.TableTools.defaults.aButtons = [ "copy", "csv", "xls" ];

		    var oTable = $('#listing').DataTable( {
		    	"language": {
					"lengthMenu": "Afficher _MENU_ tickets par page",
					"zeroRecords": "Pas de résultat",
					"info": "Ticket(s) affiché(s) : _TOTAL_",
					"infoEmpty": "Pas de tickets",
					"sSearch":        "Recherche:",
					"infoFiltered": " / _MAX_",
					"oPaginate": {
						"sFirst":    "première",
						"sLast":    "dernier",
						"sNext":    "suivant",
						"sPrevious": "précédent"
					}
				},
				"dom": '<"top"fi>rt<"bottom"lp><"clear">',
		        initComplete: function () {
		            this.api().columns().every( function () {
		                var column = this;
		                if($(column.header()).html() != "browser"){
			                var select = $('<select><option value="">'+($(column.header()).html())+'</option></select>')
			                    .appendTo( $(column.header()).empty() )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			 
			                        column
			                            .search( val ? '^'+val+'$' : '', true, false )
			                            .draw();
			                    } );
			 
			                column.data().unique().sort().each( function ( d, j ) {
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
			            }
		            } );
		        }
		    } );


	

		 
			function strip_tags(html) {
			    var tmp = document.createElement("div");
			    tmp.innerHTML = html;
			    return tmp.textContent||tmp.innerText;
			}

		} );

	</script>
<?php } ?>
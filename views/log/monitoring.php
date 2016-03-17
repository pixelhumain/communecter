<?php


if(count($allLogs)){?>
	<div class="section-content">
		<div>
			<table id="listing" class="display" cellspacing="0" width="95%" data-page-length='10000'>
				<thead>
					<tr>
						<th>userId</th>
						<th>browser</th>
						<th>ipAddress</th>
						<th>Nombre de fois</th>
						<th>Première fois</th>
						<th>Dernière fois</th>
						<th>Résultat</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($allLogs as $key => $val){
					echo "<tr>
							<td>".$val['userId']."</td>
							<td>".$val['browser']."</td>
							<td>".$val['ipAddress']."</td>
							<td>".$val['count']."</td>
							<td>".$val['minCreated']."</td>
							<td>".$val['maxCreated']."</td>
							<td>".@$val['result']['result']."</td>
						</tr>";
						
				}?>
				</tbody>
			</table>
		</div>
		<div id="export" style="display:none"></div>
	</div>
<?php } ?>

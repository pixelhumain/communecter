<table>
	<tr>
		<th>Adresse IP</th>
		<th>Action</th>
		<th>Nombre de fois</th>
		<th>Première action</th>
		<th>Dernière action</th>
		<th>Resultat</th>
		<th>Message</th>
	</tr>
	<?php 
		$displayResult[] = 'false';
		$displayResult[null] = 'false';
		$displayResult[1] = 'true';

		// print_r($summary);
		foreach ($summary['result'] as $key => $value) {
			date_default_timezone_set('UTC');
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
		die();


		?>
</table>


<div>
	<table>
		<caption>Список пошти</caption>
		<thead>
			<tr>
				<th>Дата відправки:</th>
				<th>Текст листа:</th>
				<th>Відповідь сервера:</th>
				<th>Ім'я клієнта:</th>
				<th>Телефон клієнта:</th>
				<th>Пошта клієнта:</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		$mails = ObjectList('maillog');
		if ($mails[0]!='')
		{
			foreach( $mails as $mail)
			{
		?>		
			<tr>
				<td><?php echo $mail['sent_date']; ?></td>
				<td><?php echo $mail['sent_data']; ?></td>
				<td><?php echo $mail['mailserver_respond']; ?></td>
				<td><?php echo $mail['client_name']; ?></td>
				<td><?php echo $mail['client_phone']; ?></td>
				<td><?php echo $mail['client_email']; ?></td>
			</tr>
		<?php
			}
		}
		else
		{ 
		?>	
			<td><?php echo 'Поки що немає жодного листа!'; ?></td>				
		<?php 	
		}
	 ?>
	 	</tbody>
	</table>
</div>
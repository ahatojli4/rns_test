<?php
$qualificationFilter = (!empty($_POST['qualification'])) ? $_POST['qualification'] : [];
$citiesFilter = (!empty($_POST['cities'])) ? $_POST['cities'] : [];
$users =$dataGetter->getUsers($qualificationFilter, $citiesFilter);
?>

<table class="js-table">
	<caption>Пользователи</caption>
	<thead>
	<tr>
		<th>ФИО</th>
		<th>Образование</th>
		<th>Города</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user->getName(); ?></td>
			<td><?php echo $user->getQualification(); ?></td>
			<td><?php echo $user->getUserCities(); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

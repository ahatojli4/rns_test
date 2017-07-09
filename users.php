<?php
use Service\Container;

require_once __DIR__ . '/vendor/autoload.php';
$qualificationFilter = (!empty($_POST['qualification'])) ? $_POST['qualification'] : [];
$citiesFilter = (!empty($_POST['cities'])) ? $_POST['cities'] : [];
$container = new Container(Config::CONFIGURATION);
$dataGetter = $container->getDataGetter();
$users = $dataGetter->getUsers($qualificationFilter, $citiesFilter);
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
			<td><?php echo $user->getUserCitiesString(); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

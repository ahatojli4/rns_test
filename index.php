<?php
use Service\Container;

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container(Config::CONFIGURATION);
$dataGetter = $container->getDataGetter();

//<editor-fold desc="Этот блок можно закэшировать">
$qualifications = $dataGetter->getAllQualifications();
$cities = $dataGetter->getAllCities();
//</editor-fold>

$qualificationFilter = (!empty($_POST['qualification'])) ? $_POST['qualification'] : [];
$citiesFilter = (!empty($_POST['cities'])) ? $_POST['cities'] : [];
$users =$dataGetter->getUsers($qualificationFilter, $citiesFilter);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test_rns</title>


	<link rel="stylesheet" href="resources/css/foundation.css">
	<link rel="stylesheet" href="resources/css/app.css">

</head>

<body>
<div>
	<header>
		<h1 class="text-center">Test RNS</h1>
	</header>
	<div>
		<div class="grid-container grid-container-padded">
			<form method="POST" action="/users.php" class="js-form">
				<h2>Форма</h2>
				<div class="grid-x grid-margin-x">
					<div class="small-6 cell">
						<label>
							<span>Образование:</span>
							<select name="qualification[]" multiple>
								<?php foreach ($qualifications as $qualification): ?>
									<option value="<?php echo $qualification->getId(); ?>"<?php echo in_array($qualification->getId(), $qualificationFilter) ? ' selected' : ''?>><?php echo $qualification->getName(); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</div>
					<div class="small-6 cell">
						<label>
							<span>Город:</span>
							<select name="cities[]" multiple>
								<?php foreach ($cities as $city): ?>
									<option value="<?php echo $city->getId(); ?>"<?php echo in_array($city->getId(), $citiesFilter) ? ' selected' : ''?>><?php echo $city->getName(); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</div>
				</div>
				<br>
				<button type="submit" class="button">Фильтровать</button>
				<a href="/" class="button js-clear">Сбросить</a>
			</form>

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
		</div>
	</div>
</div>
<script src="resources/js/vendor/jquery.js"></script>
<script src="resources/js/app.js"></script>
</body>
</html>
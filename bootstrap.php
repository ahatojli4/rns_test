<?php
/* Можно подключить composer для автолоада. */
use Service\Container;

require_once __DIR__ . '/lib/Model/City.php';
require_once __DIR__ . '/lib/Model/Qualification.php';
require_once __DIR__ . '/lib/Model/User.php';
require_once __DIR__ . '/lib/Model/UserTableRow.php';
require_once __DIR__ . '/lib/Service/DataGetter.php';
require_once __DIR__ . '/lib/Service/PdoStorage.php';
require_once __DIR__ . '/lib/Service/Container.php';

$configuration = [
	'dsn' => 'mysql:host=localhost;dbname=rns_user_test',
	'username' => 'root',
	'password' => '1',
];

$container = new Container($configuration);
<?php

$dbName = 'rns_user_test';
$dbUser = 'root';
$dbPass = '1';

// create database
$pdoDb = new PDO('mysql:host=localhost', $dbUser, $dbPass);
$pdoDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDb->exec('CREATE DATABASE IF NOT EXISTS ' . $dbName);

// create tables
$pdo = new PDO('mysql:host=localhost;dbname=' . $dbName, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$pdo->exec('DROP TABLE IF EXISTS cities;');
$pdo->exec('DROP TABLE IF EXISTS qualifications;');
$pdo->exec('DROP TABLE IF EXISTS users;');
$pdo->exec('DROP TABLE IF EXISTS users_to_cities;');

$pdo->exec('CREATE TABLE `qualifications` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;');

$pdo->exec('CREATE TABLE `cities` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;');

$pdo->exec('CREATE TABLE `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT,
  `qualifiacation_id` INT(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_us_qu` (`qualifiacation_id`),
  CONSTRAINT `fk_us_qu` FOREIGN KEY (`qualifiacation_id`) REFERENCES `qualifications` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;');

$pdo->exec('CREATE TABLE `users_to_cities` (
  `user_id` int(11) unsigned NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

// insert data

$pdo->exec('INSERT INTO `cities` (`id`, `name`)
VALUES
	(1, \'Санкт-Петербург\'),
	(2, \'Москва\'),
	(3, \'Кириши\'),
	(4, \'Выборг\'),
	(5, \'Всеволожск\'),
	(6, \'Тихвин\'),
	(7, \'Бокситогорск\'),
	(8, \'Киров\');
');

$pdo->exec('INSERT INTO `qualifications` (`id`, `name`)
VALUES
	(1, \'среднее\'),
	(2, \'бакалавр\'),
	(3, \'магистр\'),
	(4, \'аспирант\');
');

$pdo->exec('INSERT INTO `users` (`id`, `name`, `qualifiacation_id`)
VALUES
	(1, \'Никифорова Тамара Сергеевна\', 1),
	(2, \'Новиков Дамир Макарович\', 2),
	(3, \'Зайцева София Артёмовна\', 3),
	(4, \'Комиссарова Екатерина Валерьяновна\', 3),
	(5, \'Зайцева Валерия Авдеевна\', 4),
	(6, \'Логинов Владимир Викторович\', 1),
	(7, \'Степанов Эдуард Филатович\', 2),
	(8, \'Корнилов Глеб Гордеевич\', 3),
	(9, \'Селиверстов Сергей Мартынович\', 4);
');

$pdo->exec('INSERT INTO `users_to_cities` (`user_id`, `city_id`)
VALUES
	(1, 1),
	(2, 2),
	(2, 3),
	(3, 1),
	(4, 4),
	(5, 4),
	(5, 5),
	(5, 6),
	(6, 6),
	(7, 7),
	(8, 1),
	(8, 8),
	(9, 3);'
);

echo 'Done';
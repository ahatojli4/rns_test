<?php

namespace Service;


class PdoStorage
{
	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * UserGetter constructor.
	 * @param \PDO $pdo
	 */
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	/**
	 * @return array
	 */
	public function fetchAllCities(): array
	{
		$statement = $this->pdo->prepare('SELECT * FROM cities;');
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * @return array
	 */
	public function fetchAllQualifications(): array
	{
		$statement = $this->pdo->prepare('SELECT * FROM qualifications;');
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * @param array $qualificationFilter
	 * @param array $cityFilter
	 * @return array
	 */
	public function fetchUsers(array $qualificationFilter = [], array $cityFilter = []): array
	{
		$statement = $this->pdo->prepare($this->getUsersQueryString($qualificationFilter, $cityFilter));
		$statement->execute(array_merge($qualificationFilter, $cityFilter));

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * @param array $qualificationFilter
	 * @param array $cityFilter
	 * @return string
	 */
	private function getUsersQueryString(array $qualificationFilter = [], array $cityFilter = []): string
	{
		$query = <<<'SQL'
SELECT
	qualifications.id AS qualification_id,
	qualifications.name AS qualification_name,
	users.id AS user_id,
	users.name AS user_name,
	cities.id AS city_id,
	cities.name AS city_name
FROM users
	INNER JOIN users_to_cities
		ON users.id = users_to_cities.user_id
	INNER JOIN cities
		ON users_to_cities.city_id = cities.id
	INNER JOIN qualifications
		ON users.qualifiacation_id = qualifications.id
SQL;

		$whereStatement = '';
		if (!empty($qualificationFilter) || !empty($cityFilter)) {
			$whereStatement .= ' WHERE ';
			$and = (!empty($qualificationFilter) && !empty($cityFilter)) ? ' AND ' : '';
			$qualificationBlock = '';
			if (!empty($qualificationFilter)) {
				$qualificationBlock .= 'qualifications.id IN (' . implode(',', array_fill(0, count($qualificationFilter), '?')) . ')';
			}
			$cityBlock = '';
			if (!empty($cityFilter)) {
				$cityBlock .= 'cities.id IN (' . implode(',', array_fill(0, count($cityFilter), '?')) . ')';
			}
			$whereStatement .= $qualificationBlock . $and . $cityBlock;

			$query .= $whereStatement . ';';

		}

		return $query;
	}
}
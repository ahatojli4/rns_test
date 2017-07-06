<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 05.07.17
 * Time: 22:13
 */

namespace Service;


use Model\City;
use Model\Qualification;
use Model\User;
use Model\UserTableRow;

class DataGetter
{
	/**
	 * @var PdoStorage
	 */
	private $storage;

	/**
	 * UserGetter constructor.
	 * @param $storage
	 */
	public function __construct($storage)
	{
		$this->storage = $storage;
	}


	/**
	 * @return City[]
	 */
	public function getAllCities(): array
	{
		$cityArray = $this->storage->fetchAllCities();

		$result = [];
		foreach ($cityArray as $row) {
			$result[] = $this->getCityObj($row);
		}

		return $result;
	}

	/**
	 * @return Qualification[]
	 */
	public function getAllQualifications(): array
	{
		$qualificationArray = $this->storage->fetchAllQualifications();

		$result = [];
		foreach ($qualificationArray as $row) {
			$result[] = $this->getQualificationObj($row);
		}

		return $result;
	}

	/**
	 * @param array $qualificationFilter
	 * @param array $cityFilter
	 * @return UserTableRow[]
	 */
	public function getUsers(array $qualificationFilter = [], array $cityFilter = []): array
	{

		$usersArray = $this->storage->fetchUsers($qualificationFilter, $cityFilter);
		$result = [];
		foreach ($usersArray as $row) {
			if (array_key_exists($row['user_id'], $result)) {
				$result[$row['user_id']]->addUserCity($row['city_name']);
			} else {
				$user = new UserTableRow();
				$user->setId($row['user_id']);
				$user->setName($row['user_name']);
				$user->setQualification($row['qualification_name']);
				$user->addUserCity($row['city_name']);
				$result[$row['user_id']] = $user;
			}
		}

		return $result;
	}

	/**
	 * @param array $row
	 * @return Qualification
	 */
	private function getQualificationObj(array $row): Qualification
	{
		$qualification = new Qualification();
		$qualification->setId($row['id']);
		$qualification->setName($row['name']);
		return $qualification;
	}

	/**
	 * @param array $row
	 * @return City
	 */
	private function getCityObj($row): City
	{
		$city = new City();
		$city->setId($row['id']);
		$city->setName($row['name']);
		return $city;
	}

}
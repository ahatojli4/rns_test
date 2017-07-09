<?php

namespace Model;


class UserTableRow extends User
{
	/**
	 * @var array
	 */
	private $userCities;
	private $qualification;

	/**
	 * UserTableRow constructor.
	 * @param int $id
	 * @param string $name
	 */
	public function __construct(int $id, string $name)
	{
		parent::__construct($id, $name);
	}


	public function addUserCity(string $userCities)
	{
		$this->userCities[] = $userCities;
	}

	public function setQualification(string $qualification)
	{
		$this->qualification = $qualification;
	}

	/**
	 * @return string
	 */
	public function getUserCitiesString(): string
	{
		return implode(', ', $this->userCities);
	}

	/**
	 * @return string
	 */
	public function getQualification(): string
	{
		return $this->qualification;
	}

}
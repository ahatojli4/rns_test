<?php

namespace Model;


class UserTableRow extends User
{
	/**
	 * @var array
	 */
	private $userCities;
	private $qualification;

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
	public function getUserCities(): string
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
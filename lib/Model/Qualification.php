<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 05.07.17
 * Time: 22:11
 */

namespace Model;


class Qualification
{
	private $id;
	private $name;

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

}
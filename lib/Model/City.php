<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 05.07.17
 * Time: 22:09
 */

namespace Model;


class City
{
	private $id;
	private $name;

	/**
	 * City constructor.
	 * @param int $id
	 * @param string $name
	 */
	public function __construct(int $id, string $name)
	{
		$this->id = $id;
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
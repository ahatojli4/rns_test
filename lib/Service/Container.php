<?php

namespace Service;


class Container
{
	/**
	 * @var null|\PDO $pdo
	 */
	private $pdo = null;
	/**
	 * @var array $configuration
	 */
	private $configuration;

	/**
	 * @var null|DataGetter
	 */
	private $dataGetter = null;

	/**
	 * @var PdoStorage
	 */
	private $pdoStorage = null;

	/**
	 * Container constructor.
	 * @param array $configuration
	 */
	public function __construct(array $configuration)
	{
		$this->configuration = $configuration;
	}

	/**
	 * @return \PDO
	 */
	public function getPdo(): \PDO
	{
		if (is_null($this->pdo)) {
			$this->pdo = new \PDO(
				$this->configuration['dsn'],
				$this->configuration['username'],
				$this->configuration['password']
			);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return $this->pdo;
	}

	/**
	 * @return DataGetter
	 */
	public function getDataGetter(): DataGetter
	{
		if (is_null($this->dataGetter)) {
			$this->dataGetter = new DataGetter($this->getPdoStorage());
		}

		return $this->dataGetter;
	}

	/**
	 * @return PdoStorage
	 */
	public function getPdoStorage(): PdoStorage
	{
		if (is_null($this->pdoStorage)) {
			$this->pdoStorage = new PdoStorage($this->getPdo());
		}

		return $this->pdoStorage;
	}

}
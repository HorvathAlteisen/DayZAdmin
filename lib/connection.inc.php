<?php
class  connection {

	private $dbConfig = null;
	private $pdo = null;

	public function __construct($config) {

		$this->dbConfig = $config;

	}

	public function connect() {

		$dsn = "mysql:";

		$dsn .= ";port={$this->config->get("dbPort")}";
		$dsn .= ";dbname={$this->config->get("db")}";

		$this->pdo = new PDO($dsn, $this->config->get("dbUsername"), $this->config->get("dbPassword"));

	}
}
?>